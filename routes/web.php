<?php

use Illuminate\Http\Request;

Route::get('randomize{r?}', function () {
	return view('randomizer');
});

Route::get('entrance/randomize{r?}', function () {
	return view('entrance_randomizer');
});

Route::get('/', function () {
	return view('about');
});

Route::get('about', function () {
	return view('about');
});

Route::get('game_modes', function () {
	return view('game_modes');
});

Route::get('game_logics', function () {
	return view('game_logics');
});

Route::get('game_difficulties', function () {
	return view('game_difficulties');
});

Route::get('info', function () {
	return redirect('help');
});

Route::get('stuck', function () {
	return view('stuck');
});

Route::get('help', function () {
	return view('help');
});

Route::get('updates', function () {
	return view('updates');
});

Route::get('spoiler_click/{seed_id?}', function() {
	return "Ok";
});

Route::any('hash/{hash}', function(Request $request, $hash) {
	$seed = ALttP\Seed::where('hash', $hash)->first();
	if ($seed) {
		return json_encode([
			'logic' => $seed->logic,
			'difficulty' => $seed->rules,
			'patch' => json_decode($seed->patch),
			'spoiler' => array_except(array_only(json_decode($seed->spoiler, true), ['meta']), ['meta.seed']),
			'hash' => $seed->hash,
		]);
	}
	abort(404);
});

Route::any('entrance/seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$difficulty = $request->input('difficulty', 'normal') ?: 'normal';

	// @TODO: wrap this in a class with setters/getters
	$proc = new Symfony\Component\Process\Process('python3 '
		. base_path('vendor/z3/entrancerandomizer/EntranceRandomizer.py')
		. ' --mode ' . $request->input('mode', 'standard')
		. ' --goal ' . $request->input('goal', 'ganon')
		. ' --difficulty ' . $difficulty
		. ' --shuffle ' .  $request->input('shuffle', 'full')
		. ($seed_id !== null ? ' --seed ' . (is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id))) : '')
		. ' --heartbeep ' . $request->input('heart_speed', 'half')
		. ' --jsonout --loglevel error');

	$proc->run();

	if (!$proc->isSuccessful()) {
		return response('Failed', 409);
	}

	$er = json_decode($proc->getOutput());
	$patch = $er->patch;
	array_walk($patch, function(&$write, $address) {
		$write = [$address => $write];
	});
	$patch = array_values((array) $patch);

	// possible temp fix
	$spoiler = json_decode($er->spoiler);
	$spoiler->meta->build = ALttP\Rom::BUILD;
	$spoiler->meta->logic = 'er-no-glitches-0.4.3';

	$seed_record = new ALttP\Seed;
	$seed_record->seed = $spoiler->meta->seed;
	$seed_record->spoiler = json_encode($spoiler);
	$seed_record->patch = json_encode(array_values((array) $patch));
	$seed_record->build = ALttP\Rom::BUILD;
	$seed_record->logic = -1;
	$seed_record->rules = $difficulty;
	$seed_record->game_mode = 'er-no-glitches-0.4.3';
	$seed_record->save();

	if ($request->has('tournament') && $request->input('tournament') == 'true') {
		$rom = new ALttP\Rom();
		$rom->setSeedString(str_pad(sprintf("ER TOURNEY %s", $seed_record->hash), 21, ' '));
		$patch = patch_merge_minify($patch, $rom->getWriteLog());
		$meta = $spoiler->meta;
		$spoiler = (object) array_except(array_only((array) $spoiler, ['meta']), ['meta.seed']);
		$seed_record->patch = json_encode($patch);
		$seed_record->save();
		$spoiler->meta->seed = $seed_record->hash;
	}

	return json_encode([
		'seed' => $spoiler->meta->seed,
		'logic' => $spoiler->meta->logic,
		'difficulty' => $difficulty,
		'patch' => $patch,
		'spoiler' => $spoiler,
		'hash' => $seed_record->hash,
	]);
});

Route::any('seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$difficulty = $request->input('difficulty', 'normal') ?: 'normal';
	if ($difficulty == 'custom') {
		config($request->input('data'));
	}
	$variation = $request->input('variation', 'none') ?: 'none';

	config(['game-mode' => $request->input('mode', 'standard')]);

	$rom = new ALttP\Rom();
	if ($request->has('heart_speed')) {
		$rom->setHeartBeepSpeed($request->input('heart_speed'));
	}
	if ($request->has('sram_trace')) {
		$rom->setSRAMTrace($request->input('sram_trace') == 'true');
	}
	if ($request->has('debug')) {
		$rom->setDebugMode($request->input('debug') == 'true');
	}

	if ($request->has('tournament') && $request->input('tournament') == 'true') {
		config([
			"tournament-mode" => true,
		]);
		$rom->setTournamentType('standard');
	} else {
		$rom->setTournamentType('none');
	}

	$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

	$rand = new ALttP\Randomizer($difficulty, $request->input('logic', 'NoMajorGlitches'), $request->input('goal', 'ganon'), $variation);
	$rand->makeSeed($seed_id);
	$rand->writeToRom($rom);
	$seed = $rand->getSeed();
	$patch = $rom->getWriteLog();
	$spoiler = $rand->getSpoiler();
	$hash = $rand->saveSeedRecord();

	if ($request->has('tournament') && $request->input('tournament') == 'true') {
		$rom->setSeedString(str_pad(sprintf("VT TOURNEY %s", $hash), 21, ' '));
		$rom->rummageTable();
		$patch = patch_merge_minify($rom->getWriteLog());
		$rand->updateSeedRecordPatch($patch);
		$spoiler = array_except(array_only($spoiler, ['meta']), ['meta.seed']);
		$seed = $hash;
	}

	return json_encode([
		'seed' => $seed,
		'logic' => $rand->getLogic(),
		'difficulty' => $difficulty,
		'patch' => $patch,
		'spoiler' => $spoiler,
		'hash' => $hash,
	]);
});

Route::get('spoiler/{seed_id}', function(Request $request, $seed_id) {
	$difficulty = $request->input('difficulty', 'normal');
	if ($difficulty == 'custom') {
		config($request->input('data'));
	}
	$variation = $request->input('variation', 'none') ?: 'none';

	config(['game-mode' => $request->input('mode', 'standard')]);

	if ($request->has('tournament') && $request->input('tournament') == 'true') {
		config([
			"tournament-mode" => true,
		]);
	}

	$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

	$rand = new ALttP\Randomizer($difficulty, $request->input('logic', 'NoMajorGlitches'), $request->input('goal', 'ganon'), $variation);
	$rand->makeSeed($seed_id);
	return json_encode($rand->getSpoiler());
});

Route::get('h/{hash}', function(Request $request, $hash) {
	$seed = ALttP\Seed::where('hash', $hash)->first();
	if ($seed) {
		$build = ALttP\Build::where('build', $seed->build)->first();
		if (!$build) {
			abort(404);
		}
		return view('patch_from_hash', [
			'hash' => $hash,
			'md5' => $build->hash,
			'patch' => $build->patch,
		]);
	}
	abort(404);
});
