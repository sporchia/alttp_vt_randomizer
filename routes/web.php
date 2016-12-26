<?php

use Illuminate\Http\Request;

Route::get('/', function () {
	return view('randomizer');
});

Route::get('about', function () {
	return view('about');
});

Route::any('seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$rules = $request->input('rules', 'v7');
	if ($rules == 'custom') {
		config($request->input('data'));
	}
	$rom = new ALttP\Rom();
	$rand = new ALttP\Randomizer($rules);
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

