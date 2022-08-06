<?php

declare(strict_types=1);

namespace Tests\Unit\Graph;

use App\Graph\EdgeCollector;
use App\Graph\Item;
use App\Graph\Randomizer;
use App\Graph\VertexCollector;
use Tests\TestCase;

/**
 * Basic Graph testing, this still move to appropo places later.
 *
 * @group graph
 */
final class GraphTest extends TestCase
{
    public function testBasicTraversal(): void
    {
        $this->markTestSkipped();

        $this->mock(VertexCollector::class, function ($mock) {
            $mock->shouldReceive('getForWorld')->once()->andReturn([
                ['name' => 'v1:0', 'item' => 'Flippers', 'type' => 'standing'],
                ['name' => 'v2:0'],
                ['name' => 'v3:0', 'item' => 'MapP1', 'type' => 'standing'],
            ]);
        });
        $this->mock(EdgeCollector::class, function ($mock) {
            $mock->shouldReceive('getForWorld')->once()->andReturn([
                'fixed:0' => [
                    'directed' => [
                        ['start', 'v1:0'],
                        ['v2:0', 'v3:0'],
                    ],
                    'undirected' => [],
                ],
                'Flippers:0' => [
                    'directed' => [
                        ['v1:0', 'v2:0'],
                    ],
                    'undirected' => [],
                ],
            ]);
        });

        $world = new Randomizer();
        $this->assertFalse($world->canReachLocation('v3:0'));
        $world->assumeItems([]);
        $this->assertTrue($world->canReachLocation('v3:0'));
    }

    public function testDarkWorldLightWorldConnector(): void
    {
        $this->markTestSkipped();

        $this->mock(VertexCollector::class, function ($mock) {
            $mock->shouldReceive('getForWorld')->once()->andReturn([
                ['name' => 'mearl:0'],
                ['name' => 'frod:0', 'item' => 'DarkFireRod'],
                ['name' => 'South Kakariko:0', 'moonpearl' => false],
                ['name' => 'Brother right:0'],
                ['name' => 'Brother left:0'],
                ['name' => 'darkworld totems:0', 'moonpearl' => true],
                ['name' => 'darkworld MacGuffin:0', 'moonpearl' => true],
            ]);
        });
        $this->mock(EdgeCollector::class, function ($mock) {
            $mock->shouldReceive('getForWorld')->once()->andReturn([
                'fixed:0' => [
                    'directed' => [
                        ['start', 'South Kakariko:0'],
                        ['Brother left:0', 'darkworld totems:0'],
                    ],
                    'undirected' => [
                        ['South Kakariko:0', 'Brother right:0'],
                    ],
                ],
                'bombs:0' => [
                    'directed' => [
                        ['darkworld totems:0', 'Brother left:0'],
                    ],
                    'undirected' => [
                        ['Brother right:0', 'Brother left:0'],
                    ],
                ],
                'FireRod:0' => [
                    'directed' => [
                        ['mearl:0', 'frod:0'],
                        ['darkworld totems:0', 'darkworld MacGuffin:0'],
                    ],
                    'undirected' => [],
                ],
                'MoonPearl:0' => [
                    'directed' => [
                        ['start', 'mearl:0'],
                    ],
                    'undirected' => [],
                ],
            ]);
        });

        $world = new Randomizer();
        $world->assumeItems([Item::get('bombs', 0)]);
        $this->assertTrue($world->canReachLocation('darkworld totems:0'));
        $world->assumeItems([Item::get('bombs', 0), Item::get('FireRod', 0)]);
        $this->assertFalse($world->canReachLocation('darkworld MacGuffin:0'));
        $world->assumeItems([Item::get('bombs', 0), Item::get('MoonPearl', 0), Item::get('FireRod', 0)]);
        $this->assertTrue($world->canReachLocation('darkworld totems:0'));
    }

    public function testDarkWorldLightWorldConnector2(): void
    {
        $this->markTestSkipped();

        $this->mock(VertexCollector::class, function ($mock) {
            $mock->shouldReceive('getForWorld')->once()->andReturn([
                ['name' => 'mearl:0'],
                ['name' => 'frod:0', 'item' => 'DarkFireRod'],
                ['name' => 'South Kakariko:0', 'moonpearl' => false],
                ['name' => 'Brother right:0', 'item' => 'BookOfMudora'],
                ['name' => 'Brother left:0'],
                ['name' => 'darkworld totems:0', 'moonpearl' => true],
                ['name' => 'darkworld blah:0', 'item' => 'MoonPearl', 'moonpearl' => true],
                ['name' => 'darkworld MacGuffin:0', 'moonpearl' => true],
            ]);
        });
        $this->mock(EdgeCollector::class, function ($mock) {
            $mock->shouldReceive('getForWorld')->once()->andReturn([
                'fixed:0' => [
                    'directed' => [
                        ['start', 'South Kakariko:0'],
                        ['Brother left:0', 'darkworld totems:0'],
                    ],
                    'undirected' => [
                        ['South Kakariko:0', 'Brother right:0'],
                        // ['darkworld totems', 'darkworld blah'],
                    ],
                ],
                'BookOfMudora:0' => [
                    'directed' => [
                        ['darkworld totems:0', 'darkworld blah:0'],
                    ],
                    'undirected' => [],
                ],
                'bombs:0' => [
                    'directed' => [
                        ['darkworld totems:0', 'Brother left:0'],
                    ],
                    'undirected' => [
                        ['Brother right:0', 'Brother left:0'],
                    ],
                ],
                'FireRod:0' => [
                    'directed' => [
                        ['mearl:0', 'frod:0'],
                        ['darkworld totems:0', 'darkworld MacGuffin:0'],
                    ],
                    'undirected' => [],
                ],
                'MoonPearl:0' => [
                    'directed' => [
                        ['start', 'mearl:0'],
                    ],
                    'undirected' => [],
                ],
            ]);
        });

        $world = new Randomizer();
        $world->assumeItems([Item::get('bombs', 0), Item::get('FireRod', 0)]);
        $this->assertTrue($world->canReachLocation('darkworld MacGuffin:0'));
    }
}
