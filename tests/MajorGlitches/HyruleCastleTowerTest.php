<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class HyruleCastleTowerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
        $this->addCollected(['RescueZelda']);
        $this->collected->setChecksForWorld($this->world->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    // Entry

    // Completion
    public function testSwordRequiredToComplete()
    {
        $this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
            ->canComplete($this->world->getLocations(), $this->allItemsExcept(['AnySword'])));
    }
}
