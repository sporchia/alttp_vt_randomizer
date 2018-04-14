<?php

use ALttP\Item;
use ALttP\Location;
use ALttP\Rom;
use ALttP\World;
use ALttP\Sprite;
use Illuminate\Http\Request;

Route::get('randomize{r?}', function () {
	return view('randomizer');
});

Route::get('randomizer/settings', function () {
	return config('alttp.randomizer.item');
});

Route::get('entrance/randomizer/settings', function () {
	return config('alttp.randomizer.entrance');
});

Route::get('base_rom/settings', function () {
	return [
		'rom_hash' => Rom::HASH,
		'base_file' => mix('js/base2current.json')->toHtml(),
	];
});

Route::get('sprites', function () {
	$sprites =  [];
	foreach (config('sprites') as $file => $info) {
		$sprites[] = [
			'name' => $info['name'],
			'author' => $info['author'],
			'file' => 'http://spr.beegunslingers.com/' . $file,
		];
	}
	return $sprites;
});

Route::get('entrance/randomize{r?}', function () {
	return view('entrance_randomizer', [
		'allow_quickswap' => true,
	]);
});

Route::get('customize{r?}', function () {
	$world = new World;
	$items = Item::all();
	$sprites = Sprite::all();
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
				&& !$item instanceof Item\BottleContents
				&& !in_array($item->getName(), [
					'BigKey',
					'Compass',
					'Key',
					'L2Sword',
					'Map',
					'multiRNG',
					'PowerStar',
					'singleRNG',
					'TwentyRupees2',
					'HeartContainerNoAnimation',
				]);
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
		'droppables' => $sprites->filter(function($sprite) {
			return $sprite instanceof Sprite\Droppable;
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
	return view('options');
});

Route::get('game_logics', function () {
	return view('options');
});

Route::get('game_difficulties', function () {
	return view('options');
});

Route::get('game_variations', function () {
	return view('options');
});

Route::get('game_entrance', function () {
	return view('game_entrance');
});

Route::get('info', function () {
	return redirect('help');
});

Route::get('help', function () {
	return view('start');
});

Route::get('updates', function () {
	return view('updates');
});

Route::get('start', function(Request $request) {
	return view('start');
});

Route::get('options', function(Request $request) {
	return view('options');
});

Route::get('resources', function(Request $request) {
	return view('resources');
});

Route::get('races', function(Request $request) {
	return view('races');
});

Route::get('watch', function(Request $request) {
	return view('watch');
});

Route::get('contribute', function(Request $request) {
	return view('contribute');
});

Route::get('calendar', function(Request $request) {
	return view('calendar');
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

Route::get('special', function () {
	return redirect('/');
});

Route::any('entrance/seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$difficulty = $request->input('difficulty', 'normal') ?: 'normal';
	$variation = $request->input('variation', 'none') ?: 'none';
	$goal = $request->input('goal', 'ganon') ?: 'ganon';
	$shuffle = $request->input('shuffle', 'full') ?: 'full';

	config(['game-mode' => $request->input('mode', 'standard')]);

	$rom = new ALttP\Rom();
	if ($request->filled('heart_speed')) {
		$rom->setHeartBeepSpeed($request->input('heart_speed'));
	}
	if ($request->filled('sram_trace')) {
		$rom->setSRAMTrace($request->input('sram_trace') == 'true');
	}
	if ($request->filled('menu_speed')) {
		$rom->setMenuSpeed($request->input('menu_speed', 'normal'));
	}
	if ($request->filled('debug')) {
		$rom->setDebugMode($request->input('debug') == 'true');
	}

	$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

	try {
		$rand = new ALttP\EntranceRandomizer($difficulty, 'noglitches', $goal, $variation, $shuffle);
		$rand->makeSeed($seed_id);
		$rand->writeToRom($rom);
		$seed = $rand->getSeed();
		$patch = $rom->getWriteLog();
		$spoiler = $rand->getSpoiler();
		$hash = $rand->saveSeedRecord();
	} catch (Exception $e) {
		report($e);
		return response('Failed', 409);
	}

	if ($request->filled('tournament') && $request->input('tournament') == 'true') {
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
		'patch' => patch_merge_minify($patch),
		'spoiler' => $spoiler,
		'hash' => $hash,
		'current_rom_hash' => Rom::HASH,
	]);
})->middleware('throttle:150,360');

Route::any('seed/{seed_id?}', function(Request $request, $seed_id = null) {
	$difficulty = $request->input('difficulty', 'normal') ?: 'normal';
	$variation = $request->input('variation', 'none') ?: 'none';
	$goal = $request->input('goal', 'ganon') ?: 'ganon';
	$logic = $request->input('logic', 'NoMajorGlitches') ?: 'NoMajorGlitches';
	$game_mode = $request->input('mode', 'standard');
	$weapons_mode = $request->input('weapons', 'randomized');
	$spoiler_meta = [];

	if ($difficulty == 'custom') {
		$purifier_settings = HTMLPurifier_Config::createDefault(config("purifier.default"));
		$purifier_settings->loadArray(config("purifier.default"));
		$purifier = new HTMLPurifier($purifier_settings);
		if ($request->filled('name')) {
			$markdowned = Markdown::convertToHtml(substr($request->input('name'), 0, 100));
			$spoiler_meta['name'] = $purifier->purify($markdowned);
		}
		if ($request->filled('notes')) {
			$markdowned = Markdown::convertToHtml(substr($request->input('notes'), 0, 300));
			$spoiler_meta['notes'] = $purifier->purify($markdowned);
		}
		config($request->input('data'));
		$world = new World($difficulty, $logic, $goal, $variation);
		$locations = $world->getLocations();
		foreach ($request->input('l', []) as $location => $item) {
			$decoded_location = base64_decode($location);
			if (isset($locations[$decoded_location])) {
				$place_item = Item::get($item);
				if ($weapons_mode == 'swordless' && $place_item instanceof Item\Sword) {
					$place_item = Item::get('TwentyRupees2');
				}
				$locations[$decoded_location]->setItem($place_item);
			}
		}
		foreach ($request->input('eq', []) as $item) {
			try {
				$place_item = Item::get($item);
				if ($weapons_mode == 'swordless' && $place_item instanceof Item\Sword) {
					$place_item = Item::get('TwentyRupees2');
				}
				$world->addPreCollectedItem($place_item);
			} catch (Exception $e) {}
		}

		foreach ($request->input('drops', []) as $pack => $item) {
			if ($item != 'auto_fill') {
				$parts = explode('-', $pack);
				$world->setDrop($parts[2], $parts[3], Sprite::get($item));
			}
		}
	}

	config([
		'game-mode' => $game_mode,
		'alttp.mode.weapons' => $weapons_mode,
	]);

	$rom = new ALttP\Rom();
	if ($request->filled('heart_speed')) {
		$rom->setHeartBeepSpeed($request->input('heart_speed'));
	}
	if ($request->filled('sram_trace')) {
		$rom->setSRAMTrace($request->input('sram_trace') == 'true');
	}
	if ($request->filled('menu_fast')) {
		$rom->setQuickMenu($request->input('menu_fast') == 'true');
	}
	if ($request->filled('debug')) {
		$rom->setDebugMode($request->input('debug') == 'true');
	}

	if ($request->filled('tournament') && $request->input('tournament') == 'true') {
		config([
			"tournament-mode" => true,
		]);
		$rom->setTournamentType('standard');
	} else {
		$rom->setTournamentType('none');
	}

	if (strtoupper($seed_id) == 'VANILLA') {
		config([
			'game-mode' => 'vanilla',
			'alttp.mode.weapons' => 'uncle',
		]);
		$world = $rom->writeVanilla();
		$rand = new ALttP\Randomizer('vanilla', 'NoMajorGlitches', 'ganon', 'none');
		$rand->setWorld($world);
		$rom->setRestrictFairyPonds(false);
		return json_encode([
			'seed' => 'vanilla',
			'logic' => $rand->getLogic(),
			'difficulty' => 'normal',
			'patch' => $rom->getWriteLog(),
			'spoiler' => $rand->getSpoiler(),
			'current_rom_hash' => Rom::HASH,
		]);
	}

	$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

	$rand = new ALttP\Randomizer($difficulty, $logic, $goal, $variation);
	if (isset($world)) {
		$rand->setWorld($world);
	}

	try {
		$rand->makeSeed($seed_id);
	} catch (Exception $e) {
		return response($e->getMessage(), 409);
	}

	$rand->writeToRom($rom);
	$seed = $rand->getSeed();

	if (!$rand->getWorld()->checkWinCondition()) {
		return response('Game Unwinnable', 409);
	}

	$patch = $rom->getWriteLog();
	$spoiler = $rand->getSpoiler($spoiler_meta);
	$hash = $rand->saveSeedRecord();

	if (config('enemizer.enabled', false)) {
		$en = new ALttP\Enemizer($rand);
		$en->makeSeed();
	}

	if ($request->filled('tournament') && $request->input('tournament') == 'true') {
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
		'current_rom_hash' => Rom::HASH,
	]);
})->middleware('throttle:150,360');

Route::get('spoiler/{seed_id}', function(Request $request, $seed_id) {
	$difficulty = $request->input('difficulty', 'normal');
	$variation = $request->input('variation', 'none') ?: 'none';
	$goal = $request->input('goal', 'ganon') ?: 'ganon';
	$logic = $request->input('logic', 'NoMajorGlitches') ?: 'NoMajorGlitches';
	$game_mode = $request->input('mode', 'standard');
	$weapons_mode = $request->input('weapons', 'randomized');

	if ($difficulty == 'custom') {
		config($request->input('data'));
	}

	config([
		'game-mode' => $game_mode,
		'alttp.mode.weapons' => $weapons_mode,
	]);

	if ($request->filled('tournament') && $request->input('tournament') == 'true') {
		config([
			"tournament-mode" => true,
		]);
	}

	$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

	$rand = new ALttP\Randomizer($difficulty, $logic, $goal, $variation);
	$rand->makeSeed($seed_id);
	return json_encode($rand->getSpoiler());
});

// @TODO: this is not DRY, perhaps it's time to move this and /seed to a controller
Route::any('test/{seed_id?}', function(Request $request, $seed_id = null) {
	$difficulty = $request->input('difficulty', 'normal') ?: 'normal';
	$variation = $request->input('variation', 'none') ?: 'none';
	$goal = $request->input('goal', 'ganon') ?: 'ganon';
	$logic = $request->input('logic', 'NoMajorGlitches') ?: 'NoMajorGlitches';
	$game_mode = $request->input('mode', 'standard');
	$weapons_mode = $request->input('weapons', 'randomized');
	$spoiler_meta = [];

	if ($difficulty == 'custom') {
		$purifier_settings = HTMLPurifier_Config::createDefault(config("purifier.default"));
		$purifier_settings->loadArray(config("purifier.default"));
		$purifier = new HTMLPurifier($purifier_settings);
		if ($request->filled('name')) {
			$markdowned = Markdown::convertToHtml(substr($request->input('name'), 0, 100));
			$spoiler_meta['name'] = $purifier->purify($markdowned);
		}
		if ($request->filled('notes')) {
			$markdowned = Markdown::convertToHtml(substr($request->input('notes'), 0, 300));
			$spoiler_meta['notes'] = $purifier->purify($markdowned);
		}
		config($request->input('data'));
		$world = new World($difficulty, $logic, $goal, $variation);
		$locations = $world->getLocations();
		foreach ($request->input('l', []) as $location => $item) {
			$decoded_location = base64_decode($location);
			if (isset($locations[$decoded_location])) {
				$place_item = Item::get($item);
				if ($weapons_mode == 'swordless' && $place_item instanceof Item\Sword) {
					$place_item = Item::get('TwentyRupees2');
				}
				$locations[$decoded_location]->setItem($place_item);
			}
		}
		foreach ($request->input('eq', []) as $item) {
			try {
				$place_item = Item::get($item);
				if ($weapons_mode == 'swordless' && $place_item instanceof Item\Sword) {
					$place_item = Item::get('TwentyRupees2');
				}
				$world->addPreCollectedItem($place_item);
			} catch (Exception $e) {}
		}
	}

	config([
		'game-mode' => $game_mode,
		'alttp.mode.weapons' => $weapons_mode,
	]);

	$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

	$rand = new ALttP\Randomizer($difficulty, $logic, $goal, $variation);
	if (isset($world)) {
		$rand->setWorld($world);
	}

	try {
		$rand->makeSeed($seed_id);
	} catch (Exception $e) {
		return response($e->getMessage(), 409);
	}

	$seed = $rand->getSeed();

	if (!$rand->getWorld()->checkWinCondition()) {
		return response('Game Unwinnable', 409);
	}

	return response()->json([
		'seed' => $seed,
		'logic' => $rand->getLogic(),
		'difficulty' => $difficulty,
		'spoiler' => $rand->getSpoiler($spoiler_meta),
	]);
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
