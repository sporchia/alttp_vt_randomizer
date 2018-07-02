<?php namespace ALttP\Console\Commands;

use ALttP\Item;
use ALttP\Randomizer;
use ALttP\Rom;
use ALttP\World;
use ALttP\Support\Zspr;
use Illuminate\Console\Command;

class Randomize extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:randomize {input_file : base rom to randomize}'
		. ' {output_directory : where to place randomized rom}'
		. ' {--unrandomized : do not apply randomization to the rom}'
		. ' {--vanilla : set game to vanilla item locations}'
		. ' {--debug : enable BAGE mode}'
		. ' {--spoiler : generate a spoiler file}'
		. ' {--difficulty=normal : set difficulty}'
		. ' {--variation=none : set variation}'
		. ' {--logic=NoMajorGlitches : set logic}'
		. ' {--sm-logic=Tournament : set SM logic}'
		. ' {--heartbeep=half : set heart beep speed}'
		. ' {--skip-md5 : do not validate md5 of base rom}'
		. ' {--trace : enable SRAM trace}'
		. ' {--seed= : set seed number}'
		. ' {--bulk=1 : generate multiple roms}'
		. ' {--goal=ganon : set game goal}'
		. ' {--mode=standard : set game mode}'
		. ' {--weapons=randomized : set weapons mode}'
		. ' {--sprite= : sprite file to change links graphics [zspr format]}'
		. ' {--no-rom : no not generate output rom}'
		. ' {--no-music : mute all music}'
		. ' {--menu-speed=normal : menu speed}'
		. ' {--morph=randomized : \'vanilla\' for vanilla Morph Ball location}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a randomized rom.';

	protected $reset_patch;

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if (!is_readable($this->argument('input_file'))) {
			return $this->error('Source File not readable');
		}

		if (!is_dir($this->argument('output_directory')) || !is_writable($this->argument('output_directory'))) {
			return $this->error('Target Directory not writable');
		}

		$bulk = ($this->option('seed') == null) ? $this->option('bulk') : 1;

		for ($i = 0; $i < $bulk; $i++) {
			$rom = new Rom($this->argument('input_file'));

			if (!$this->option('skip-md5') && !$rom->checkMD5()) {
				$rom->resize();

				$rom->applyPatch($this->resetPatch());
			}

			if (!$this->option('skip-md5') && !$rom->checkMD5()) {
				return $this->error('MD5 check failed :(');
			}
			
			config([
				'game-mode' => $this->option('mode'),
				'variation' => $this->option('variation'),
				'alttp.mode.weapons' => $this->option('weapons'),
			]);

			$rom->setDebugMode($this->option('debug'));

			$rom->setHeartBeepSpeed($this->option('heartbeep'));

			$rom->setSRAMTrace($this->option('trace'));

			// break out for unrandomized/vanilla base game
			if ($this->option('vanilla')) {
				$rom->writeVanilla();
				$output_file = sprintf('%s/alttp-%s-vanilla.sfc', $this->argument('output_directory'), Rom::BUILD);
				$rom->save($output_file);
				return $this->info(sprintf('Rom Saved: %s', $output_file));
			}
			if ($this->option('unrandomized')) {
				$output_file = sprintf('%s/alttp-%s.sfc', $this->argument('output_directory'), Rom::BUILD);
				$rom->save($output_file);
				return $this->info(sprintf('Rom Saved: %s', $output_file));
			}

			
			$rand = new Randomizer($this->option('difficulty'), $this->option('logic'), $this->option('goal'), $this->option('variation'), $this->option('sm-logic'));
			$rand->setMorph($this->option('morph'));
			$rand->makeSeed($this->option('seed'));

			$rand->writeToRom($rom);
			$rom->muteMusic($this->option('no-music', false));
			$rom->setMenuSpeed($this->option('menu-speed', 'normal'));

			$output_file = sprintf($this->argument('output_directory') . '/' . 'sm_alttp - total_VT_%s_%s_%s_%s_%s_%s_%s.sfc',
				$rand->getSMLogic(), $rand->getLogic(), $this->option('difficulty'), config('game-mode'), $this->option('weapons'), $this->option('variation'), $rand->getSeed());
			if (!$this->option('no-rom', false)) {
				if ($this->option('sprite') && is_readable($this->option('sprite'))) {
					$this->info("sprite");
					try {
						$zspr = new Zspr($this->option('sprite'));

						$rom->write(0x80000, $zspr->getPixelData(), false);
						$rom->write(0xDD308, substr($zspr->getPaletteData(), 0, 120), false);
						$rom->write(0xDEDF5, substr($zspr->getPaletteData(), 120, 4), false);
					} catch (\Exception $e) {
						return $this->error("Sprite not in ZSPR format");
					}
				}
				$rom->updateChecksum();
				$rom->save($output_file);
				$this->info(sprintf('Rom Saved: %s', $output_file));
			}
			if ($this->option('spoiler')) {
				$spoiler_file = sprintf($this->argument('output_directory') . '/' . 'sm_alttp - total_VT_%s_%s_%s_%s_%s_%s_%s.txt',
					$rand->getSMLogic(), $rand->getLogic(), $this->option('difficulty'), config('game-mode'), $this->option('weapons'), $this->option('variation'), $rand->getSeed());
				file_put_contents($spoiler_file, json_encode($rand->getSpoiler(), JSON_PRETTY_PRINT));
				$this->info(sprintf('Spoiler Saved: %s', $spoiler_file));
			}
		}
	}

	protected function resetPatch() {
		if ($this->reset_patch) {
			return $this->reset_patch;
		}

		if (is_readable(public_path('js/base2current.json'))) {
			$patch_left = json_decode(file_get_contents(public_path('js/base2current.json')), true);
		}

		$this->reset_patch = patch_merge_minify($patch_left);

		return $this->reset_patch;
	}
}
