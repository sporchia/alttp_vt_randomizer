<?php

declare(strict_types=1);

namespace Tests\Unit\Graph;

use App\Graph\World;
use Tests\TestCase;

/**
 * @group graph
 */
final class WorldTest extends TestCase
{
    public function testConstructor(): void
    {
        $world = new World();

        $this->assertInstanceOf(World::class, $world);
    }
}
