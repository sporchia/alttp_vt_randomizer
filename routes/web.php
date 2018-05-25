<?php

use Illuminate\Http\Request;

Route::view('/', 'about');

Route::view('about', 'about');

Route::get('base_rom/settings', 'SettingsController@rom');

Route::view('calendar', 'calendar');

Route::view('contribute', 'contribute');

Route::view('customize{r?}', 'customizer');

Route::get('customizer/settings', 'SettingsController@customizer');

Route::view('entrance/randomize{r?}', 'entrance_randomizer');

Route::get('entrance/randomizer/settings', 'SettingsController@entrance');

Route::any('entrance/seed/{seed_id?}', 'EntranceRandomizerController@generateSeed')->middleware('throttle:150,360');

Route::view('game_modes', 'options');

Route::view('game_logics', 'options');

Route::view('game_difficulties', 'options');

Route::view('game_variations', 'options');

Route::view('game_entrance', 'game_entrance');

Route::view('help', 'start');

Route::redirect('info', 'help');

Route::view('options', 'options');

Route::view('races', 'races');

Route::view('randomize{r?}', 'randomizer');

Route::get('randomizer/settings', 'SettingsController@item');

Route::view('resources', 'resources');

Route::any('seed/{seed_id?}', 'ItemRandomizerController@generateSeed')->middleware('throttle:150,360');

Route::redirect('special', '/');

Route::get('spoiler/{seed_id}', 'ItemRandomizerController@generateSpoiler');

Route::get('sprites', 'SettingsController@sprites');

Route::view('start', 'start');

Route::any('test/{seed_id?}', 'ItemRandomizerController@testGenerateSeed');

Route::view('updates', 'updates');

Route::view('watch', 'watch');

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
			'seed' => $seed,
		]);
	}
	abort(404);
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

Route::get('daily', function(Request $request) {
	$featured = ALttP\FeaturedGame::today();
	if (!$featured) {
		$exitCode = Artisan::call('alttp:dailies', ['days' => 1]);
		$featured = ALttP\FeaturedGame::today();
	}
	$seed = $featured->seed;
	if ($seed) {
		$build = ALttP\Build::where('build', $seed->build)->first();
		if (!$build) {
			abort(404);
		}
		return view('daily', [
			'hash' => $seed->hash,
			'md5' => $build->hash,
			'patch' => $build->patch,
			'daily' => $featured->day,
		]);
	}
	abort(404);
});
