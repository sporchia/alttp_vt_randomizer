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
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'accessibility' => 'full']);
        $this->open_world = World::factory('open', ['difficulty' => 'test_rules', 'accessibility' => 'full']);
        $this->inverted_world = World::factory('inverted', ['difficulty' => 'test_rules', 'accessibility' => 'full']);
        $this->retro_world = World::factory('retro', ['difficulty' => 'test_rules', 'accessibility' => 'full']);

        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        $this->open_randomizer = new Randomizer([$this->standard_world]);
        $this->inverted_randomizer = new Randomizer([$this->standard_world]);
        $this->retro_randomizer = new Randomizer([$this->standard_world]);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->retro_randomizer);
        unset($this->inverted_randomizer);
        unset($this->open_randomizer);
        unset($this->standard_randomizer);

        unset($this->retro_world);
        unset($this->inverted_world);
        unset($this->open_world);
        unset($this->standard_world);
    }

    /**
     * @group crystals
     */
    public function testCrystalsNotRandomizedByConfigCrossWorld()
    {
        Config::set('prize.crossWorld', true);
        Config::set('prize.shuffleCrystals', false);

        $this->standard_randomizer->randomize();
        $this->assertEquals([
            Item::get('Crystal1', $this->standard_world),
            Item::get('Crystal2', $this->standard_world),
            Item::get('Crystal3', $this->standard_world),
            Item::get('Crystal4', $this->standard_world),
            Item::get('Crystal5', $this->standard_world),
            Item::get('Crystal6', $this->standard_world),
            Item::get('Crystal7', $this->standard_world),
        ], [
            $this->standard_world->getLocation("Palace of Darkness - Prize")->getItem(),
            $this->standard_world->getLocation("Swamp Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Skull Woods - Prize")->getItem(),
            $this->standard_world->getLocation("Thieves' Town - Prize")->getItem(),
            $this->standard_world->getLocation("Ice Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Misery Mire - Prize")->getItem(),
            $this->standard_world->getLocation("Turtle Rock - Prize")->getItem(),
        ]);
    }

    /**
     * @group crystals
     */
    public function testCrystalsNotRandomizedByConfigNoCrossWorld()
    {
        Config::set('prize.crossWorld', false);
        Config::set('prize.shuffleCrystals', false);

        $this->standard_randomizer->randomize();

        $this->assertEquals([
            Item::get('Crystal1', $this->standard_world),
            Item::get('Crystal2', $this->standard_world),
            Item::get('Crystal3', $this->standard_world),
            Item::get('Crystal4', $this->standard_world),
            Item::get('Crystal5', $this->standard_world),
            Item::get('Crystal6', $this->standard_world),
            Item::get('Crystal7', $this->standard_world),
        ], [
            $this->standard_world->getLocation("Palace of Darkness - Prize")->getItem(),
            $this->standard_world->getLocation("Swamp Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Skull Woods - Prize")->getItem(),
            $this->standard_world->getLocation("Thieves' Town - Prize")->getItem(),
            $this->standard_world->getLocation("Ice Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Misery Mire - Prize")->getItem(),
            $this->standard_world->getLocation("Turtle Rock - Prize")->getItem(),
        ]);
    }


    /**
     * @group pendants
     */
    public function testPendantsNotRandomizedByConfigNoCrossWorld()
    {
        Config::set('prize.crossWorld', false);
        Config::set('prize.shufflePendants', false);

        $this->standard_randomizer->randomize();

        $this->assertEquals([
            Item::get('PendantOfCourage', $this->standard_world),
            Item::get('PendantOfPower', $this->standard_world),
            Item::get('PendantOfWisdom', $this->standard_world),
        ], [
            $this->standard_world->getLocation("Eastern Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Desert Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Tower of Hera - Prize")->getItem(),
        ]);
    }

    /**
     * @group pendants
     */
    public function testPendantsNotRandomizedByConfigCrossWorld()
    {
        Config::set('prize.crossWorld', true);
        Config::set('prize.shufflePendants', false);

        $this->standard_randomizer->randomize();

        $this->assertEquals([
            Item::get('PendantOfCourage', $this->standard_world),
            Item::get('PendantOfPower', $this->standard_world),
            Item::get('PendantOfWisdom', $this->standard_world),
        ], [
            $this->standard_world->getLocation("Eastern Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Desert Palace - Prize")->getItem(),
            $this->standard_world->getLocation("Tower of Hera - Prize")->getItem(),
        ]);
    }
    
    public function testVanillaSwordsSet()
    {
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'accessibility' => 'full', 'mode.weapons' => 'vanilla']);
        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        
        $this->standard_randomizer->prepareWorld($this->standard_world);
        
        $this->assertEquals([
            Item::get('UncleSword', $this->standard_world),
            Item::get('Progressive Sword', $this->standard_world),
            Item::get('Progressive Sword', $this->standard_world),
            Item::get('Progressive Sword', $this->standard_world),
        ], [
            $this->standard_world->getLocation("Link's Uncle")->getItem(),
            $this->standard_world->getLocation("Pyramid Fairy - Left")->getItem(),
            $this->standard_world->getLocation("Blacksmith")->getItem(),
            $this->standard_world->getLocation("Master Sword Pedestal")->getItem(),
        ]);
    }
    
    public function testVanillaSwordsSetWithPedestalGoal()
    {
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'accessibility' => 'full', 'mode.weapons' => 'vanilla', 'goal' => 'pedestal']);
        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        
        $this->standard_randomizer->prepareWorld($this->standard_world);
        
        $this->assertEquals([
            Item::get('UncleSword', $this->standard_world),
            Item::get('Progressive Sword', $this->standard_world),
            Item::get('Progressive Sword', $this->standard_world),
            Item::get('Triforce', $this->standard_world),
        ], [
            $this->standard_world->getLocation("Link's Uncle")->getItem(),
            $this->standard_world->getLocation("Pyramid Fairy - Left")->getItem(),
            $this->standard_world->getLocation("Blacksmith")->getItem(),
            $this->standard_world->getLocation("Master Sword Pedestal")->getItem(),
        ]);
    }
    
    public function testSimpleBossShuffle()
    {
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'enemizer.bossShuffle' => 'simple']);
        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        
        $this->standard_randomizer->placeBosses($this->standard_world);
        
        $bosses = array_count_values ([ 
                    $this->standard_world->getRegion('Eastern Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Desert Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Tower of Hera')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Palace of Darkness')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Swamp Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Skull Woods')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Thieves Town')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ice Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Misery Mire')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Turtle Rock')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('bottom')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('middle')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('top')->getEName()]);
        
        $this->assertEquals([2, 2, 2, 1, 1, 1, 1, 1, 1, 1],
        [
            $bosses['Armos'],
            $bosses['Lanmola'],
            $bosses['Moldorm'],
            $bosses['Helmasaur'],
            $bosses['Arrghus'],
            $bosses['Mothula'],
            $bosses['Blind'],
            $bosses['Kholdstare'],
            $bosses['Vitreous'],
            $bosses['Trinexx']
        ]);
    }
    
    public function testFullBossShuffle()
    {
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'enemizer.bossShuffle' => 'full']);
        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        
        $this->standard_randomizer->placeBosses($this->standard_world);
        
        $bosses = array_count_values ([ 
                    $this->standard_world->getRegion('Eastern Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Desert Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Tower of Hera')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Palace of Darkness')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Swamp Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Skull Woods')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Thieves Town')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ice Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Misery Mire')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Turtle Rock')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('bottom')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('middle')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('top')->getEName()]);
        
        $this->assertGreaterThanOrEqual(1, $bosses['Armos']);
        $this->assertGreaterThanOrEqual(1, $bosses['Lanmola']);
        $this->assertGreaterThanOrEqual(1, $bosses['Moldorm']);
        $this->assertGreaterThanOrEqual(1, $bosses['Helmasaur']);
        $this->assertGreaterThanOrEqual(1, $bosses['Arrghus']);
        $this->assertGreaterThanOrEqual(1, $bosses['Mothula']);
        $this->assertGreaterThanOrEqual(1, $bosses['Blind']);
        $this->assertGreaterThanOrEqual(1, $bosses['Kholdstare']);
        $this->assertGreaterThanOrEqual(1, $bosses['Vitreous']);
        $this->assertGreaterThanOrEqual(1, $bosses['Trinexx']);
    }
    
    public function testNoBossShuffle()
    {
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'enemizer.bossShuffle' => 'none']);
        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        
        $this->standard_randomizer->placeBosses($this->standard_world);
        
        $this->assertEquals([ 
            'Armos', 
            'Lanmola', 
            'Moldorm', 
            'Helmasaur', 
            'Arrghus', 
            'Mothula', 
            'Blind', 
            'Kholdstare', 
            'Vitreous', 
            'Trinexx', 
            'Armos', 
            'Lanmola', 
            'Moldorm'
          ], [ 
            $this->standard_world->getRegion('Eastern Palace')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Desert Palace')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Tower of Hera')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Palace of Darkness')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Swamp Palace')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Skull Woods')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Thieves Town')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Ice Palace')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Misery Mire')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Turtle Rock')->getBoss('')->getEName(),
            $this->standard_world->getRegion('Ganons Tower')->getBoss('bottom')->getEName(),
            $this->standard_world->getRegion('Ganons Tower')->getBoss('middle')->getEName(),
            $this->standard_world->getRegion('Ganons Tower')->getBoss('top')->getEName()
          ]);
    }
    
    public function testSwordlessSimpleBossShuffle()
    {
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'enemizer.bossShuffle' => 'simple', 'mode.weapons' => 'swordless']);
        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        
        $this->standard_randomizer->placeBosses($this->standard_world);
        
        $bosses = array_count_values ([ 
                    $this->standard_world->getRegion('Eastern Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Desert Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Tower of Hera')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Palace of Darkness')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Swamp Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Skull Woods')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Thieves Town')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ice Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Misery Mire')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Turtle Rock')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('bottom')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('middle')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('top')->getEName()]);
        
        $this->assertEquals('Kholdstare', $this->standard_world->getRegion('Ice Palace')->getBoss('')->getEName());
        
        $this->assertEquals([2, 2, 2, 1, 1, 1, 1, 1, 1, 1],
        [
            $bosses['Armos'],
            $bosses['Lanmola'],
            $bosses['Moldorm'],
            $bosses['Helmasaur'],
            $bosses['Arrghus'],
            $bosses['Mothula'],
            $bosses['Blind'],
            $bosses['Kholdstare'],
            $bosses['Vitreous'],
            $bosses['Trinexx']
        ]);
    }
    
    public function testSwordlessFullBossShuffle()
    {
        $this->standard_world = World::factory('standard', ['difficulty' => 'test_rules', 'enemizer.bossShuffle' => 'full', 'mode.weapons' => 'swordless']);
        $this->standard_randomizer = new Randomizer([$this->standard_world]);
        
        $this->standard_randomizer->placeBosses($this->standard_world);
        
        $bosses = array_count_values ([ 
                    $this->standard_world->getRegion('Eastern Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Desert Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Tower of Hera')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Palace of Darkness')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Swamp Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Skull Woods')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Thieves Town')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ice Palace')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Misery Mire')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Turtle Rock')->getBoss('')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('bottom')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('middle')->getEName(),
                    $this->standard_world->getRegion('Ganons Tower')->getBoss('top')->getEName()]);
        
        $this->assertEquals('Kholdstare', $this->standard_world->getRegion('Ice Palace')->getBoss('')->getEName());
        
        $this->assertGreaterThanOrEqual(1, $bosses['Armos']);
        $this->assertGreaterThanOrEqual(1, $bosses['Lanmola']);
        $this->assertGreaterThanOrEqual(1, $bosses['Moldorm']);
        $this->assertGreaterThanOrEqual(1, $bosses['Helmasaur']);
        $this->assertGreaterThanOrEqual(1, $bosses['Arrghus']);
        $this->assertGreaterThanOrEqual(1, $bosses['Mothula']);
        $this->assertGreaterThanOrEqual(1, $bosses['Blind']);
        $this->assertEquals(1, $bosses['Kholdstare']);
        $this->assertGreaterThanOrEqual(1, $bosses['Vitreous']);
        $this->assertGreaterThanOrEqual(1, $bosses['Trinexx']);
    }

    public function testCompletionistItemCount()
    {
        $this->assertEquals(216, $this->standard_world->getTotalItemCount());
        $this->assertEquals(216, $this->open_world->getTotalItemCount());
        $this->assertEquals(216, $this->inverted_world->getTotalItemCount());
        $this->assertEquals(216, $this->retro_world->getTotalItemCount());
    }
}
