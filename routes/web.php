<?php

use Illuminate\Http\Request;

Route::get('randomize{r?}', function () {
	return view('randomizer');
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

Route::get('info', function () {
	return view('info');
});

Route::get('stuck', function () {
	return view('stuck');
});

Route::get('help', function () {
	return view('help');
});

Route::any('hash/{hash}', function(Request $request, $hash) {
	$seed = ALttP\Seed::where('hash', $hash)->first();
	if ($seed) {
		return json_encode([
			'logic' => $seed->logic,
			'rules' => $seed->rules,
			'patch' => json_decode($seed->patch),
			'spoiler' => array_except(array_only(json_decode($seed->spoiler, true), ['meta']), ['meta.seed']),
			'hash' => $seed->hash,
		]);
	}
	abort(404);
});

Route::any('seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$rules = $request->input('rules', 'v8');
	if ($rules == 'custom') {
		config($request->input('data'));
	}
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

	$rand = new ALttP\Randomizer($rules, $request->input('game_mode', 'NoMajorGlitches'));
	$rand->makeSeed($seed_id);
	$rand->writeToRom($rom);

	return json_encode([
		'seed' => $rand->getSeed(),
		'logic' => $rand->getLogic(),
		'rules' => $rules,
		'patch' => $rom->getWriteLog(),
		'spoiler' => $rand->getSpoiler(),
		'hash' => $rand->saveSeedRecord(),
	]);
});

Route::get('spoiler/{seed_id}', function(Request $request, $seed_id) {
	$rules = $request->input('rules', 'v8');
	if ($rules == 'custom') {
		config($request->input('data'));
	}
	$rand = new ALttP\Randomizer($rules, $request->input('game_mode', 'NoMajorGlitches'));
	$rand->makeSeed($seed_id);
	return json_encode($rand->getSpoiler());
});

Route::get('h/{hash}', function(Request $request, $hash) {
	$seed = ALttP\Seed::where('hash', $hash)->first();
	if ($seed) {
		$build = ALttP\Build::where('build', $seed->build)->first();
		return view('patch_from_hash', [
			'hash' => $hash,
			'md5' => $build->hash,
			'patch' => $build->patch,
		]);
	}
	abort(404);
});
