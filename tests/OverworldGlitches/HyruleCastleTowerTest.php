<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class HyruleCastleTowerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
        $this->addCollected(['RescueZelda']);
        $this->collected->setChecksForWorld($this->world->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    // Entry
    public function testCapeOrUpgradedSwordRequiredToEnter()
    {
        $this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
            ->canEnter($this->world->getLocations(), $this->allItemsExcept(['Cape', 'UpgradedSword'])));
    }

    // Completion
    public function testSwordRequiredToComplete()
    {
        $this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
            ->canComplete($this->world->getLocations(), $this->allItemsExcept(['AnySword'])));
    }
}
