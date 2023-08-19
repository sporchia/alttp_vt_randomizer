<?php

class HelpersTest extends TestCase
{
    // it's highly unlikely that this will fail
    public function testMtShuffleDifferentReturn()
    {
        $unshuffled = range(0, 1000);

        $this->assertNotEquals(fy_shuffle($unshuffled), $unshuffled);
    }

    public function testMtShuffleSameValues()
    {
        $unshuffled = range(0, 1000);
        $shuffled = fy_shuffle($unshuffled);

        sort($unshuffled);
        sort($shuffled);

        $this->assertEquals($unshuffled, $shuffled);
    }

    public function testKsortr()
    {
        $unsorted = [
            'zed' => [
                '1' => '2',
                'red' => '4',
                'fed' => 0,
            ],
            'yo' => [
                '3' => 'hello',
                'goo' => 'foo',
                'bar' => 'baz',
            ],
        ];
        ksortr($unsorted);
        $this->assertSame([
            'yo' => [
                'bar' => 'baz',
                'goo' => 'foo',
                '3' => 'hello',
            ],
            'zed' => [
                'fed' => 0,
                'red' => '4',
                '1' => '2',
            ],
        ], $unsorted);
    }

    public function testPatchMinify()
    {
        $patch = [
            [1 => [2]],
            [2 => [3]],
            [5 => [5, 4]],
            [2 => [4]],
        ];

        $this->assertEquals([
            [1 => [2, 4]],
            [5 => [5, 4]],
        ], patch_merge_minify($patch));
    }

    public function testPatchMinifyParam2()
    {
        $patch = [
            [1 => [2]],
            [2 => [3]],
            [5 => [5, 4]],
            [2 => [4]],
        ];

        $this->assertEquals([
            [1 => [2, 4]],
            [5 => [5, 4]],
        ], patch_merge_minify([], $patch));
    }

    public function testSnesToPc()
    {
        $this->assertEquals(snes_to_pc(0x008123), 0x000123);
        $this->assertEquals(snes_to_pc(0x808123), 0x000123);
        $this->assertEquals(snes_to_pc(0x018456), 0x008456);
        $this->assertEquals(snes_to_pc(0x818456), 0x008456);
        $this->assertEquals(snes_to_pc(0x04FFFF), 0x027FFF);
        $this->assertEquals(snes_to_pc(0x05FFFF), 0x02FFFF);
    }
    public function testPcToSnes()
    {
        $this->assertEquals(pc_to_snes(0x000123), 0x008123);
        $this->assertEquals(pc_to_snes(0x008456), 0x018456);
        $this->assertEquals(pc_to_snes(0x027FFF), 0x04FFFF);
        $this->assertEquals(pc_to_snes(0x02FFFF), 0x05FFFF);
    }

    public function testPatchMergeMinify()
    {
        $patch = [
            [1 => [2]],
            [2 => [3]],
            [5 => [5, 4]],
            [2 => [4]],
        ];
        $patch_2 = [
            [1 => [0]],
            [2 => [2, 3, 4]],
            [7 => [0, 1]],
            [8 => [4]],
        ];
        $this->assertEquals([
            [1 => [0, 2, 3, 4, 5, 4, 0, 4]],
        ], patch_merge_minify($patch, $patch_2));
    }
}
