<?php

use ALttP\Item;
use ALttP\Support\ItemCollection;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase {
	/**
	 * The base URL to use while testing the application.
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://localhost';

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication() {
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}

	public function setUp() {
		parent::setUp();
		$this->collected = new ItemCollection;
	}

	protected function addCollected(array $items) {
		foreach ($items as $item) {
			$this->collected->addItem(Item::get($item));
		}
	}

	/**
	 * Lets pretend all items doesn't include keys just in case it affects things
	 */
	protected function allItems() {
		return $this->allItemsExcept(['BigKey', 'Key']);
	}

	protected function allItemsExcept(array $remove_items) {
		$items = Item::all()->copy();
		foreach (array_merge($remove_items, ['BigKey', 'Key']) as $item) {
			$items->removeItem($item);
		}
		return $items;
	}
}
