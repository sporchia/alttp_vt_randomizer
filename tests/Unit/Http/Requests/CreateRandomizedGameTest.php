<?php

namespace Tests\Unit\Http\Requests;

use ALttP\Http\Requests\CreateRandomizedGame;
use MohammedManssour\FormRequestTester\TestsFormRequests;
use TestCase;

/**
 * Assure our validation rules are correct for input.
 */
class CreateRandomizedGameTest extends TestCase
{
    use TestsFormRequests;

    /**
     * @dataProvider badPostData
     *
     * @param array  $post_data  Input data that should fail
     *
     * @return void
     */
    public function testFailingOnBadInput(array $post_data): void
    {
        $this->formRequest(CreateRandomizedGame::class, $post_data)
            ->assertAuthorized()
            ->assertValidationFailed();
    }

    /**
     * @return array
     */
    public function badPostData(): array
    {
        return [
            [['glitches' => 'bad']],
            [['item_placement' => 'bad']],
            [['dungeon_items' => 'bad']],
            [['accessibility' => 'bad']],
            [['goal' => 'bad']],
            [['crystals' => ['tower' => 'bad']]],
            [['crystals' => ['ganon' => 'bad']]],
            [['mode' => 'bad']],
            [['entrances' => 'bad']],
            [['enemizer' => ['boss_shuffle' => 'bad']]],
            [['enemizer' => ['enemy_shuffle' => 'bad']]],
            [['hints' => 'bad']],
            [['weapons' => 'bad']],
            [['item' => ['pool' => 'bad']]],
            [['item' => ['functionality' => 'bad']]],
            [['enemizer' => ['enemy_damage' => 'bad']]],
            [['enemizer' => ['enemy_health' => 'bad']]],
        ];
    }
}
