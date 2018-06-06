<?php namespace ALttP;

use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use Log;
use Symfony\Component\Process\Process;

/**
 * Main class for randomization. All the magic happens here. We use mt_rand as it is much faster than rand. Not all PHP
 * functions support mt_rand (e.g. array_shuffle), so those had to be cloned to maintain seed integrity.
 */
class Enemizer {
	const VERSION = '6.0.29';
	private $randomizer;
	private $randomizer_patch;
	private $options_file;
	private $patch_file;
	private $patch = [];
	protected $rng_seed;


	/**
	 * Create a new Enemizer
	 *
	 *
	 * @return void
	 */
	public function __construct(Randomizer $randomizer) {
		$this->randomizer = $randomizer;

		$this->randomizer_patch = tempnam(sys_get_temp_dir(), 'vt_en_');
		$this->options_file = tempnam(sys_get_temp_dir(), 'vt_en_');
		$this->patch_file = tempnam(sys_get_temp_dir(), 'vt_en_');
	}

	public function makeSeed(int $rng_seed = null) {
		$rng_seed = $rng_seed ?: random_int(1, 999999999); // cryptographic pRNG for seeding
		$this->rng_seed = $rng_seed % 1000000000;

		$this->writeOptionsFile();

		file_put_contents($this->randomizer_patch, $this->randomizer->getSeedRecord()->patch);

		$proc = new Process(env('DOTNET_COMMAND') . ' '
			. base_path('vendor/z3/enemizer/Release/publish/EnemizerCLI.Core.dll')
			. ' --rom ' . config('enemizer.base')
			. ' --seed ' . $this->rng_seed
			. ' --base ' . public_path('js/base2current.json')
			. ' --randomizer ' .  $this->randomizer_patch
			. ' --enemizer ' . $this->options_file
			. ' --output ' . $this->patch_file, base_path('vendor/z3/enemizer/Release/'));

		$proc->run();

		if (!$proc->isSuccessful()) {
			throw new \Exception("Unable to generate");
		}
		$patch = json_decode(file_get_contents($this->patch_file));

		$this->patch = [];
		foreach ($patch as $write) {
			$this->patch[] = [$write->address => $write->patchData];
		}

		file_put_contents($this->patch_file, json_encode($this->patch));

		return $this;
	}

	public function writeOptionsFile() {
		file_put_contents($this->options_file, json_encode([
			"RandomizeEnemies" => true,
			"RandomizeEnemiesType" => 3,
			"RandomizeBushEnemyChance" => true,
			"RandomizeEnemyHealthRange" => true,
			"RandomizeEnemyHealthType" => 1,
			"OHKO" => false,
			"RandomizeEnemyDamage" => true,
			"AllowEnemyZeroDamage" => true,
			"ShuffleEnemyDamageGroups" => false,
			"EnemyDamageChaosMode" => false,
			"EasyModeEscape" => false,
			"EnemiesAbsorbable" => false,
			"AbsorbableSpawnRate" => 10,
			"AbsorbableTypes" => [
				"FullMagic" => true,
				"SmallMagic" => true,
				"Bomb_1" => true,
				"BlueRupee" => true,
				"Heart" => true,
				"BigKey" => true,
				"Key" => true,
				"Fairy" => true,
				"Arrow_10" => true,
				"Arrow_5" => true,
				"Bomb_8" => true,
				"Bomb_4" => true,
				"GreenRupee" => true,
				"RedRupee" => true,
			],
			"BossMadness" => false,
			"RandomizeBosses" => false,
			"RandomizeBossesType" => 0,
			"RandomizeBossHealth" => false,
			"RandomizeBossHealthMinAmount" => 0,
			"RandomizeBossHealthMaxAmount" => 300,
			"RandomizeBossDamage" => false,
			"RandomizeBossDamageMinAmount" => 0,
			"RandomizeBossDamageMaxAmount" => 200,
			"RandomizeBossBehavior" => false,
			"RandomizeDungeonPalettes" => true,
			"SetBlackoutMode" => false,
			"RandomizeOverworldPalettes" => true,
			"RandomizeSpritePalettes" => true,
			"SetAdvancedSpritePalettes" => false,
			"PukeMode" => false,
			"NegativeMode" => false,
			"GrayscaleMode" => false,
			"GenerateSpoilers" => true,
			"RandomizeLinkSpritePalette" => false,
			"RandomizePots" => true,
			"ShuffleMusic" => false,
			"BootlegMagic" => true,
			"CustomBosses" => false,
			"AndyMode" => false,
			"HeartBeepSpeed" => 2,
			"AlternateGfx" => false,
			"ShieldGraphics" => "shield_gfx/normal.gfx",
			"SwordGraphics" => "sword_gfx/normal.gfx",
			"BeeMizer" => false,
			"BeesLevel" => 3,
			"RandomizeTileTrapPattern" => true,
			"RandomizeTileTrapFloorTile" => false,
			"AllowKillableThief" => true,
			"RandomizeSpriteOnHit" => false,
			"DebugMode" => false,
			"DebugForceEnemy" => true,
			"DebugForceEnemyId" => 196,
			"DebugForceBoss" => false,
			"DebugForceBossId" => 4,
			"DebugOpenShutterDoors" => false,
			"DebugForceEnemyDamageZero" => true,
			"DebugShowRoomIdInRupeeCounter" => true,
		]));
	}

	/**
	 * write the current generated data to the Rom
	 *
	 * @param Rom $rom Rom to write data to
	 *
	 * @return Rom
	 */
	public function writeToRom(Rom $rom) {
		foreach ($this->patch as $writes) {
			foreach ($writes as $address => $bytes) {
				$rom->write($address, pack('C*', ...$bytes));
			}
		}

		return $rom;
	}

	/**
	 * Object destruction magic method
	 *
	 * @return void
	 */
	public function __destruct() {
		unlink($this->randomizer_patch);
		unlink($this->options_file);
		unlink($this->patch_file);
	}
}
