<?php

declare(strict_types=1);

namespace App\Graph;

use App\Sprite;

/**
 * Modify Prizepacks based on configuration.
 */
final class PrizePackShuffler
{
    /**
     * @param World $world 
     *
     * @return void
     */
    public function __construct(private World $world)
    {
    }

    /**
     * Pick items for each prize pack.
     */
    public function adjustEdges(): void
    {
        $prizepacks = $this->world->getLocationsOfType('prizepack');

        if (!$this->world->config('customPrizePacks', false)) {
            $random_vanilla_packs = array_merge(...fy_shuffle([
                ['Heart', 'Heart', 'Heart', 'Heart', 'RupeeGreen', 'Heart', 'Heart', 'RupeeGreen'],
                ['RupeeBlue', 'RupeeGreen', 'RupeeBlue', 'RupeeRed', 'RupeeBlue', 'RupeeGreen', 'RupeeBlue', 'RupeeBlue'],
                ['MagicRefillFull', 'MagicRefillSmall', 'MagicRefillSmall', 'RupeeBlue', 'MagicRefillFull', 'MagicRefillSmall', 'Heart', 'MagicRefillSmall'],
                ['BombRefill1', 'BombRefill1', 'BombRefill1', 'BombRefill4', 'BombRefill1', 'BombRefill1', 'BombRefill8', 'BombRefill1'],
                ['ArrowRefill5', 'Heart', 'ArrowRefill5', 'ArrowRefill10', 'ArrowRefill5', 'Heart', 'ArrowRefill5', 'ArrowRefill10'],
                ['MagicRefillSmall', 'RupeeGreen', 'Heart', 'ArrowRefill5', 'MagicRefillSmall', 'BombRefill1', 'RupeeGreen', 'Heart'],
                ['Heart', 'Fairy', 'MagicRefillFull', 'RupeeRed', 'BombRefill8', 'Heart', 'RupeeRed', 'ArrowRefill10'],
            ]));

            $prizepacksOrdered = $prizepacks->sortBy('offset');
            foreach ($prizepacksOrdered as $pack) {
                $spriteName = array_pop($random_vanilla_packs);
                if (!$spriteName) {
                    $pack->sprite = null;
                } else {
                    $pack->sprite = Sprite::get($spriteName);
                }
            }
        }

        $emptypacks = $prizepacks->filter(fn ($pack) => !$pack->sprite);

        if ($emptypacks->count()) {
            // TODO refactor this
            $drops = [];
            foreach ($this->world->config('item.drop', []) as $sprite_name => $count) {
                $drops = array_merge($drops, array_fill(0, min($this->world->config('drop.count.' . $sprite_name, $count), 63), Sprite::get($sprite_name)));
            }
            $drop_pool = fy_shuffle($drops);

            foreach ($emptypacks as $pack) {
                $pack->sprite = array_pop($drop_pool);
            }
        }

        // hard+ does not allow fairies/full magics
        if ($this->world->config('rom.HardMode', 0) >= 2) {
            $fairy = Sprite::get('Fairy');
            $heart = Sprite::get('Heart');
            $magic = Sprite::get('MagicRefillFull');
            $small_magic = Sprite::get('MagicRefillSmall');
            foreach ($prizepacks as $prizepack) {
                if ($prizepack->sprite === $fairy) {
                    $prizepack->sprite = $heart;
                }
                if ($prizepack->sprite === $magic) {
                    $prizepack->sprite = $small_magic;
                }
            }
        }

        if ($this->world->config('rom.rupeeBow', false)) {
            $arrows5 = Sprite::get('ArrowRefill5');
            $arrows10 = Sprite::get('ArrowRefill10');
            $rupeeBlue = Sprite::get('RupeeBlue');
            $rupeeRed = Sprite::get('RupeeRed');
            foreach ($prizepacks as $prizepack) {
                if ($prizepack->sprite === $arrows5) {
                    $prizepack->sprite = $rupeeBlue;
                }
                if ($prizepack->sprite === $arrows10) {
                    $prizepack->sprite = $rupeeRed;
                }
            }
        }
    }
}
