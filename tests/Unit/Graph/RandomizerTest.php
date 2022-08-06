<?php

declare(strict_types=1);

namespace Tests\Unit\Graph;

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

    public function testRandomize(): void
    {
        $this->doesNotPerformAssertions();

        $randomizer = new Randomizer();

        $randomizer->randomize();
    }
}
