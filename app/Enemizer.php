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
	const VERSION = '6.0.33';
	private $randomizer;
	private $randomizer_patch;
	private $options_file;
	private $patch_file;
	private $rom_patch;
	private $settings;
	private $patch = [];
	protected $rng_seed;


	/**
	 * Create a new Enemizer
	 *
	 *
	 * @return void
	 */
	public function __construct(Randomizer $randomizer, array $rom_patch, array $settings) {
		$this->randomizer = $randomizer;

		$this->settings = $settings;
		$this->rom_patch = json_encode($rom_patch);
		$this->randomizer_patch = tempnam(sys_get_temp_dir(), 'vt_en_');
		$this->options_file = tempnam(sys_get_temp_dir(), 'vt_en_');
		$this->patch_file = tempnam(sys_get_temp_dir(), 'vt_en_');
	}

	public function makeSeed(int $rng_seed = null) {
		$rng_seed = $rng_seed ?: random_int(1, 999999999); // cryptographic pRNG for seeding
		$this->rng_seed = $rng_seed % 1000000000;

		$this->writeOptionsFile();

		file_put_contents($this->randomizer_patch, $this->rom_patch);

		$system = php_uname('s') == 'Darwin' ? 'osx' : 'linux';

		$proc = new Process(base_path("bin/enemizer/$system/EnemizerCLI.Core")
			. ' --rom ' . config('enemizer.base')
			. ' --seed ' . $this->rng_seed
			. ' --base ' . public_path('js/base2current.json')
			. ' --randomizer ' .  $this->randomizer_patch
			. ' --enemizer ' . $this->options_file
			. ' --output ' . $this->patch_file, base_path("bin/enemizer/$system"));

		logger()->debug($proc->getCommandLine());

		$proc->run(function ($type, $buffer) {
			logger()->debug((Process::ERR === $type) ? "ERR > $buffer" : "OUT > $buffer");
		});

		if (!$proc->isSuccessful()) {
			logger()->error($proc->getErrorOutput());
			throw new \Exception("Unable to generate");
		}

		$base_patch = json_decode(file_get_contents(base_path("bin/enemizer/$system/enemizerBasePatch.json")));
		$patch = json_decode(file_get_contents($this->patch_file));

		$this->patch = [];
		foreach ($base_patch as $write) {
			$this->patch[] = [$write->address => $write->patchData];
		}
		foreach ($patch as $write) {
			$this->patch[] = [$write->address => $write->patchData];
		}

		file_put_contents($this->patch_file, json_encode($this->patch));

		return $this;
	}

	public function writeOptionsFile() {
		$system = php_uname('s') == 'Darwin' ? 'osx' : 'linux';

		$options = [
			"RandomizeEnemies" => $this->settings['enemy'] ?? false,
			"RandomizeEnemiesType" => 3,
			"RandomizeBushEnemyChance" => true,
			"RandomizeEnemyHealthRange" => (bool) ($this->settings['enemy_health'] ?? false),
			"RandomizeEnemyHealthType" => ($this->settings['enemy_health'] ?? 0) - 1,
			"OHKO" => false,
			"RandomizeEnemyDamage" => $this->settings['enemy_damage'] != 'off',
			"AllowEnemyZeroDamage" => true,
			"ShuffleEnemyDamageGroups" => in_array($this->settings['enemy_damage'], ['shuffle', 'chaos']),
			"EnemyDamageChaosMode" => $this->settings['enemy_damage'] == 'chaos',
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
			"RandomizeBosses" => $this->randomizer->config('boss_shuffle', 'off') !== 'off',
			"RandomizeBossesType" => [
				'off' => 0,
				'basic' => 0,
				'normal' => 1,
				'chaos' => 2,
			][$this->randomizer->config('boss_shuffle', 'off')],
			"RandomizeBossHealth" => false,
			"RandomizeBossHealthMinAmount" => 0,
			"RandomizeBossHealthMaxAmount" => 300,
			"RandomizeBossDamage" => false,
			"RandomizeBossDamageMinAmount" => 0,
			"RandomizeBossDamageMaxAmount" => 200,
			"RandomizeBossBehavior" => false,
			"RandomizeDungeonPalettes" => $this->settings['palette_shuffle'] ?? false,
			"SetBlackoutMode" => false,
			"RandomizeOverworldPalettes" => $this->settings['palette_shuffle'] ?? false,
			"RandomizeSpritePalettes" => $this->settings['palette_shuffle'] ?? false,
			"SetAdvancedSpritePalettes" => false,
			"PukeMode" => false,
			"NegativeMode" => false,
			"GrayscaleMode" => false,
			"GenerateSpoilers" => false,
			"RandomizeLinkSpritePalette" => false,
			"RandomizePots" => $this->settings['pot_shuffle'] ?? false,
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
			"AllowKillableThief" => $this->settings['enemy'] ?? false,
			"RandomizeSpriteOnHit" => false,
			"DebugMode" => false,
			"DebugForceEnemy" => true,
			"DebugForceEnemyId" => 196,
			"DebugForceBoss" => false,
			"DebugForceBossId" => 4,
			"DebugOpenShutterDoors" => false,
			"DebugForceEnemyDamageZero" => true,
			"DebugShowRoomIdInRupeeCounter" => true,
			"UseManualBosses" => $this->randomizer->config('boss_shuffle', 'off') !== 'off',
		];

		if ($this->randomizer->config('boss_shuffle', 'off') !== 'off') {
			$world = $this->randomizer->getWorld();

			$options = array_merge($options, [
				"ManualBosses" => [
					"EasternPalace" => $world->getRegion('Eastern Palace')->getBoss()->getEName(),
					"DesertPalace" => $world->getRegion('Desert Palace')->getBoss()->getEName(),
					"TowerOfHera" => $world->getRegion('Tower of Hera')->getBoss()->getEName(),
					"AgahnimsTower" => "Agahnim",
					"PalaceOfDarkness" => $world->getRegion('Palace of Darkness')->getBoss()->getEName(),
					"SwampPalace" => $world->getRegion('Swamp Palace')->getBoss()->getEName(),
					"SkullWoods" => $world->getRegion('Skull Woods')->getBoss()->getEName(),
					"ThievesTown" => $world->getRegion('Thieves Town')->getBoss()->getEName(),
					"IcePalace" => $world->getRegion('Ice Palace')->getBoss()->getEName(),
					"MiseryMire" => $world->getRegion('Misery Mire')->getBoss()->getEName(),
					"TurtleRock" => $world->getRegion('Turtle Rock')->getBoss()->getEName(),
					"GanonsTower1" => $world->getRegion('Ganons Tower')->getBoss('bottom')->getEName(),
					"GanonsTower2" => $world->getRegion('Ganons Tower')->getBoss('middle')->getEName(),
					"GanonsTower3" => $world->getRegion('Ganons Tower')->getBoss('top')->getEName(),
					"GanonsTower4" => "Agahnim2",
					"Ganon" => "Ganon"
				],
			]);
		}

		file_put_contents($this->options_file, json_encode($options));
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
