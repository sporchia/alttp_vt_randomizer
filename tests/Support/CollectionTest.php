<?php

use ALttP\Support\Collection;

class CollectionTest extends TestCase
{
    /**
     * set up all tests.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->collection = new Collection;
    }

    /**
     * clean up after each test.
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->collection);
    }

    /**
     * @return void
     */
    public function testRandomCollectionDoesNotUnderflow()
    {
        $this->collection[] = 'item1';

        $this->assertEquals(['item1'], $this->collection->randomCollection(10)->values());
    }

    /**
     * @return void
     */
    public function testRandomCollection()
    {
        $this->collection[] = 'item1';
        $this->collection[] = 'item2';
        $this->collection[] = 'item3';

        $this->assertNotEquals(['item1', 'item2', 'item3'], $this->collection->randomCollection(2)->values());
    }
}
