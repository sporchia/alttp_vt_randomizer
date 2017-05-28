<?php namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Difficulties;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase {
	/**
	 * A basic browser test example.
	 *
	 * @return void
	 */
	public function testBasicExample() {
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
					->assertTitle('ALttP VT Randomizer');
		});
	}

	public function testDifficultiesPage() {
		$this->browse(function (Browser $browser) {
			$browser->visit(new Difficulties)
				->assertSee("Normal");
		});
	}

}
