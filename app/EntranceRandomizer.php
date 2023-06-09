<?php

namespace ALttP;

use ALttP\Contracts\Randomizer as RandomizerContract;
use Log;
use Symfony\Component\Process\Process;

/**
 * Main class for randomization. All the magic happens here. We use mt_rand as it is much faster than rand. Not all PHP
 * functions support mt_rand (e.g. array_shuffle), so those had to be cloned to maintain seed integrity.
 */
class EntranceRandomizer implements RandomizerContract
{
	const LOGIC = -1;
	const VERSION = '31.1';
	protected $world;
	/** @var array */
	private $boss_shuffle_lookup = [
		'simple' => 'basic',
		'full' => 'normal',
		'random' => 'chaos',
	];
	/** @var array */
	private $goal_lookup = [
		'ganon' => 'ganon',
		'fast_ganon' => 'crystals',
		'dungeons' => 'dungeons',
		'pedestal' => 'pedestal',
		'triforce-hunt' => 'triforcehunt',
		'completionist' => 'completionist',
	];
	/** @var array */
	private $swords_lookup = [
		'randomized' => 'random',
		'assured' => 'assured',
		'vanilla' => 'vanilla',
		'swordless' => 'swordless',
	];

	/**
	 * Create a new Entrance Randomizer. This currently only works with one
	 * world. So we use the first of the array passed in.
	 *
	 * @param array  $worlds  worlds to randomize
	 *
	 * @return void
	 */
	public function __construct(array $worlds)
	{
		$this->world = reset($worlds);

		if (!$this->world instanceof World) {
			throw new \OutOfBoundsException;
		}
	}

	/**
	 * Fill all empty Locations with Items using logic from the World. This is achieved by first setting up base
	 * portions of the world. Then taking the remaining empty locations we order them, and try to fill them in
	 * order in a way that opens more locations.
	 *
	 * @return void
	 */
	public function randomize(): void
	{
		$flags = [];
		if ($this->world->config('dungeonItems') === 'full') {
			$flags[] = '--keysanity';
		}

		$mode = 'standard';
		if ($this->world instanceof World\Open) {
			$mode = 'open';
		} elseif ($this->world instanceof World\Inverted) {
			$mode = 'inverted';
		}
		if ($this->world instanceof World\Retro) {
			$mode = 'open';
			$flags[] = '--retro';
		}

		switch ($this->world->config('logic')) {
			case 'no_logic':
				$logic = 'nologic';

				break;
			case 'none':
			default:
				$logic = 'noglitches';
		}

		if ($this->world->config('enemizer.bossShuffle') !== 'none') {
			$flags = array_merge($flags, [
				'--shufflebosses',
				$this->boss_shuffle_lookup[$this->world->config('enemizer.bossShuffle')],
			]);
		}

		if ($this->world->config('spoil.Hints') === 'on') {
			$flags[] = '--hint';
		}

		if ($this->world->config('rom.hudItemCounter') === true) {
			$flags[] = '--huditemcounter';
		}

		$proc = new Process(array_merge(
			[
				'python3.9',
				base_path('vendor/z3/entrancerandomizer/EntranceRandomizer.py'),
				'--mode',
				$mode,
				'--logic',
				$logic,
				'--accessibility',
				$this->world->config('accessibility'),
				'--swords',
				$this->swords_lookup[$this->world->config('mode.weapons')],
				'--goal',
				$this->goal_lookup[$this->world->config('goal')],
				'--difficulty',
				$this->world->config('item.pool'),
				'--item_functionality',
				$this->world->config('item.functionality'),
				'--shuffle',
				$this->world->config('entrances'),
				'--crystals_ganon',
				$this->world->config('crystals.ganon'),
				'--crystals_gt',
				$this->world->config('crystals.tower'),
				'--securerandom',
				'--jsonout',
				'--loglevel',
				'error',
			],
			$flags
		));

		Log::debug($proc->getCommandLine());
		$proc->run();

		if (!$proc->isSuccessful()) {
			Log::error($proc->getOutput());
			Log::error($proc->getErrorOutput());
			throw new \Exception("Unable to generate");
		}

		$er = json_decode($proc->getOutput());
		$patch = $er->patch;
		array_walk($patch, function (&$write, $address) {
			$write = [$address => $write];
		});
		$this->world->setOverridePatch(array_values((array) $patch));

		// possible temp fix
		$spoiler = json_decode($er->spoiler, true);
		$spoiler['meta']['build'] = Rom::BUILD;
		$spoiler['meta']['logic'] = 'er-no-glitches-' . static::VERSION;

		$this->world->setSpoiler($spoiler);

		if ($this->world->config('enemizer.bossShuffle') !== 'none') {
			$this->world->getRegion('Eastern Palace')->setBoss(Boss::get($spoiler['Bosses']['Eastern Palace'], $this->world));
			$this->world->getRegion('Desert Palace')->setBoss(Boss::get($spoiler['Bosses']['Desert Palace'], $this->world));
			$this->world->getRegion('Tower of Hera')->setBoss(Boss::get($spoiler['Bosses']['Tower Of Hera'], $this->world));
			$this->world->getRegion('Palace of Darkness')->setBoss(Boss::get($spoiler['Bosses']['Palace Of Darkness'], $this->world));
			$this->world->getRegion('Swamp Palace')->setBoss(Boss::get($spoiler['Bosses']['Swamp Palace'], $this->world));
			$this->world->getRegion('Skull Woods')->setBoss(Boss::get($spoiler['Bosses']['Skull Woods'], $this->world));
			$this->world->getRegion('Thieves Town')->setBoss(Boss::get($spoiler['Bosses']['Thieves Town'], $this->world));
			$this->world->getRegion('Ice Palace')->setBoss(Boss::get($spoiler['Bosses']['Ice Palace'], $this->world));
			$this->world->getRegion('Misery Mire')->setBoss(Boss::get($spoiler['Bosses']['Misery Mire'], $this->world));
			$this->world->getRegion('Turtle Rock')->setBoss(Boss::get($spoiler['Bosses']['Turtle Rock'], $this->world));
			$this->world->getRegion('Ganons Tower')->setBoss(Boss::get($spoiler['Bosses']['Ganons Tower Basement'], $this->world), 'bottom');
			$this->world->getRegion('Ganons Tower')->setBoss(Boss::get($spoiler['Bosses']['Ganons Tower Middle'], $this->world), 'middle');
			$this->world->getRegion('Ganons Tower')->setBoss(Boss::get($spoiler['Bosses']['Ganons Tower Top'], $this->world), 'top');
		}
	}

	/**
	 * Get all the worlds being randomized.
	 *
	 * @return array
	 */
	public function getWorlds(): array
	{
		return [$this->world];
	}
}
