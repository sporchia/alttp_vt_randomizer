<?php namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class Difficulties extends BasePage {
	public function url() {
		return '/game_difficulties';
	}

	public function assert(Browser $browser) {
		$browser->assertPathIs($this->url());
	}

	public function elements() {
		return [];
	}
}
