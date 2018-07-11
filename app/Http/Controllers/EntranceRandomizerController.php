<?php namespace ALttP\Http\Controllers;

use ALttP\Enemizer;
use ALttP\EntranceRandomizer;
use ALttP\Rom;
use Illuminate\Http\Request;

class EntranceRandomizerController extends Controller {
	public function generateSeed(Request $request, $seed_id = null) {
		return json_encode($this->prepSeed($request, $seed_id, true));
	}

	public function generateSpoiler(Request $request, $seed_id) {
		return json_encode($this->prepSeed($request, $seed_id)['spoiler']);
	}

	public function testGenerateSeed(Request $request, $seed_id = null) {
		return json_encode(array_except($this->prepSeed($request, $seed_id), ['patch']));
	}

	protected function prepSeed(Request $request, $seed_id = null, $save = false) {
		$difficulty = $request->input('difficulty', 'normal') ?: 'normal';
		$variation = $request->input('variation', 'none') ?: 'none';
		$goal = $request->input('goal', 'ganon') ?: 'ganon';
		$shuffle = $request->input('shuffle', 'full') ?: 'full';

		config(['alttp.mode.state' => $request->input('mode', 'standard')]);

		$rom = new Rom(env('ENEMIZER_BASE', null));
		$rom->applyPatchFile(public_path('js/base2current.json'));
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
			$rand = new EntranceRandomizer($difficulty, 'noglitches', $goal, $variation, $shuffle);
			$rand->makeSeed($seed_id);
			$rand->writeToRom($rom);
			$seed = $rand->getSeed();
			$patch = $rom->getWriteLog();
			$spoiler = $rand->getSpoiler();
			$hash = ($save) ? $rand->saveSeedRecord() : $seed;
		} catch (Exception $e) {
			report($e);
			return response('Failed', 409);
		}

		if ($request->filled('tournament') && $request->input('tournament') == 'true') {
			$rom->setSeedString(str_pad(sprintf("ER TOURNEY %s", $hash), 21, ' '));
			$patch = patch_merge_minify($rom->getWriteLog());
			if ($save) {
				$rand->updateSeedRecordPatch($patch);
			}
			$spoiler = array_except(array_only($spoiler, ['meta']), ['meta.seed']);
			$seed = $hash;
		}

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
