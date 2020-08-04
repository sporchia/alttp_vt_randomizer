<?php

namespace ALttP;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

/**
 * Class to encapsulate the Enemizer. This will take a world and patch and apply
 * enemization to the patch to create an enemized version.
 */
class Enemizer
{
    /** @var string */
    const VERSION = '6.0.33';
    /** @var \ALttP\World */
    private $world;
    /** @var string */
    private $randomizer_patch;
    /** @var string */
    private $options_file;
    /** @var string */
    private $patch_file;
    /** @var string */
    private $rom_patch;
    /** @var array */
    private $patch = [];
    /** @var int */
    protected $rng_seed;

    /**
     * Create a new Enemizer
     *
     * @param \ALttP\World  $world  world to enemize
     * @param array  $rom_patch  the current rom patch
     *
     * @return void
     */
    public function __construct(World $world, array $rom_patch)
    {
        $this->world = $world;

        $this->rom_patch = json_encode($rom_patch);
        $this->randomizer_patch = tempnam(sys_get_temp_dir(), 'vt_en_');
        $this->options_file = tempnam(sys_get_temp_dir(), 'vt_en_');
        $this->patch_file = tempnam(sys_get_temp_dir(), 'vt_en_');
    }

    /**
     * Apply the enemizer.
     *
     * @throws \Exception
     *
     * @param int  $rng_seed  seed for enemizer
     *
     * @return $this
     */
    public function randomize(int $rng_seed = null)
    {
        $rng_seed = $rng_seed ?: random_int(1, 999999999); // cryptographic pRNG for seeding
        $this->rng_seed = $rng_seed % 1000000000;

        $this->writeOptionsFile();

        file_put_contents($this->randomizer_patch, $this->rom_patch);

        $system = php_uname('s') == 'Darwin' ? 'osx' : 'linux';

        $proc = new Process([
            base_path("bin/enemizer/$system/EnemizerCLI.Core"),
            '--rom',
            config('enemizer.base'),
            '--seed',
            $this->rng_seed,
            '--base',
            Rom::getJsonPatchLocation(),
            '--randomizer',
            $this->randomizer_patch,
            '--enemizer',
            $this->options_file,
            '--output',
            $this->patch_file,
        ], base_path("bin/enemizer/$system"));

        Log::debug($proc->getCommandLine());

        $proc->run(function ($type, $buffer) {
            Log::debug((Process::ERR === $type) ? "ERR > $buffer" : "OUT > $buffer");
        });

        if (!$proc->isSuccessful()) {
            Log::error($proc->getErrorOutput());

            throw new \Exception("Unable to generate");
        }

        $file_contents = file_get_contents(base_path("bin/enemizer/$system/enemizerBasePatch.json"));

        if ($file_contents === false) {
            Log::error('enemizer base not readable');

            throw new \Exception("Unable to generate");
        }

        $base_patch = json_decode($file_contents);

        $patch_contents = file_get_contents($this->patch_file);

        if ($patch_contents === false) {
            Log::error('enemizer patch not readable');

            throw new \Exception("Unable to generate");
        }

        $patch = json_decode($patch_contents);

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

    /**
     * Write an options json file to disk.
     *
     * @return void
     */
    public function writeOptionsFile()
    {
        $options = [
            "RandomizeEnemies" => $this->world->config('enemizer.enemyShuffle') !== 'none',
            "RandomizeEnemiesType" => 3,
            "RandomizeBushEnemyChance" => $this->world->config('enemizer.enemyShuffle') === 'random',
            "RandomizeEnemyHealthRange" => $this->world->config('enemizer.enemyHealth') !== 'default',
            "RandomizeEnemyHealthType" => [
                'easy' => 0,
                'default' => 1,
                'hard' => 2,
                'expert' => 3,
            ][$this->world->config('enemizer.enemyHealth')],
            "OHKO" => false,
            "RandomizeEnemyDamage" => $this->world->config('enemizer.enemyDamage') !== 'default',
            "AllowEnemyZeroDamage" => true,
            "ShuffleEnemyDamageGroups" => in_array($this->world->config('enemizer.enemyDamage'), ['shuffled', 'random']),
            "EnemyDamageChaosMode" => $this->world->config('enemizer.enemyDamage') === 'random',
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
            "RandomizeBosses" => $this->world->config('enemizer.bossShuffle') !== 'none',
            "RandomizeBossesType" => [
                'none' => 0,
                'simple' => 0,
                'full' => 1,
                'random' => 2,
            ][$this->world->config('enemizer.bossShuffle')],
            "RandomizeBossHealth" => false,
            "RandomizeBossHealthMinAmount" => 0,
            "RandomizeBossHealthMaxAmount" => 300,
            "RandomizeBossDamage" => false,
            "RandomizeBossDamageMinAmount" => 0,
            "RandomizeBossDamageMaxAmount" => 200,
            "RandomizeBossBehavior" => false,
            "RandomizeDungeonPalettes" => false,
            "SetBlackoutMode" => false,
            "RandomizeOverworldPalettes" => false,
            "RandomizeSpritePalettes" => false,
            "SetAdvancedSpritePalettes" => false,
            "PukeMode" => false,
            "NegativeMode" => false,
            "GrayscaleMode" => false,
            "GenerateSpoilers" => false,
            "RandomizeLinkSpritePalette" => false,
            "RandomizePots" => $this->world->config('enemizer.potShuffle') === 'on',
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
            "RandomizeTileTrapPattern" => $this->world->config('enemizer.enemyShuffle') === 'random',
            "RandomizeTileTrapFloorTile" => false,
            "AllowKillableThief" => $this->world->config('enemizer.enemyShuffle') === 'random'
                ? (bool) get_random_int(0, 1)
                : $this->world->config('enemizer.enemyShuffle') !== 'none',
            "RandomizeSpriteOnHit" => false,
            "DebugMode" => false,
            "DebugForceEnemy" => true,
            "DebugForceEnemyId" => 196,
            "DebugForceBoss" => false,
            "DebugForceBossId" => 4,
            "DebugOpenShutterDoors" => false,
            "DebugForceEnemyDamageZero" => true,
            "DebugShowRoomIdInRupeeCounter" => true,
            "UseManualBosses" => $this->world->config('enemizer.bossShuffle') !== 'none',
        ];

        if ($this->world->config('enemizer.bossShuffle') !== 'none') {
            $world = $this->world;

            $options = array_merge($options, [
                "ManualBosses" => [
                    "EasternPalace" => $world->getRegion('Eastern Palace')->getBoss('')->getEName(),
                    "DesertPalace" => $world->getRegion('Desert Palace')->getBoss('')->getEName(),
                    "TowerOfHera" => $world->getRegion('Tower of Hera')->getBoss('')->getEName(),
                    "AgahnimsTower" => "Agahnim",
                    "PalaceOfDarkness" => $world->getRegion('Palace of Darkness')->getBoss('')->getEName(),
                    "SwampPalace" => $world->getRegion('Swamp Palace')->getBoss('')->getEName(),
                    "SkullWoods" => $world->getRegion('Skull Woods')->getBoss('')->getEName(),
                    "ThievesTown" => $world->getRegion('Thieves Town')->getBoss('')->getEName(),
                    "IcePalace" => $world->getRegion('Ice Palace')->getBoss('')->getEName(),
                    "MiseryMire" => $world->getRegion('Misery Mire')->getBoss('')->getEName(),
                    "TurtleRock" => $world->getRegion('Turtle Rock')->getBoss('')->getEName(),
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
    public function writeToRom(Rom $rom)
    {
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
    public function __destruct()
    {
        unlink($this->randomizer_patch);
        unlink($this->options_file);
        unlink($this->patch_file);
    }
}
