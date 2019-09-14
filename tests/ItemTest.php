<?php

use ALttP\Item;
use ALttP\World;

class ItemTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    public function testGetName()
    {
        $item = new Item('Test', [0x0F, 0x00, 't0' => 0x31, 't1' => 0x90], $this->world);

        $this->assertEquals('Test:' . $this->world->id, $item->getName());
    }

    public function testGetNiceName()
    {
        $item = new Item('Test', [0x0F, 0x00, 't0' => 0x31, 't1' => 0x90], $this->world);

        $this->assertEquals('Testing Item', $item->getNiceName());
    }

    public function testToString()
    {
        $item = new Item('Test', [0x0F], $this->world);

        $this->assertEquals('Testa:1:{i:0;i:15;}', (string) $item);
    }

    public function testGetL1Sword()
    {
        $this->assertEquals([0x49], Item::get('L1Sword', $this->world)->getBytes());
    }

    public function testGetL1SwordAndShield()
    {
        $this->assertEquals([0x00], Item::get('L1SwordAndShield', $this->world)->getBytes());
    }

    public function testGetL2Sword()
    {
        $this->assertEquals([0x01], Item::get('L2Sword', $this->world)->getBytes());
    }

    public function testGetMasterSword()
    {
        $this->assertEquals([0x50], Item::get('MasterSword', $this->world)->getBytes());
    }

    public function testGetL3Sword()
    {
        $this->assertEquals([0x02], Item::get('L3Sword', $this->world)->getBytes());
    }

    public function testGetL4Sword()
    {
        $this->assertEquals([0x03], Item::get('L4Sword', $this->world)->getBytes());
    }

    public function testGetRupoor()
    {
        $this->assertEquals([0x59], Item::get('Rupoor', $this->world)->getBytes());
    }

    public function testGetNothing()
    {
        $this->assertEquals([0x5A], Item::get('Nothing', $this->world)->getBytes());
    }

    public function testGetRedClock()
    {
        $this->assertEquals([0x5B], Item::get('RedClock', $this->world)->getBytes());
    }

    public function testGetBlueClock()
    {
        $this->assertEquals([0x5C], Item::get('BlueClock', $this->world)->getBytes());
    }

    public function testGetGreenClock()
    {
        $this->assertEquals([0x5D], Item::get('GreenClock', $this->world)->getBytes());
    }

    public function testGetProgressiveSword()
    {
        $this->assertEquals([0x5E], Item::get('ProgressiveSword', $this->world)->getBytes());
    }

    public function testGetProgressiveShield()
    {
        $this->assertEquals([0x5F], Item::get('ProgressiveShield', $this->world)->getBytes());
    }

    public function testGetProgressiveArmor()
    {
        $this->assertEquals([0x60], Item::get('ProgressiveArmor', $this->world)->getBytes());
    }
}
