<?php

use ALttP\Support\Flips;

class FlipsTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateBps()
    {
        $flips = new Flips;

        $data = $flips->createBpsFromFiles('tests/samples/empty.bin', 'tests/samples/bytes.bin');

        $this->assertEquals(file_get_contents('tests/samples/patch.bps'), $data);
    }

    /**
     * @return void
     */
    public function testUnreadableFilesThrowException()
    {
        $this->expectException(\Exception::class);

        $flips = new Flips;

        $flips->createBpsFromFiles('tests/samples/thisfilereallydoesntexist', 'tests/samples/bytes.bin');
    }

    /**
     * @return void
     */
    public function testApplyBps()
    {
        $flips = new Flips;

        $data = $flips->applyBpsToFile('tests/samples/empty.bin', 'tests/samples/patch.bps');

        $this->assertEquals(file_get_contents('tests/samples/bytes.bin'), $data);
    }

    /**
     * @return void
     */
    public function testUnreadableFilesThrowExceptionInApply()
    {
        $this->expectException(\Exception::class);

        $flips = new Flips;

        $flips->applyBpsToFile('tests/samples/thisfilereallydoesntexist', 'tests/samples/patch.bps');
    }
}
