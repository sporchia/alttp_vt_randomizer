<?php namespace ALttP;

use ALttP\Rom;
use ALttP\Support\ShopCollection;

/**
 * Shop related features.
 * this is very much a work in progress
 */
class Shop {
	protected $name;
	protected $config;
	protected $shopkeeper;
	protected $room_id;
	protected $door_id;
	protected $writes = [];
	protected $active = false;
	protected $inventory = [];

	static protected $items;

	/**
	 * Get the Boss by name
	 *
	 * @param string $name Name of Boss
	 *
	 * @throws Exception if the Boss doesn't exist
	 *
	 * @return Boss
	 */
	static public function get(string $name) {
		$items = static::all();
		if (isset($items[$name])) {
			return $items[$name];
		}

		throw new \Exception('Unknown Shop: ' . $name);
	}

	/**
	 * Get the all known Bosses
	 *
	 * @return ShopCollection
	 */
	static public function all() : ShopCollection {
		if (static::$items) {
			return static::$items;
		}

		static::$items = new ShopCollection([
			new Shop("Dark World Death Mountain Shop",           0x03, 0xC1, 0x0112, 0x6E),
			new Shop("Dark World Forest Shop",                   0x03, 0xC1, 0x0110, 0x75),
			new Shop("Dark World Lake Hylia Shop",               0x03, 0xC1, 0x010F, 0x74),
			new Shop("Dark World Lumberjack Hut Shop",           0x03, 0xC1, 0x010F, 0x57),
			new Shop("Dark World Outcasts Shop",                 0x03, 0xC1, 0x010F, 0x60),
			new Shop("Dark World Potion Shop",                   0x03, 0xC1, 0x010F, 0x6F),
			new Shop("Light World Death Mountain Shop",          0x43, 0xA0, 0x00FF, 0x00),
			new Shop("Light World Kakariko Shop",                0x03, 0xA0, 0x011F, 0x46),
			new Shop("Light World Lake Hylia Shop",              0x03, 0xA0, 0x0112, 0x58),
			// Single entrance caves with no items in them ;)
			new Shop\TakeAny("20 Rupee Cave",                    0x83, 0xA0, 0x0112, 0x7B, [0xDBBED => [0x58]]),
			new Shop\TakeAny("50 Rupee Cave",                    0x83, 0xA0, 0x0112, 0x79, [0xDBBEB => [0x58]]),
			new Shop\TakeAny("Archery Game",                     0x83, 0xC1, 0x010F, 0x59, [0xDBBCB => [0x60]]),
			new Shop\TakeAny("Bonk Fairy (Dark)",                0x83, 0xC1, 0x0112, 0x78, [0xDBBEA => [0x58]]),
			new Shop\TakeAny("Bonk Fairy (Light)",               0x83, 0xA0, 0x0112, 0x77, [0xDBBE9 => [0x58]]),
			new Shop\TakeAny("Bush Covered House",               0x83, 0xA0, 0x011F, 0x44, [0xDBBB6 => [0x46]]),
			new Shop\TakeAny("Capacity Upgrade",                 0x83, 0xA0, 0x0112, 0x5D, [0xDBBCF => [0x58]]),
			new Shop\TakeAny("Dark Death Mountain Fairy",        0x83, 0xC1, 0x0112, 0x70, [0xDBBE2 => [0x58]]),
			new Shop\TakeAny("Dark Desert Fairy",                0x83, 0xC1, 0x0112, 0x56, [0xDBBC8 => [0x58]]),
			new Shop\TakeAny("Dark Desert Hint",                 0x83, 0xC1, 0x0112, 0x62, [0xDBBD4 => [0x58]]),
			new Shop\TakeAny("Dark Lake Hylia Fairy",            0x83, 0xC1, 0x0112, 0x6D, [0xDBBDF => [0x58]]),
			new Shop\TakeAny("Dark Lake Hylia Ledge Fairy",      0x83, 0xC1, 0x0112, 0x81, [0xDBBF3 => [0x58]]),
			new Shop\TakeAny("Dark Lake Hylia Ledge Hint",       0x83, 0xC1, 0x0112, 0x6A, [0xDBBDC => [0x58]]),
			new Shop\TakeAny("Dark Lake Hylia Ledge Spike Cave", 0x83, 0xC1, 0x0112, 0x7C, [0xDBBEE => [0x58]]),
			new Shop\TakeAny("Dark Sanctuary Hint",              0x83, 0xC1, 0x0112, 0x5A, [0xDBBCC => [0x58]]),
			new Shop\TakeAny("Desert Fairy",                     0x83, 0xA0, 0x0112, 0x72, [0xDBBE4 => [0x58]]),
			new Shop\TakeAny("East Dark World Hint",             0x83, 0xC1, 0x0112, 0x69, [0xDBBDB => [0x58]]),
			new Shop\TakeAny("Fortune Teller (Dark)",            0x83, 0xC1, 0x010F, 0x66, [0xDBBD8 => [0x60]]),
			new Shop\TakeAny("Fortune Teller (Light)",           0x83, 0xA0, 0x011F, 0x65, [0xDBBD7 => [0x46]]),
			new Shop\TakeAny("Good Bee Cave",                    0x83, 0xA0, 0x0112, 0x6B, [0xDBBDD => [0x58]]),
			new Shop\TakeAny("Lake Hylia Fortune Teller",        0x83, 0xA0, 0x011F, 0x73, [0xDBBE5 => [0x46]]),
			new Shop\TakeAny("Lake Hylia Fairy",                 0x83, 0xA0, 0x0112, 0x5E, [0xDBBD0 => [0x58]]),
			new Shop\TakeAny("Long Fairy Cave",                  0x83, 0xA0, 0x0112, 0x55, [0xDBBC7 => [0x58]]),
			new Shop\TakeAny("Lost Woods Gamble",                0x83, 0xA0, 0x0112, 0x3C, [0xDBBAE => [0x58]]),
			new Shop\TakeAny("Lumberjack House",                 0x83, 0xA0, 0x011F, 0x76, [0xDBBE8 => [0x46]]),
			new Shop\TakeAny("Palace of Darkness Hint",          0x83, 0xC1, 0x010F, 0x68, [0xDBBDA => [0x60]]),
			new Shop\TakeAny("Swamp Fairy",                      0x83, 0xC1, 0x0112, 0x6C, [0xDBBDE => [0x58]]),
		]);

		return static::all();
	}

