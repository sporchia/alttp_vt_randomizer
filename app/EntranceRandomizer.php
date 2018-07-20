<?php namespace ALttP;

use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use Log;
use Symfony\Component\Process\Process;

/**
 * Main class for randomization. All the magic happens here. We use mt_rand as it is much faster than rand. Not all PHP
 * functions support mt_rand (e.g. array_shuffle), so those had to be cloned to maintain seed integrity.
 */
class EntranceRandomizer extends Randomizer {
	const LOGIC = -1;
	const VERSION = '0.6.1';
	private $spoiler;
	private $patch;
	protected $shuffle;
	protected $timer_mode;
	protected $keysanity;

	/**
	 * Create a new EntranceRandomizer
	 *
	 * @param string $difficulty difficulty from config to apply to randomization
	 * @param string $logic Ruleset to use when deciding if Locations can be reached
	 * @param string $goal Goal of the game
	 * @param string $variation modifications to difficulty
	 * @param string $variation how the entrances are shuffled
	 *
	 * @return void
	 */
	public function __construct($difficulty = 'normal', $logic = 'noglitches', $goal = 'ganon', $variation = 'none', $shuffle = 'none') {
		$this->difficulty = $difficulty;
		$this->variation = $variation;
		$this->shuffle = $shuffle;
		$this->logic = $logic;
		$this->goal = $goal;
		$this->timer_mode = 'none';
		$this->seed = new Seed;
		$this->keysanity = false;
		$this->retro = false;

		switch ($this->variation) {
			case 'timed-race':
				$this->timer_mode = 'timed';
				break;
			case 'timed-ohko':
				$this->timer_mode = 'timed-ohko';
				break;
			case 'ohko':
				$this->timer_mode = 'ohko';
				break;
			case 'triforce-hunt':
				$this->goal = 'triforcehunt';
				break;
			case 'key-sanity':
				$this->keysanity = true;
				break;
			case 'retro':
				$this->retro = true;
				break;
		}
	}

	public function makeSeed(int $rng_seed = null) {
		$rng_seed = $rng_seed ?: random_int(1, 999999999); // cryptographic pRNG for seeding
		$this->rng_seed = $rng_seed % 1000000000;
		mt_srand($rng_seed);

		$keysanity_flag = '';
		if ($this->keysanity) {
			$keysanity_flag = ' --keysanity';
		}
		$retro_flag = '';
		if ($this->retro) {
			$retro_flag = ' --retro';
		}

		$proc = new Process('python3 '
			. base_path('vendor/z3/entrancerandomizer/EntranceRandomizer.py')
			. ' --mode ' . $this->config('mode.state')
			. ' --goal ' . $this->goal
			. ' --difficulty ' . $this->difficulty
			. ' --shuffle ' .  $this->shuffle
			. ' --timer ' . $this->timer_mode
			. $keysanity_flag
			. $retro_flag
			. ' --seed ' . $rng_seed
			. ' --jsonout --loglevel error');

		Log::debug($proc->getCommandLine());
		$proc->run();

		if (!$proc->isSuccessful()) {
			Log::debug($proc->getOutput());
			Log::debug($proc->getErrorOutput());
			throw new \Exception("Unable to generate");
		}

		$er = json_decode($proc->getOutput());
		$patch = $er->patch;
		array_walk($patch, function(&$write, $address) {
			$write = [$address => $write];
		});
		$this->patch = array_values((array) $patch);

		// possible temp fix
		$this->spoiler = json_decode($er->spoiler);
		$this->spoiler->meta->build = Rom::BUILD;
		$this->spoiler->meta->logic = $this->getLogic();
		$this->spoiler->meta->variation = $this->variation;

		return $this;
	}

	/**
	 * Get the current Logic identifier
	 *
	 * @return string
	 */
	public function getLogic() {
		switch ($this->logic) {
			case 'noglitches': return 'er-no-glitches-' . static::VERSION;
		}
		return 'er-unknown-' . static::LOGIC;
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
	 * Get config value based on the currently set rules
	 *
	 * @param string $key dot notation key of config
	 * @param mixed|null $default value to return if $key is not found
	 *
	 * @return mixed
	 */
	public function config(string $key, $default = null) {
		if (!array_key_exists($key, $this->config)) {
			$this->config[$key] = config("alttp.{$this->difficulty}.variations.{$this->variation}.$key",
				config("alttp.{$this->difficulty}.$key",
					config("alttp.goals.{$this->goal}.$key",
						config("alttp.$key", null))));
		}

		return $this->config[$key] ?? $default;
	}

	/**
	 * Get the current spoiler for this seed
	 *
	 * @return array
	 */
	public function getSpoiler(array $meta = []) {
		return json_decode(json_encode($this->spoiler), true);
	}

	/**
	 * Save a seed record to DB
	 *
	 * @return string hash of record
	 */
	public function saveSeedRecord() {
		$this->seed->spoiler = json_encode($this->spoiler);
		$this->seed->patch = json_encode(array_values((array) $this->patch));
		$this->seed->build = Rom::BUILD;
		$this->seed->logic = -1;
		$this->seed->rules = $this->difficulty;
		$this->seed->game_mode = $this->getLogic();
		$this->seed->save();

		return $this->seed->hash;
	}
}
