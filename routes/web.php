<?php

use ALttP\Item;
use ALttP\Location;
use ALttP\World;
use Illuminate\Http\Request;

Route::get('randomize{r?}', function () {
	return view('randomizer');
});

Route::get('special', function () {
	return view('special', [
		'rom_hash' => '39e4e1fb134cb82aa34df7399d4125db',
		'rom_patch' => 'js/base-39e4e1fb134cb82aa34df7399d4125db.json',
	]);
});

Route::get('entrance/randomize{r?}', function () {
	return view('entrance_randomizer');
});

Route::get('customize{r?}', function () {
	$world = new World;
	$items = Item::all();
	return view('customizer', [
		'world' => $world,
		'location_class' => [
			Location\Prize\Pendant::class => 'prizes',
			Location\Prize\Crystal::class => 'prizes',
			Location\Medallion::class => 'medallions',
			Location\Fountain::class => 'bottles',
		],
		'items' => $items->filter(function($item) {
			return !$item instanceof Item\Pendant
				&& !$item instanceof Item\Crystal
				&& !$item instanceof Item\Event
				&& !$item instanceof Item\Programmable
				&& !in_array($item->getName(), ['L2Sword', 'singleRNG', 'multiRNG']);
		}),
		'prizes' => $items->filter(function($item) {
			return $item instanceof Item\Pendant
				|| $item instanceof Item\Crystal;
		}),
		'medallions' => $items->filter(function($item) {
			return $item instanceof Item\Medallion;
		}),
		'bottles' => $items->filter(function($item) {
			return $item instanceof Item\Bottle;
		}),
	]);
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

Route::get('game_variations', function () {
	return view('game_variations');
});

Route::get('game_entrance', function () {
	return view('game_entrance');
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
	$variation = $request->input('variation', 'none') ?: 'none';

	config(['game-mode' => $request->input('mode', 'standard')]);

	$rom = new ALttP\Rom();
	if ($request->has('heart_speed')) {
		$rom->setHeartBeepSpeed($request->input('heart_speed'));
	}
	if ($request->has('sram_trace')) {
		$rom->setSRAMTrace($request->input('sram_trace') == 'true');
	}
	if ($request->has('menu_fast')) {
		$rom->setQuickMenu($request->input('menu_fast') == 'true');
	}
	if ($request->has('debug')) {
		$rom->setDebugMode($request->input('debug') == 'true');
	}

	try {
		$rand = new ALttP\EntranceRandomizer($difficulty, 'noglitches', $request->input('goal', 'ganon'), $variation, $request->input('shuffle', 'full'));
		$rand->makeSeed($seed_id);
		$rand->writeToRom($rom);
		$seed = $rand->getSeed();
		$patch = $rom->getWriteLog();
		$spoiler = $rand->getSpoiler();
		$hash = $rand->saveSeedRecord();
	} catch (Exception $e) {
		return response('Failed', 409);
	}

	if ($request->has('tournament') && $request->input('tournament') == 'true') {
		$rom->setSeedString(str_pad(sprintf("ER TOURNEY %s", $hash), 21, ' '));
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

Route::any('seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$difficulty = $request->input('difficulty', 'normal') ?: 'normal';
	$variation = $request->input('variation', 'none') ?: 'none';

	if ($difficulty == 'custom') {
		config($request->input('data'));
		$world = new World($difficulty, $request->input('logic', 'NoMajorGlitches'), $request->input('goal', 'ganon'), $variation);
		$locations = $world->getLocations();
		foreach ($request->input('l', []) as $location => $item) {
			$decoded_location = base64_decode($location);
			if (isset($locations[$decoded_location])) {
				$locations[$decoded_location]->setItem(Item::get($item));
			}
		}
	}

	config(['game-mode' => $request->input('mode', 'standard')]);

	$rom = new ALttP\Rom();
	if ($request->has('heart_speed')) {
		$rom->setHeartBeepSpeed($request->input('heart_speed'));
	}
	if ($request->has('sram_trace')) {
		$rom->setSRAMTrace($request->input('sram_trace') == 'true');
	}
	if ($request->has('menu_fast')) {
		$rom->setQuickMenu($request->input('menu_fast') == 'true');
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

	if (strtoupper($seed_id) == 'VANILLA') {
		config(['game-mode' => 'vanilla']);
		$world = $rom->writeVanilla();
		$rand = new ALttP\Randomizer('vanilla', 'NoMajorGlitches', 'ganon', 'none');
		$rand->setWorld($world);
		return json_encode([
			'seed' => 'vanilla',
			'logic' => $rand->getLogic(),
			'difficulty' => 'normal',
			'patch' => $rom->getWriteLog(),
			'spoiler' => $rand->getSpoiler(),
		]);
	}

	$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

	$rand = new ALttP\Randomizer($difficulty, $request->input('logic', 'NoMajorGlitches'), $request->input('goal', 'ganon'), $variation);
	if ($request->input('special') == 'true') {
		$rand = new ALttP\SpecialRandomizer($difficulty, $request->input('logic', 'NoMajorGlitches'), $request->input('goal', 'ganon'), $variation);
	}

	if (isset($world)) {
		$rand->setWorld($world);
	}

	$rand->makeSeed($seed_id);
	$rand->writeToRom($rom);
	$seed = $rand->getSeed();

	if (!$rand->getWorld()->checkWinCondition()) {
		return response('Failed', 409);
	}

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
		'patch' => patch_merge_minify($patch),
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
