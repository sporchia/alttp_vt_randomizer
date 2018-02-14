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
			new static("Dark World Death Mountain Shop",  0x03, 0x51, 0x0112, 0x6E),
			new static("Dark World Forest Shop",          0x03, 0x51, 0x0110, 0x75),
			new static("Dark World Lake Hylia Shop",      0x03, 0x51, 0x010F, 0x74),
			new static("Dark World Lumberjack Hut Shop",  0x03, 0x51, 0x010F, 0x57),
			new static("Dark World Outcasts Shop",        0x03, 0x51, 0x010F, 0x60),
			new static("Dark World Potion Shop",          0x03, 0x51, 0x010F, 0x6F),
			new static("Light World Death Mountain Shop", 0x43, 0x50, 0x00FF, 0x00),
			new static("Light World Kakariko Shop",       0x03, 0x50, 0x011F, 0x46),
			new static("Light World Lake Hylia Shop",     0x03, 0x50, 0x0112, 0x58),
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
	public function __construct(string $name, int $config, int $shopkeeper, int $room_id, int $door_id) {
		$this->name = $name;
		$this->config = $config;
		$this->shopkeeper = $shopkeeper;
		$this->room_id = $room_id;
		$this->door_id = $door_id;
	}

	/**
	 * Get the name of this Shop
	 *
	 * @return string
	 */
	public function getName() : string {
		return $this->name;
	}

	public function getBytes() : array {
		return array_merge(
			array_values(unpack('C*', pack('S', $this->room_id ?? 0))),
			[$this->door_id, 0x00, $this->config, $this->shopkeeper, 0x00]
		);
	}

	public function setActive(bool $active) : self {
		$this->active = $active;

		return $this;
	}

	public function getActive() : bool {
		return $this->active;
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
