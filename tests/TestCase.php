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

	protected function allItems() {
		return Item::all()->copy();
	}

	protected function allItemsExcept(array $remove_items) {
		$items = $this->allItems();
		foreach ($remove_items as $item) {
			$items->removeItem($item);
		}
		return $items;
	}
}
