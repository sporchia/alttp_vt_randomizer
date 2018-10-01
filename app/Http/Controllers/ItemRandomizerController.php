<?php namespace ALttP\Http\Controllers;

use ALttP\Enemizer;
use ALttP\Item;
use ALttP\Jobs\SendPatchToDisk;
use ALttP\Randomizer;
use ALttP\Rom;
use ALttP\Sprite;
use ALttP\World;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Markdown;

class ItemRandomizerController extends Controller {
	public function generateSeed(Request $request, $seed_id = null) {
		if ($request->has('lang')) {
			app()->setLocale($request->input('lang'));
		}
		try {
			$payload = $this->prepSeed($request, $seed_id, true);
			$save_data = json_encode(array_except($payload, ['current_rom_hash', 'seed']));
			SendPatchToDisk::dispatch($payload['seed']);
			cache(['hash.' . $payload['hash'] => $save_data], now()->addDays(7));

			return json_encode(array_except($payload, ['seed']));
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
		$logic = $request->input('logic', 'NoGlitches') ?: 'NoGlitches';
		$game_mode = $request->input('mode', 'standard');
		$weapons_mode = $request->input('weapons', 'randomized');
		$enemizer = $request->input('enemizer', false);
		$spoilers = $request->input('spoilers', false);
		$tournament = $request->filled('tournament') && $request->input('tournament') == 'true';
		$spoiler_meta = [
			'_meta' => [
				'enemizer' => $enemizer,
				'size' => $enemizer ? 4 : 2,
				'spoilers' => $spoilers,
			],
		];
		if ($enemizer) {
			foreach ($enemizer as $key => $value) {
				if ($game_mode == 'standard' && in_array($key, ['enemy_health', 'enemy'])) {
					unset($enemizer[$key]);
					continue;
				}
				$spoiler_meta["enemizer_$key"] = $value;
			}
			if ($enemizer['bosses']) {
				config(['alttp.boss_shuffle' => $enemizer['bosses']]);
			}
		}

		if ($difficulty == 'custom') {
			$custom_data = array_dot($request->input('data'));
			// some simple validation
			// @TODO: move to validator type classes later
			if ($goal === 'triforce-hunt'
				&& ($custom_data['alttp.custom.item.Goal.Required'] ?? 0) > ($custom_data['alttp.custom.item.count.TriforcePiece'] ?? 0)) {
				throw new Exception("Not enough Triforce Pieces for the hunt");
			}

			$purifier_settings = HTMLPurifier_Config::createDefault(config("purifier.default"));
			$purifier_settings->loadArray(config("purifier.default"));
			$purifier = new HTMLPurifier($purifier_settings);
			if ($request->filled('name')) {
				$markdowned = Markdown::convertToHtml(substr($request->input('name'), 0, 100));
				$spoiler_meta['name'] = strip_tags($purifier->purify($markdowned));
			}
			if ($request->filled('notes')) {
				$markdowned = Markdown::convertToHtml(substr($request->input('notes'), 0, 300));
				$spoiler_meta['notes'] = $purifier->purify($markdowned);
			}

			$custom_data['alttp.custom.item.require.Lamp'] = $custom_data['alttp.custom.item.require.Lamp'] ? 0 : 1;
			config($custom_data);

			$world = World::factory($game_mode, $difficulty, $logic, $goal, $variation);
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

			foreach ($request->input('drops', []) as $pack => $items) {
				foreach ($items as $place => $item) {
					if ($item == 'auto_fill') {
						continue;
					}

					$world->setDrop($pack, $place, Sprite::get($item));
				}
			}
		}

		config([
			'alttp.mode.state' => $game_mode,
			'alttp.mode.weapons' => $weapons_mode,
		]);

		$rom = new Rom(env('ENEMIZER_BASE', null));
		$rom->applyPatchFile(public_path('js/base2current.json'));
		if ($request->filled('heart_speed')) {
			$rom->setHeartBeepSpeed($request->input('heart_speed'));
		}

		if ($tournament) {
			config([
				"tournament-mode" => true,
			]);
			$spoiler_meta['tournament'] = true;
		}

		$rom->setTournamentType('none');

		if (strtoupper($seed_id) == 'VANILLA') {
			config([
				'alttp.mode.state' => 'vanilla',
				'alttp.mode.weapons' => 'uncle',
			]);
			$world = $rom->writeVanilla();
			$rand = new Randomizer('vanilla', 'NoGlitches', 'ganon', 'none');
			$rand->setWorld($world);
			$rom->setRestrictFairyPonds(false);
			return [
				'logic' => $rand->getLogic(),
				'difficulty' => 'normal',
				'patch' => $rom->getWriteLog(),
				'spoiler' => $rand->getSpoiler(['name' => 'Vanilla']),
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

		if (!$rand->getWorld()->checkWinCondition()) {
			throw new Exception('Game Unwinnable');
		}

		$patch = $rom->getWriteLog();
		$spoiler = $rand->getSpoiler($spoiler_meta);

		$hash = ($save) ? $rand->saveSeedRecord() : 'none';
		$rom->setSeedString(str_pad(sprintf("VT %s", $hash), 21, ' '));

		if ($enemizer) {
			$en = new Enemizer($rand, $patch, $enemizer);
			$en->makeSeed();
			$en->writeToRom($rom);
			$patch = $rom->getWriteLog();
		}

		if ($tournament) {
			$rom->setTournamentType('standard');
			$rom->rummageTable();
			$patch = $rom->getWriteLog();
			if ($spoilers) {
				$spoiler = array_except($spoiler, ['playthrough']);
			} else {
				$spoiler = array_except(array_only($spoiler, ['meta']), ['meta.seed']);
			}
		}

		if ($save) {
			$rom->setStartScreenHash($rand->getSeedRecord()->hashArray());
			$patch = patch_merge_minify($rom->getWriteLog());
			$rand->updateSeedRecordPatch($patch);
		}

		return [
			'logic' => $rand->getLogic(),
			'difficulty' => $difficulty,
			'patch' => patch_merge_minify($patch),
			'spoiler' => array_except($spoiler, ['meta._meta']),
			'hash' => $hash,
			'size' => $enemizer ? 4 : 2,
			'generated' => $rand->getSeedRecord()->created_at ? $rand->getSeedRecord()->created_at->toIso8601String() : now()->toIso8601String(),
			'seed' => $rand->getSeedRecord(),
			'current_rom_hash' => Rom::HASH,
		];
	}
}
