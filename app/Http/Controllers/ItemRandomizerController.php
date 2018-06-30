<?php namespace ALttP\Http\Controllers;

use ALttP\Enemizer;
use ALttP\Item;
use ALttP\Randomizer;
use ALttP\Rom;
use ALttP\World;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Markdown;

class ItemRandomizerController extends Controller {
	public function generateSeed(Request $request, $seed_id = null) {
		try {
			return json_encode($this->prepSeed($request, $seed_id, true));
		} catch (Exception $e) {
			return response($e->getMessage(), 409);
		}
	}

	public function generateSpoiler(Request $request, $seed_id) {
		try {
			return json_encode($this->prepSeed($request, $seed_id)['spoiler']);
		} catch (Exception $e) {
			return response($e->getMessage(), 409);
		}
	}

	public function testGenerateSeed(Request $request, $seed_id = null) {
		try {
			return json_encode(array_except($this->prepSeed($request, $seed_id), ['patch', 'seed', 'hash']));
		} catch (Exception $e) {
			return response($e->getMessage(), 409);
		}
	}

	protected function prepSeed(Request $request, $seed_id = null, $save = false) {
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
			'alttp.mode.state' => $game_mode,
			'alttp.mode.weapons' => $weapons_mode,
		]);

		$rom = new Rom(env('ENEMIZER_BASE', null));
		if ($request->filled('heart_speed')) {
			$rom->setHeartBeepSpeed($request->input('heart_speed'));
		}
		if ($request->filled('sram_trace')) {
			$rom->setSRAMTrace($request->input('sram_trace') == 'true');
		}

		if ($request->filled('tournament') && $request->input('tournament') == 'true') {
			config([
				"tournament-mode" => true,
			]);
			$spoiler_meta['tournament'] = true;
			$rom->setTournamentType('standard');
		} else {
			$rom->setTournamentType('none');
		}

		if (strtoupper($seed_id) == 'VANILLA') {
			config([
				'alttp.mode.state' => 'vanilla',
				'alttp.mode.weapons' => 'uncle',
			]);
			$world = $rom->writeVanilla();
			$rand = new Randomizer('vanilla', 'NoMajorGlitches', 'ganon', 'none');
			$rand->setWorld($world);
			$rom->setRestrictFairyPonds(false);
			return [
				'seed' => 'vanilla',
				'logic' => $rand->getLogic(),
				'difficulty' => 'normal',
				'patch' => $rom->getWriteLog(),
				'spoiler' => $rand->getSpoiler(),
				'current_rom_hash' => Rom::HASH,
			];
		}

		$seed_id = is_numeric($seed_id) ? $seed_id : abs(crc32($seed_id));

		$rand = new Randomizer($difficulty, $logic, $goal, $variation);
		if (isset($world)) {
			$rand->setWorld($world);
		}

		$rand->makeSeed($seed_id);

		$rand->writeToRom($rom);
		$seed = $rand->getSeed();

		if (!$rand->getWorld()->checkWinCondition()) {
			throw new Exception('Game Unwinnable');
		}

		$patch = $rom->getWriteLog();
		$spoiler = $rand->getSpoiler($spoiler_meta);

		if (config('enemizer.enabled', false)) {
			$en = new Enemizer($rand);
			$en->makeSeed();
		}

		$hash = ($save) ? $rand->saveSeedRecord() : $seed;

		if ($request->filled('tournament') && $request->input('tournament') == 'true') {
			$rom->setSeedString(str_pad(sprintf("VT TOURNEY %s", $hash), 21, ' '));
			$rom->rummageTable();
			$patch = patch_merge_minify($rom->getWriteLog());
			if ($save) {
				$rand->updateSeedRecordPatch($patch);
			}
			$spoiler = array_except(array_only($spoiler, ['meta']), ['meta.seed']);
		}

		$seed = $hash;

		return [
			'seed' => $seed,
			'logic' => $rand->getLogic(),
			'difficulty' => $difficulty,
			'patch' => patch_merge_minify($patch),
			'spoiler' => $spoiler,
			'hash' => $hash,
			'current_rom_hash' => Rom::HASH,
		];
	}
}
