<?php namespace ALttP;

use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use Log;

/**
 * Main class for randomization. All the magic happens here. We use mt_rand as it is much faster than rand. Not all PHP
 * functions support mt_rand (e.g. array_shuffle), so those had to be cloned to maintain seed integrity.
 */
class SpecialRandomizer extends Randomizer {
	/**
	 * Get the current spoiler for this seed
	 *
	 * @return array
	 */
	public function getSpoiler() {
		$spoiler = parent::getSpoiler();

		$spoiler['meta']['build'] = '2017-12-23';
		$spoiler['meta']['special'] = 'Xmas 2017';

		$this->seed->spoiler = json_encode($spoiler);

		return $spoiler;
	}

	/**
	 * write the current generated data to the Rom
	 *
	 * @param Rom $rom Rom to write data to
	 *
	 * @return Rom
	 */
	public function writeToRom(Rom $rom) {
		parent::writeToRom($rom);

		$rom->setDiggingGameRng(mt_rand(1, 20));

		$rom->writeCredits();

		$this->seed->patch = json_encode(patch_merge_minify($rom->getWriteLog()));
		$this->seed->build = '2017-12-23';

		return $rom;
	}

	/**
	 * Randomize portions of the ending credits sequence
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function randomizeCredits(Rom $rom) {
		parent::randomizeCredits($rom);

		$rom->setDesertPalaceCredits("vultures rule the tundra");

		return $rom;
	}

	/**
	 * Set all texts for this randomization
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function setTexts(Rom $rom) {
		parent::setTexts($rom);

		$rom->setUncleTextString(array_first(mt_shuffle([
			"Die Hard isn’t\na christmas\nmovie",
			"I hear Santa\n\non the roof!",
			"We don’t have\na chimney so\nno santa",
		])));

		$rom->setBlindTextString(array_first(mt_shuffle([
			"I LIKE\nHANUKKAH A\nLATKE",
			"CLAUSTROPHOBIA\nIS THE FEAR OF\nSANTA",
		])));

		$rom->setGanon1TextString(array_first(mt_shuffle([
			"Jingle bells\nArrghus smells\nMoldorm knocks\nyou down\nblinds 3 heads\nkilled you\ndead\nwhile Armos\ndanced around",
			"Male reindeer\nshed their\nantlers during\nwinter while\nfemales shed\ntheirs in the\nsummer. Santas\nreindeer must\nall be female",
			"...On the 15th\nday of X-mas\nAga gave to me\n15 blue balls\nbouncing,\n7 maidens\nsleeping, and\na bomb drop\nin a pull tree",
		])));

		$rom->setTriforceTextString(array_first(mt_shuffle([
			"\n     G G",
			" And to all a\n good  night!",
			"\nHappy Holidays",
			"\nHO!  HO!  HO!",
			"\nPeace out, yo!",
		])));

		return $this;
	}
}
