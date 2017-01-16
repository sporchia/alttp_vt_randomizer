<?php

use Illuminate\Http\Request;

Route::get('/', function () {
	return view('randomizer');
});

Route::get('about', function () {
	return view('about');
});

Route::get('stuck', function () {
	return view('stuck');
});

Route::any('seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$rules = $request->input('rules', 'v7');
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
	return json_encode(['seed' => $rand->getSeed(), 'logic' => $rand->getLogic(), 'rules' => $rules, 'patch' => $rom->getWriteLog(), 'spoiler' => $rand->getSpoiler()]);
});

Route::get('spoiler/{seed_id}', function(Request $request, $seed_id) {
	$rules = $request->input('rules', 'v7');
	if ($rules == 'custom') {
		config($request->input('data'));
	}
	$rand = new ALttP\Randomizer($rules);
	$rand->makeSeed($seed_id);
	return json_encode($rand->getSpoiler());
});

