<?php

declare(strict_types=1);

namespace Tests\Unit\Graph;

use App\Graph\Item;
use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 */
final class RandomizerTest extends TestCase
{
    public function testConstructor(): void
    {
        $randomizer = new Randomizer();

        $this->assertInstanceOf(Randomizer::class, $randomizer);
    }

    public function testLocation(): void
    {
        $randomizer = new Randomizer();

        $randomizer->assumeItems([
            //Item::get("L1Sword", 0),
        ]);

        $locations = $randomizer->getEmptyLocationsInSet();

        $this->assertContains("Link's House - Chest:0", array_map(fn ($l) => $l->name, $locations));
    }
}
