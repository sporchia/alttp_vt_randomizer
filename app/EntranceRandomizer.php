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
	const VERSION = '0.4.7';
	private $spoiler;
	private $patch;
	protected $shuffle;

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
		$this->seed = new Seed;

		// Add shuffle Ganon
		switch ($this->shuffle) {
			case 'madness':
			case 'insanity':
				$this->shuffle .= ' --shuffleganon';
				break;
		}

		switch ($this->variation) {
			case 'timed-race':
				$this->difficulty = 'timed';
				break;
			case 'timed-ohko':
				$this->difficulty = 'timed-ohko';
				break;
			case 'triforce-hunt':
				$this->difficulty = 'normal';
				$this->goal = 'triforcehunt';
				break;
		}
	}

	public function makeSeed(int $rng_seed = null) {
		$rng_seed = $rng_seed ?: random_int(1, 999999999); // cryptographic pRNG for seeding
		$this->rng_seed = $rng_seed % 1000000000;
		mt_srand($rng_seed);
		$this->seed->seed = $rng_seed;

		$proc = new Process('python3 '
			. base_path('vendor/z3/entrancerandomizer/EntranceRandomizer.py')
			. ' --mode ' . config('game-mode')
			. ' --goal ' . $this->goal
			. ' --difficulty ' . $this->difficulty
			. ' --shuffle ' .  $this->shuffle
			. ' --seed ' . $rng_seed
			. ' --jsonout --loglevel error');

		$proc->run();

		if (!$proc->isSuccessful()) {
			throw new \Exception("Unable to generate");
		}

		$er = json_decode($proc->getOutput());
		$patch = $er->patch;
		array_walk($patch, function(&$write, $address) {
			if ($address >= 0x76928 && $address <= 0x76C95) {
				// we moved this table, so lets be nice neighbors and move the writes
				$address = $address + 0x10ABDC;
			}
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
		return 'unknown-' . static::LOGIC;
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
		$this->setTexts($rom);

		return $rom;
	}

	/**
	 * Get the current spoiler for this seed
	 *
	 * @return array
	 */
	public function getSpoiler() {
		return json_decode(json_encode($this->spoiler), true);
	}

	/**
	 * Save a seed record to DB
	 *
	 * @return string hash of record
	 */
	public function saveSeedRecord() {
		$this->seed->seed = $this->spoiler->meta->seed;
		$this->seed->spoiler = json_encode($this->spoiler);
		$this->seed->patch = json_encode(array_values((array) $this->patch));
		$this->seed->build = Rom::BUILD;
		$this->seed->logic = -1;
		$this->seed->rules = $this->difficulty;
		$this->seed->game_mode = $this->getLogic();
		$this->seed->save();

		return $this->seed->hash;
	}

	/**
	 * Set all texts for this randomization
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function setTexts(Rom $rom) {
		$rom->setUncleTextString(array_first(mt_shuffle([
			"We're out of\nWeetabix. To\nthe store!",
			"This seed is\nbootless\nuntil boots.",
			"Why do we only\nhave one bed?",
			"This is the\nonly textbox.",
			"I'm going to\ngo watch the\nMoth tutorial.",
			"This seed is\nthe worst.",
			"Chasing tail.\nFly ladies.\nDo not follow.",
			"I feel like\nI've done this\nbefore...",
			"Magic cape can\npass through\nthe barrier!",
			"If this is a\nKanzeon seed,\nI'm quitting.",
			"I am not your\nreal uncle.",
			"You're going\nto have a very\nbad time.",
			"Today you\nwill have\nbad luck.",
			"I am leaving\nforever.\nGoodbye.",
			"Don't worry.\nI got this\ncovered.",
			"Race you to\nthe castle!",
			"\n      hi",
			"I'M JUST GOING\nOUT FOR A\nPACK OF SMOKES",
			"It's dangerous\nto go alone.\nSee ya!",
			"ARE YOU A BAD\nENOUGH DUDE TO\nRESCUE ZELDA?",
			"\n\n    I AM ERROR",
			"This seed is\nsub 2 hours,\nguaranteed.",
			"The chest is\na secret to\neverybody.",
			"I'm off to\nfind the\nwind fish.",
			"The shortcut\nto Ganon\nis this way!",
			"THE MOON IS\nCRASHING! RUN\nFOR YOUR LIFE!",
			"Time to fight\nhe who must\nnot be named.",
			"RED MAIL\nIS FOR\nCOWARDS.",
			"HEY!\n\nLISTEN!",
			"Well\nexcuuuuuse me,\nprincess!",
			"5,000 Rupee\nreward for >\nYou're boned",
			"Welcome to\nStoops Lonk's\nHoose",
			"Erreur de\ntraduction.\nsvp reessayer",
			"I could beat\nit in an hour\nand one life",
		])));

		$rom->setBlindTextString(array_first(mt_shuffle([
			"I hate insect\npuns, they\nreally bug me.",
			"I haven't seen\nthe eye doctor\nin years",
			"I don't see\nyou having a\nbright future",
			"Are you doing\na blind run\nof this game?",
			"pizza joke? no\nI think it's a\nbit too cheesy",
			"A novice skier\noften jumps to\ncontusions.",
			"the beach?\nI'm not shore\nI can make it.",
			"Rental agents\noffer quarters\nfor dollars.",
			"I got my tires\nfixed for a\nflat rate.",
			"New lightbulb\ninvented?\nEnlighten me.",
			"A baker's job\nis a piece of\ncake.",
			"My optometrist\nsaid I have\nvision!",
			"when you're a\nbaker, don't\nloaf around",
			"mire requires\nether quake,\nor bombos",
			"Broken pencils\nare pointless.",
		])));

		$rom->setTavernManTextString(array_first(mt_shuffle([
			"What do you\ncall a blind\ndinosaur?\nadoyouthink-\nhesaurus\n",
			"A blind man\nwalks into\na bar.\nAnd a table.\nAnd a chair.\n",
			"What do ducks\nlike to eat?\n\nQuackers!\n",
			"How do you\nset up a party\nin space?\n\nYou planet!\n",
			"I'm glad I\nknow sign\nlanguage,\nit's pretty\nhandy.\n",
			"What did Zelda\nsay to Link at\na secure door?\n\nTRIFORCE!\n",
			"I am on a\nseafood diet.\n\nEvery time\nI see food,\nI eat it.",
			"I've decided\nto sell my\nvacuum.\nIt was just\ngathering\ndust.",
			"Whats the best\ntime to go to\nthe dentist?\n\nTooth-hurtie!\n",
			"Why can't a\nbike stand on\nits own?\n\nIt's two-tired!\n",
			"If you haven't\nfound Quake\nyet…\nit's not your\nfault.",
			"Why is Peter\nPan always\nflying?\nBecause he\nNeverlands!",
			"I once told a\njoke to Armos.\n\nBut he\nremained\nstone-faced!",
			"Lanmola was\nlate to our\ndinner party.\nHe just came\nfor the desert",
			"Moldorm is\nsuch a\nprankster.\nAnd I fall for\nit every time!",
			"Helmasaur is\nthrowing a\nparty.\nI hope it's\na masquerade!",
			"I'd like to\nknow Arrghus\nbetter.\nBut he won't\ncome out of\nhis shell!",
			"Mothula didn't\nhave much fun\nat the party.\nHe's immune to\nspiked punch!",
			"Don't set me\nup with that\nchick from\nSteve's Town.\n\n\nI'm not\ninterested in\na Blind date!",
			"Kholdstare is\nafraid to go\nto the circus.\nHungry kids\nthought he was\ncotton candy!",
			"I asked who\nVitreous' best\nfriends are.\nHe said,\n'Me, Myself,\nand Eye!'",
			"Trinexx can be\na hothead or\nhe can be an\nice guy. In\nthe end, he's\na solid\nindividual!",
			"Bari thought I\nhad moved out\nof town.\nHe was shocked\nto see me!",
			"I can only get\nWeetabix\naround here.\nI have to go\nto Steve's\nTown for Count\nChocula!",
			"Don't argue\nwith a frozen\nDeadrock.\nHe'll never\nchange his\nposition!",
			"I offered to a\ndrink to a\nself-loathing\nGhini.\nHe said he\ndidn't like\nspirits!",
			"I was supposed\nto meet Gibdo\nfor lunch.\nBut he got\nwrapped up in\nsomething!",
			"Goriya sure\nhas changed\nin this game.\nI hope he\ncomes back\naround!",
			"Hinox actually\nwants to be a\nlawyer.\nToo bad he\nbombed the\nbar exam!",
			"I'm surprised\nMoblin's tusks\nare so gross.\nHe always has\nhis Trident\nwith him!",
			"Don’t tell\nStalfos I’m\nhere.\nHe has a bone\nto pick with\nme!",
			"I got\nWallmaster to\nhelp me move\nfurniture.\nHe was really\nhandy!",
			"Wizzrobe was\njust here.\nHe always\nvanishes right\nbefore we get\nthe check!",
			"I shouldn't\nhave picked up\nZora's tab.\nThat guy\ndrinks like\na fish!",
		])));

		$rom->setGanon1TextString(array_first(mt_shuffle([
			"Start your day\nsmiling with a\ndelicious\nwholegrain\nbreakfast\ncreated for\nyour\nincredible\ninsides.",
			"You drove\naway my other\nself, Agahnim\ntwo times…\nBut, I won't\ngive you the\nTriforce.\nI'll defeat\nyou!",
			"Impa says that\nthe mark on\nyour hand\nmeans that you\nare the hero\nchosen to\nawaken Zelda.\nyour blood can\nresurect me.",
			"Don't stand,\n\ndon't stand so\nDon't stand so\n\nclose to me\nDon't stand so\nclose to me\nback off buddy",
			"So ya\nThought ya\nMight like to\ngo to the show\nTo feel the\nwarm thrill of\nconfusion\nThat space\ncadet glow.",
			"Like other\npulmonate land\ngastropods,\nthe majority\nof land slugs\nhave two pairs\nof 'feelers'\nor tentacles\non their head.",
			"If you were a\nburrito, what\nkind of a\nburrito would\nyou be?\nMe, I fancy I\nwould be a\nspicy barbacoa\nburrito.",
			"I am your\nfather's\nbrother's\nnephew's\ncousin's\nformer\nroommate. What\ndoes that make\nus, you ask?",
			"I'll be more\neager about\nencouraging\nthinking\noutside the\nbox when there\nis evidence of\nany thinking\ninside it.",
		])));

		$rom->setGanon1InvincibleTextString("You think you\nare ready to\nface me?\n\nI will not die\n\nunless you\ncomplete your\ngoals. Dingus!");

		$rom->setGanon2InvincibleTextString("Got wax in\nyour ears?\nI can not die!");

		$rom->setTriforceTextString(array_first(mt_shuffle([
			"\n     G G",
			"\n     G G",
			"All your base\nare belong\nto us.",
			"You have ended\nthe domination\nof dr. wily",
			"  thanks for\n  playing!!!",
			"\n   You Win!",
			"  Thank you!\n  your quest\n   is over.",
			"   A winner\n      is\n     you!",
			"\n   WINNER!!",
			"\n  I'm  sorry\n\nbut your\nprincess is in\nanother castle",
			"\n   success!",
		])));

		return $this;
	}
}
