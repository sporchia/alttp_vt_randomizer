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
	public function getSpoiler(array $meta = []) {
		$spoiler = parent::getSpoiler($meta);

		$spoiler['meta']['build'] = '2018-03-23';
		$spoiler['meta']['special'] = 'Easter 2018';
		$spoiler['meta']['goal'] = 'egg-hunt';

		$this->seed->spoiler = json_encode($spoiler);

		return $spoiler;
	}

	/**
	 * Get all the Items to insert into the Locations Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getItemPool() {
		// we are using these GFX, so we can't place the items.
		config([
			"alttp.{$this->difficulty}.variations.{$this->variation}.item.count.BombUpgrade5" => 0,
			"alttp.{$this->difficulty}.variations.{$this->variation}.item.count.BombUpgrade10" => 0,
			"alttp.{$this->difficulty}.variations.{$this->variation}.item.count.ArrowUpgrade5" => 0,
			"alttp.{$this->difficulty}.variations.{$this->variation}.item.count.ArrowUpgrade10" => 0,
		]);

		return array_merge(parent::getItemPool(), [
			Item::get('Egg0'), Item::get('Egg0'), Item::get('Egg0'), Item::get('Egg0'), Item::get('Egg0'), Item::get('Egg0'),
			Item::get('Egg1'), Item::get('Egg1'), Item::get('Egg1'), Item::get('Egg1'), Item::get('Egg1'), Item::get('Egg1'),
			Item::get('Egg2'), Item::get('Egg2'), Item::get('Egg2'), Item::get('Egg2'), Item::get('Egg2'), Item::get('Egg2'),
			Item::get('Egg3'), Item::get('Egg3'), Item::get('Egg3'), Item::get('Egg3'), Item::get('Egg3'), Item::get('Egg3'),
			Item::get('Egg4'), Item::get('Egg4'), Item::get('Egg4'), Item::get('Egg4'), Item::get('Egg4'), Item::get('Egg4'),
			Item::get('Egg5'), Item::get('Egg5'), Item::get('Egg5'), Item::get('Egg5'), Item::get('Egg5'), Item::get('Egg5'),
			Item::get('Egg6'), Item::get('Egg6'), Item::get('Egg6'), Item::get('Egg6'), Item::get('Egg6'), Item::get('Egg6'),
			Item::get('Egg7'), Item::get('Egg7'), Item::get('Egg7'), Item::get('Egg7'), Item::get('Egg7'), Item::get('Egg7'),
			Item::get('Egg8'), Item::get('Egg8'), Item::get('Egg8'), Item::get('Egg8'), Item::get('Egg8'), Item::get('Egg8'),
			Item::get('Egg9'), Item::get('Egg9'), Item::get('Egg9'), Item::get('Egg9'), Item::get('Egg9'), Item::get('Egg9'),
			Item::get('EggA'), Item::get('EggA'), Item::get('EggA'), Item::get('EggA'), Item::get('EggA'), Item::get('EggA'),
			Item::get('EggB'), Item::get('EggB'), Item::get('EggB'), Item::get('EggB'), Item::get('EggB'), Item::get('EggB'),
			Item::get('EggC'), Item::get('EggC'), Item::get('EggC'), Item::get('EggC'), Item::get('EggC'), Item::get('EggC'),
			Item::get('EggD'), Item::get('EggD'), Item::get('EggD'), Item::get('EggD'), Item::get('EggD'), Item::get('EggD'),
			Item::get('EggE'), Item::get('EggE'), Item::get('EggE'), Item::get('EggE'), Item::get('EggE'), Item::get('EggE'),
			Item::get('EggF'), Item::get('EggF'), Item::get('EggF'), Item::get('EggF'), Item::get('EggF'), Item::get('EggF'),
		]);
	}

	protected function setShops() {
		$shops = $this->world->getShops();

		$shops->filter(function($shop) {
			return $shop instanceof Shop\TakeAny;
		})->randomCollection(25)->each(function($shop) {
			$shop->setActive(true);
			$shop->setShopkeeper(array_first(mt_shuffle([
				'old_man',
				'old_woman',
			])));
			$shop->addInventory(0, Item::get('Egg' . strtoupper(dechex(mt_rand(0, 15)))), 0);
			$shop->addInventory(1, Item::get('Egg' . strtoupper(dechex(mt_rand(0, 15)))), 0);
		});
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

		$rom->setGanonInvincible('yes');

		$rom->setStartingTime(60 * 60);
		$rom->setClockMode('countdown-end');
		$rom->setGoalRequiredCount(0xFF);

		$rom->setupCustomShops($this->world->getShops());
		$rom->writeCredits();

		$this->seed->patch = json_encode(patch_merge_minify($rom->getWriteLog()));
		$this->seed->build = '2018-03-23';

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
			"I hope you\nbrought your\nown egg basket",
			"Hope you have\nan eggs-tra\nspecial run",
			"Spring is hare\ntoday, gone\ntomorrow!",
			"Some-bunny is\nthinking of\nyou. See ya!",
			"I’m egg-static\nto have you as\na nephew",
		])));

		$rom->setBlindTextString(array_first(mt_shuffle([
			"this run is\nsuper\negg-citing",
			"I whisk you\nwould leave\nme alone",
			"What day to\neggs hate the\nmost? Fry-day.",
			"Boiled egg in\nthe morning is\nhard to beat.",
			"It’s do or\ndye time",
		])));

		$rom->setGanon1InvincibleTextString("Tell me if you\nhave heard\nthis one.\nA bunny hops\ninto a fight\nand what are\nyou doing here\nyou should be\ngetting eggs!");
		$rom->setGanon2InvincibleTextString("Seriously, how\ndid you get \nhere so fast?");

		$rom->setTavernManTextString(array_first(mt_shuffle([
			"Why are there\nno bunny beams\nin Easter\npalace?",
			"We found eggs\nin Hinox's\nback yard.\nWhat do you\nmean those\naren't eggs?",
		])));

		$rom->setTriforceTextString(array_first(mt_shuffle([
			"\n     G G",
			"Eggs\n   Eggs!\n       Eggs!!!",
			"\n Egg-cellent!",
			"\nPeace out, yo!",
		])));

		return $this;
	}
}
