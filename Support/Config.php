<?php namespace Randomizer\Support;

/**
 * Wrapper for Config options
 */
class Config extends Collection {
	public function __construct($items = []) {
		$this->items = is_array($items) ? $items : $this->getArrayableItems($items);
	}

	/**
	 * Get an item from the collection by key.
	 *
	 * @param mixed $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($key, $default = null) {
		if ($this->offsetExists($key)) {
			return $this->items[$key];
		}

		return $default;
	}

	/**
	 * Get a predefined ruleset
	 *
	 * @param  string  $rules_name
	 *
	 * @return static
	 */
	static public function rules(string $rules_name = 'v7') {
		switch ($rules_name) {
			case 'v7':
				return new Config([
					'prize.crossWorld' => false,
					'item.count.TenArrows' => 11,
					'item.count.ThreeBombs' => 17,
					'item.count.BombUpgrade5' => 0,
					'item.count.BombUpgrade10' => 0,
					'item.count.BombUpgrade50' => 1,
					'item.count.ArrowUpgrade5' => 0,
					'item.count.ArrowUpgrade10' => 0,
					'item.count.ArrowUpgrade70' => 1,
					'item.count.TwentyRupees' => 24,
					'region.bossNormalLocation' => false,
					'spoil.BootsLocation' => false,
				]);
			case 'v7_hard':
				return static::rules('v7')->clone()->merge([
					'item.count.BlueMail' => 0,
					'item.count.Boomerang' => 0,
					'item.count.BugCatchingNet' => 0,
					'item.count.HeartContainer' => 0,
					'item.count.MirrorShield' => 0,
					'item.count.PieceOfHeart' => 12,
					'item.count.RedBoomerang' => 0,
					'item.count.RedShield' => 0,
					'item.count.StaffOfByrna' => 0,
					'item.count.RedMail' => 0,
					'item.count.BombUpgrade50' => 0,
					'item.count.ArrowUpgrade70' => 0,
					'item.count.BossHeartContainer' => 5,
					'item.count.OneHundredRupees' => 2,
					'item.count.ThreeHundredRupees' => 1,
					'item.count.TwentyRupees' => 5,
					'item.count.Arrow' => 10,
					'item.count.TenArrows' => 1,
					'item.count.Bomb' => 5,
					'item.count.ThreeBombs' => 2,
					'item.count.ExtraBottles' => 0,
				]);
			case 'v8':
				return new Config([
					'prize.crossWorld' => true,
					'item.count.TenArrows' => 7,
					'item.count.ThreeBombs' => 12,
					'item.count.BombUpgrade5' => 6,
					'item.count.BombUpgrade10' => 1,
					'item.count.BombUpgrade50' => 0,
					'item.count.ArrowUpgrade5' => 6,
					'item.count.ArrowUpgrade10' => 1,
					'item.count.ArrowUpgrade70' => 0,
					'item.count.TwentyRupees' => 23,
					'region.bossNormalLocation' => true,
					'spoil.BootsLocation' => true,
				]);
			default:
				return static::rules('v7');
		}
	}
}