	static public function setDefaultShops() {
		static::get("Dark World Death Mountain Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('Heart'), 10)
			->addInventory(2, Item::get('TenBombs'), 50);
		static::get("Dark World Forest Shop")->clearInventory()
			->addInventory(0, Item::get('RedShield'), 500)
			->addInventory(1, Item::get('Bee'), 10)
			->addInventory(2, Item::get('TenArrows'), 30);
		static::get("Dark World Lake Hylia Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('BlueShield'), 50)
			->addInventory(2, Item::get('TenBombs'), 50);
		static::get("Dark World Lumberjack Hut Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('BlueShield'), 50)
			->addInventory(2, Item::get('TenBombs'), 50);
		static::get("Dark World Outcasts Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('BlueShield'), 50)
			->addInventory(2, Item::get('TenBombs'), 50);
		static::get("Dark World Potion Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('BlueShield'), 50)
			->addInventory(2, Item::get('TenBombs'), 50);
		static::get("Light World Death Mountain Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('Heart'), 10)
			->addInventory(2, Item::get('TenBombs'), 50);
		static::get("Light World Kakariko Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('Heart'), 10)
			->addInventory(2, Item::get('TenBombs'), 50);
		static::get("Light World Lake Hylia Shop")->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('Heart'), 10)
			->addInventory(2, Item::get('TenBombs'), 50);
	}

	/**
	 * Create a new Item
	 *
	 * @param string $name Unique name of Shop
	 *
	 * @return void
	 */
	public function __construct(string $name, int $config, int $shopkeeper, int $room_id, int $door_id, array $writes = []) {
		$this->name = $name;
		$this->config = $config;
		$this->shopkeeper = $shopkeeper;
		$this->room_id = $room_id;
		$this->door_id = $door_id;
		$this->writes = $writes;
	}

	/**
	 * Get the name of this Shop
	 *
	 * @return string
	 */
	public function getName() : string {
		return $this->name;
	}

	public function getBytes(int $sram_offset = 0x00) : array {
		return array_merge(
			array_values(unpack('C*', pack('S', $this->room_id ?? 0))),
			[$this->door_id, 0x00, ($this->config & 0xFC) + count($this->inventory), $this->shopkeeper, $sram_offset]
		);
	}

	public function writeExtraData(Rom $rom) {
		foreach ($this->writes as $address => $bytes) {
			$rom->write($address, pack('C*', ...$bytes));
		}
	}

	public function setActive(bool $active) : self {
		$this->active = $active;

		return $this;
	}

	public function getActive() : bool {
		return $this->active;
	}

	public function setShopkeeper(string $shopkeeper) : self {
		switch ($shopkeeper) {
			case 'old_man':
				$this->shopkeeper = 0xE2;
				break;
			case 'old_woman':
				$this->shopkeeper = 0xE3;
				break;
			case 'dark_shopkepper':
				$this->shopkeeper = 0xC1;
				break;
			case 'shopkeeper':
			default:
				$this->shopkeeper = 0xA0;
		}

		return $this;
	}

	public function clearInventory() : self {
		$this->inventory = [];

		return $this;
	}

	public function addInventory(int $slot, Item $item, int $price, int $max = 0, Item $replacement = null, int $replacement_price = 0) : self {
		$this->inventory[$slot] = [
			'id' => head($item->getBytes()),
			'price' => $price,
			'max' => $max,
			'replace_id' => $replacement === null ? 0xFF : head($replacement->getBytes()),
			'replace_price' => $replacement_price,
		];

		return $this;
	}

	public function getInventory() : array {
		return $this->inventory;
	}
}
