<?php

use ALttP\Item;
use ALttP\Randomizer;
use ALttP\World;

/**
 * These test may have to be updated on any Logic change that adjusts the pooling of the RNG
 */
class RandomizerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'accessibility' => 'full']);
        $this->randomizer = new Randomizer([$this->world]);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->randomizer);
        unset($this->world);
    }

    /**
     * @group crystals
     */
    public function testCrystalsNotRandomizedByConfigCrossWorld()
    {
        Config::set('prize.crossWorld', true);
        Config::set('prize.shuffleCrystals', false);

        $this->randomizer->randomize();
        $this->assertEquals([
            Item::get('Crystal1', $this->world),
            Item::get('Crystal2', $this->world),
            Item::get('Crystal3', $this->world),
            Item::get('Crystal4', $this->world),
            Item::get('Crystal5', $this->world),
            Item::get('Crystal6', $this->world),
            Item::get('Crystal7', $this->world),
        ], [
            $this->world->getLocation("Palace of Darkness - Prize")->getItem(),
            $this->world->getLocation("Swamp Palace - Prize")->getItem(),
            $this->world->getLocation("Skull Woods - Prize")->getItem(),
            $this->world->getLocation("Thieves' Town - Prize")->getItem(),
            $this->world->getLocation("Ice Palace - Prize")->getItem(),
            $this->world->getLocation("Misery Mire - Prize")->getItem(),
            $this->world->getLocation("Turtle Rock - Prize")->getItem(),
        ]);
    }

    /**
     * @group crystals
     */
    public function testCrystalsNotRandomizedByConfigNoCrossWorld()
    {
        Config::set('prize.crossWorld', false);
        Config::set('prize.shuffleCrystals', false);

        $this->randomizer->randomize();

        $this->assertEquals([
            Item::get('Crystal1', $this->world),
            Item::get('Crystal2', $this->world),
            Item::get('Crystal3', $this->world),
            Item::get('Crystal4', $this->world),
            Item::get('Crystal5', $this->world),
            Item::get('Crystal6', $this->world),
            Item::get('Crystal7', $this->world),
        ], [
            $this->world->getLocation("Palace of Darkness - Prize")->getItem(),
            $this->world->getLocation("Swamp Palace - Prize")->getItem(),
            $this->world->getLocation("Skull Woods - Prize")->getItem(),
            $this->world->getLocation("Thieves' Town - Prize")->getItem(),
            $this->world->getLocation("Ice Palace - Prize")->getItem(),
            $this->world->getLocation("Misery Mire - Prize")->getItem(),
            $this->world->getLocation("Turtle Rock - Prize")->getItem(),
        ]);
    }


    /**
     * @group pendants
     */
    public function testPendantsNotRandomizedByConfigNoCrossWorld()
    {
        Config::set('prize.crossWorld', false);
        Config::set('prize.shufflePendants', false);

        $this->randomizer->randomize();

        $this->assertEquals([
            Item::get('PendantOfCourage', $this->world),
            Item::get('PendantOfPower', $this->world),
            Item::get('PendantOfWisdom', $this->world),
        ], [
            $this->world->getLocation("Eastern Palace - Prize")->getItem(),
            $this->world->getLocation("Desert Palace - Prize")->getItem(),
            $this->world->getLocation("Tower of Hera - Prize")->getItem(),
        ]);
    }

    /**
     * @group pendants
     */
    public function testPendantsNotRandomizedByConfigCrossWorld()
    {
        Config::set('prize.crossWorld', true);
        Config::set('prize.shufflePendants', false);

        $this->randomizer->randomize();

        $this->assertEquals([
            Item::get('PendantOfCourage', $this->world),
            Item::get('PendantOfPower', $this->world),
            Item::get('PendantOfWisdom', $this->world),
        ], [
            $this->world->getLocation("Eastern Palace - Prize")->getItem(),
            $this->world->getLocation("Desert Palace - Prize")->getItem(),
            $this->world->getLocation("Tower of Hera - Prize")->getItem(),
        ]);
    }
    
    public function testVanillaSwordsSet()
    {
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'accessibility' => 'full', 'mode.weapons' => 'vanilla']);
        $this->randomizer = new Randomizer([$this->world]);
        
        $this->randomizer->prepareWorld($this->world);
        
        $this->assertEquals([
            Item::get('UncleSword', $this->world),
            Item::get('Progressive Sword', $this->world),
            Item::get('Progressive Sword', $this->world),
            Item::get('Progressive Sword', $this->world),
        ], [
            $this->world->getLocation("Link's Uncle")->getItem(),
            $this->world->getLocation("Pyramid Fairy - Left")->getItem(),
            $this->world->getLocation("Blacksmith")->getItem(),
            $this->world->getLocation("Master Sword Pedestal")->getItem(),
        ]);
    }
    
    public function testVanillaSwordsSetWithPedestalGoal()
    {
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'accessibility' => 'full', 'mode.weapons' => 'vanilla', 'goal' => 'pedestal']);
        $this->randomizer = new Randomizer([$this->world]);
        
        $this->randomizer->prepareWorld($this->world);
        
        $this->assertEquals([
            Item::get('UncleSword', $this->world),
            Item::get('Progressive Sword', $this->world),
            Item::get('Progressive Sword', $this->world),
            Item::get('Triforce', $this->world),
        ], [
            $this->world->getLocation("Link's Uncle")->getItem(),
            $this->world->getLocation("Pyramid Fairy - Left")->getItem(),
            $this->world->getLocation("Blacksmith")->getItem(),
            $this->world->getLocation("Master Sword Pedestal")->getItem(),
        ]);
    }
}
