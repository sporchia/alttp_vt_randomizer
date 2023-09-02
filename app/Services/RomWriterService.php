<?php

namespace App\Services;

use App\Graph\Item;
use App\Graph\Vertex;
use App\Rom;
use App\Graph\World;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Service class to write world data to a rom in memory.
 */
class RomWriterService
{
    /**
     * write the current generated data to the Rom. If an override patch is set
     * it will use that instead.
     *
     * @param World $world world to pull data from
     * @param Rom $rom Rom to write data to
     */
    public function writeWorldToRom(World $world, Rom $rom): void
    {
        (new RomTextWriterService())->writeTextToRom($world, $rom);
        (new RomCreditWriterService())->writeCreditsToRom($world, $rom);

        if (!$world->config('multiworld', false)) {
            foreach ($world->getWritableVertices() as $location) {
                $item = $location->item ?? Item::get('Nothing', $world->id);
                if (!$world->config('region.wildKeys') && strpos($item->name, 'Key') === 0) {
                    $item = Item::get('Key', $world->id);
                }
                if (!$world->config('region.wildBigKeys') && strpos($item->name, 'BigKey') === 0) {
                    $item = Item::get('BigKey', $world->id);
                }

                foreach ($location->addresses ?? [] as $key => $address) {
                    if (!isset($item->bytes[$key]) || !isset($address)) {
                        continue;
                    }
                    $rom->write($address, pack('C', $item->bytes[$key]));
                }
            }
        }

        // special cases
        // @move this later
        $hera_item_location = $world->getLocation('Tower Of Hera - Basement Cage');
        if ($hera_item_location) {
            $hera_item = $hera_item_location->item;
            $rom->write(0x4E3BB, pack('C', (in_array($hera_item, ['Key', 'KeyP3']) ? 0xE4 : 0xEB)));
        }

        // repoint room headers to `tables.asm` table.
        for ($i = 0; $i < 0x0140; $i++) {
            $rom->write(snes_to_pc(0x04F1E2 + $i * 2), pack('S', 0x30DA00 + $i * 14));
        }
        $rom->write(snes_to_pc(0x01B5E7), pack('C', 0x30));
        // end special cases

        $rom->setGoalRequiredCount($world->config('item.Goal.Required', 0) ?: 0);
        $rom->setGoalIcon($world->config('item.Goal.Icon', 'triforce'));

        $rom->setRupoorValue($world->config('item.value.Rupoor', 0) ?: 0);

        $rom->setGanonAgahnimRng($world->config('rom.GanonAgRNG', 'table'));

        $rom->setTowerCrystalRequirement($world->config('crystals.tower', 7));
        $rom->setGanonCrystalRequirement($world->config('crystals.ganon', 7));

        $rom->setGenericKeys($world->config('rom.genericKeys', false));
        $this->writeShops($world, $rom);
        $rom->setRupeeArrow($world->config('rom.rupeeBow', false));
        $rom->setLockAgahnimDoorInEscape(true);
        $rom->setWishingWellChests(true);
        $rom->setWishingWellUpgrade(false);
        $rom->setHyliaFairyShop(true);
        $rom->setRestrictFairyPonds(true);
        $rom->setLimitProgressiveSword(
            $world->config('item.overflow.count.Sword', 4),
            Item::get($world->config('item.overflow.replacement.Sword', 'TwentyRupees2'), $world->id)->bytes[0]
        );
        $rom->setLimitProgressiveShield(
            $world->config('item.overflow.count.Shield', 3),
            Item::get($world->config('item.overflow.replacement.Shield', 'TwentyRupees2'), $world->id)->bytes[0]
        );
        $rom->setLimitProgressiveArmor(
            $world->config('item.overflow.count.Armor', 2),
            Item::get($world->config('item.overflow.replacement.Armor', 'TwentyRupees2'), $world->id)->bytes[0]
        );
        $rom->setLimitBottle(
            $world->config('item.overflow.count.Bottle', 4),
            Item::get($world->config('item.overflow.replacement.Bottle', 'TwentyRupees2'), $world->id)->bytes[0]
        );
        $rom->setLimitProgressiveBow(
            $world->config('item.overflow.count.Bow', 2),
            Item::get($world->config('item.overflow.replacement.Bow', 'TwentyRupees2'), $world->id)->bytes[0]
        );

        $rom->setSilversEquip('collection');
        $rom->setSubstitutions([
            0x12, 0x01, 0x35, 0xFF, // lamp -> 5 rupees
            0x51, 0x06, 0x52, 0xFF, // 6 +5 bomb upgrades -> +10 bomb upgrade
            0x53, 0x06, 0x54, 0xFF, // 6 +5 arrow upgrades -> +10 arrow upgrade
            0x58, 0x01, $world->config('rom.rupeeBow', false) ? 0x36 : 0x43, 0xFF, // silver arrows -> 1 arrow
            0x3E, $world->config('item.overflow.count.BossHeartContainer', 10), 0x47, 0xFF, // boss heart -> 20 rupees
            0x17, $world->config('item.overflow.count.PieceOfHeart', 24), 0x47, 0xFF, // piece of heart -> 20 rupees
        ]);

        switch ($world->config('goal')) {
            case 'triforce-hunt':
                $rom->enableTriforceTurnIn(true);

                // no break
            case 'pedestal':
                $rom->setGanonInvincible('yes');
                break;
            case 'dungeons':
                $rom->setGanonInvincible('dungeons');
                break;
            case 'fast_ganon':
                $rom->initial_sram->preOpenPyramid();

                // no break
            default:
                $rom->setGanonInvincible('custom');
        }

        $map_reveals  = [
            1 => null, // 'Hyrule Castle'
            2 => 0x2000, // 'Eastern Palace'
            3 => 0x1000, // 'Desert Palace - Front'
            4 => 0x1000, // 'Desert Palace - Back'
            5 => 0x0020, // 'Tower Of Hera'
            6 => null, // 'Agahnims Tower'
            7 => 0x0200, // 'Palace of Darkness'
            8 => 0x0400, // 'Swamp Palace'
            9 => 0x0080, // 'Skull Woods - Front'
            10 => 0x0080, // 'Skull Woods - Middle'
            11 => 0x0080, // 'Skull Woods - Back'
            12 => 0x0010, // 'Thieves Town'
            13 => 0x0040, // 'Ice Palace'
            14 => 0x0100, // 'Misery Mire'
            15 => 0x0008, // 'Turtle Rock'
            16 => null, // 'Ganon's Tower'
        ];

        if ($world->config('rom.mapOnPickup', false)) {
            $green_pendant_location = $world->getLocationsWithItem(Item::get('PendantOfCourage', $world->id))->first();

            $rom->setMapRevealSahasrahla($map_reveals[$green_pendant_location->group]);

            $crystal5_location = $world->getLocationsWithItem(Item::get('Crystal5', $world->id))->first();
            $crystal6_location = $world->getLocationsWithItem(Item::get('Crystal6', $world->id))->first();

            $rom->setMapRevealBombShop($map_reveals[$crystal5_location->group] | $map_reveals[$crystal6_location->group]);
        }

        $rom->setMapMode($world->config('rom.mapOnPickup', false));
        $rom->setCompassMode($world->config('rom.dungeonCount', 'off'));
        $rom->setCompassCountTotals();
        $rom->setFreeItemTextMode($world->config('rom.freeItemText', 0x00));
        $rom->setFreeItemMenu($world->config('rom.freeItemMenu', 0x00));
        $rom->setDiggingGameRng(get_random_int(1, 30));

        $rom->writeRNGBlock(function () {
            return get_random_int(0, 0x100);
        });

        $this->writePrizePacks($world, $rom);

        if ($world->config('enemizer.enemyDamage', 'default') !== 'default') {
            $this->enemizeEnemyDamage($world, $rom);
        }
        if ($world->config('enemizer.enemyHealth', 'default') !== 'default') {
            $this->enemizeEnemyHealth($world, $rom);
        }

        $this->writeEnemies($world, $rom);
        $this->writeEntrances($world, $rom);

        $rom->setPyramidFairyChests($world->config('region.swordsInPool', true));
        $rom->setSmithyQuickItemGive($world->config('region.swordsInPool', true));

        $rom->setGameState($world->config('mode.state'));
        $rom->setSwordlessMode($world->config('mode.weapons') === 'swordless');

        $links_uncle_item = $world->getLocation("Link's Uncle:" . $world->id)->item;
        if (!$links_uncle_item || strpos($links_uncle_item->name, 'Sword') === false) {
            $rom->removeUnclesSword();
        }
        if (!$links_uncle_item || strpos($links_uncle_item->name, 'Shield') === false) {
            $rom->removeUnclesShield();
        }

        $rom->initial_sram->setStartingEquipment($world->collected_items, [
            'rom.rupeeBow' => $world->config('rom.rupeeBow'),
            'mode.weapons' => $world->config('mode.weapons'),
        ]);
        $rom->setMaxArrows();
        $rom->setMaxBombs();
        $rom->setBallNChainDungeon(0x02);

        $rom->setCapacityUpgradeFills([
            $world->config('item.value.BombUpgrade5', 50),
            $world->config('item.value.BombUpgrade10', 50),
            $world->config('item.value.ArrowUpgrade5', 70),
            $world->config('item.value.ArrowUpgrade10', 70),
        ]);

        // currently has to be after compass mode, as this will override compass mode.
        $rom->setClockMode($world->config('rom.timerMode', 'off'));

        $rom->setBlueClock($world->config('item.value.BlueClock', 0) ?: 0);
        $rom->setRedClock($world->config('item.value.RedClock', 0) ?: 0);
        $rom->setGreenClock($world->config('item.value.GreenClock', 0) ?: 0);
        $rom->initial_sram->setStartingTimer($world->config('rom.timerStart', 0) ?: 0);

        switch ($world->config('rom.logicMode', $world->config('logic'))) {
            case 'MajorGlitches':
            case 'None':
                $rom->setSwampWaterLevel(false);
                $rom->setPreAgahnimDarkWorldDeathInDungeon(false);
                $rom->setSaveAndQuitFromBossRoom(true);
                $rom->setWorldOnAgahnimDeath(false);
                $rom->setRandomizerSeedType('MajorGlitches');
                $rom->setWarningFlags(bindec('01100000'));
                $rom->setSQEGFix(false);
                break;
            case 'OverworldGlitches':
                $rom->setPreAgahnimDarkWorldDeathInDungeon(false);
                $rom->setSaveAndQuitFromBossRoom(true);
                $rom->setWorldOnAgahnimDeath(true);
                $rom->setRandomizerSeedType('OverworldGlitches');
                $rom->setWarningFlags(bindec('01000000'));
                $rom->setSQEGFix(false);
                break;
            case 'NoGlitches':
            default:
                $rom->setSaveAndQuitFromBossRoom(true);
                $rom->setWorldOnAgahnimDeath(true);
                $rom->setSQEGFix(true);
                break;
        }

        if ($world->config('crystals.tower') === 0) {
            $rom->initial_sram->preOpenGanonsTower();
        }

        $rom->setGameType('item');
        $rom->writeInitialSram();
    }

    public function writePrizePacks(World $world, $rom): void
    {
        $prizepacks = $world->getLocationsOfType('prizepack');

        foreach ($prizepacks as $prizepack) {
            $rom->write(0x37A78 + $prizepack->offset, pack('C*', $prizepack->sprite->byte));
        }

        if ($world->config('rom.rupeeBow', false)) {
            $rom->setOverworldDigPrizes([
                0xB2, 0xD8, 0xD8, 0xD8,
                0xD8, 0xD8, 0xD8, 0xD8, 0xD8,
                0xD9, 0xD9, 0xD9, 0xD9, 0xD9,
                0xDA, 0xDA, 0xDA, 0xDA, 0xDA,
                0xDB, 0xDB, 0xDB, 0xDB, 0xDB,
                0xDC, 0xDC, 0xDC, 0xDC, 0xDC,
                0xDD, 0xDD, 0xDD, 0xDD, 0xDD,
                0xDE, 0xDE, 0xDE, 0xDE, 0xDE,
                0xDF, 0xDF, 0xDF, 0xDF, 0xDF,
                0xE0, 0xE0, 0xE0, 0xE0, 0xE0,
                0xDA, 0xDA, 0xDA, 0xDA, 0xDA,
                0xDB, 0xDB, 0xDB, 0xDB, 0xDB,
                0xE3, 0xE3, 0xE3, 0xE3, 0xE3,
            ]);
        }
    }

    /**
     * Set enemy damage values based on configuration for world.
     *
     * @param World $world world to pull config from
     * @param Rom $rom rom to write data to
     */
    private function enemizeEnemyDamage(World $world, Rom $rom): void
    {
        $dmg_bytes = $rom->read(0x6B266, 0xF3);
        $update_sprites = collect(range(0x00, 0xF2));

        switch ($world->config('enemizer.enemyDamage')) {
            case 'shuffled':
                $table = fy_shuffle($update_sprites
                    ->map(fn ($offset) => $dmg_bytes[$offset] & 0x0F)->toArray());
                break;
            case 'random':
            default:
                $table = array_map(fn () => random_int(0, 9), array_fill(0, 0xF3, null));
        }

        foreach ($update_sprites as $sprite_id) {
            $dmg_bytes[$sprite_id] = ($dmg_bytes[$sprite_id] & 0xF0) | current($table);
            next($table);
        }
        $rom->write(0x6B266, pack('C*', ...$dmg_bytes));
        // Other Damage values:
        $rom->write(snes_to_pc(0x068874), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068875), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068888), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068889), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x0688A4), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x0688A5), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068963), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068964), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068D99), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068D9A), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068F74), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x068F75), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x069127), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x069128), pack('C', random_int(0x00, 0x09)));
        $rom->write(snes_to_pc(0x06EE0B), pack('C', random_int(0x00, 0x09)));
    }

    /**
     * Set enemy health values based on configuration for world.
     *
     * @param World $world world to pull config from
     * @param Rom $rom rom to write data to
     */
    private function enemizeEnemyHealth(World $world, Rom $rom): void
    {
        $range = [
            'easy' => [1, 4],
            'medium' => [2, 15],
            'hard' => [2, 25],
            'expert' => [4, 50],
        ][$world->config('enemizer.enemyHealth')];
        $health_bytes = $rom->read(0x6B173, 0xD4);
        $update_sprites = collect(range(0x00, 0xD3))
            ->reject(fn ($sprite_id) => $health_bytes[$sprite_id] === 0xFF || in_array($sprite_id, [
                0x89, 0x70, 0xBF, 0xCE, 0xA3, 0x7A, 0x7B, 0xA4,
            ]));

        /** @var int $offset */
        foreach ($update_sprites as $offset) {
            $rom->write(0x6B173 + $offset, pack('C', random_int($range[0], $range[1])));
        }

        // Health values
        $rom->write(snes_to_pc(0x068876), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x068877), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x06888A), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x06888B), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x0688A6), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x0688A7), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x068965), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x068966), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x068D97), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x068D98), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x068F76), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x068F77), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x06911F), pack('C', random_int($range[0], $range[1])));
        $rom->write(snes_to_pc(0x069120), pack('C', random_int($range[0], $range[1])));
    }

    /**
     * Write Room headers, and room data for all enemies in game.
     *
     * @param World $world world to pull config from
     * @param Rom $rom rom to write data to
     */
    private function writeEnemies(World $world, Rom $rom): void
    {
        $enemies = $world->getLocationsOfType('mob');

        // @TODO check if I can just use 'roomid'
        /** @var Collection<Collection<Vertex>> $enemy_rooms */
        $enemy_rooms = $enemies->groupBy(fn ($enemy) => $enemy->roomid);

        $output_offsets = [];
        // empty room ;)
        $output_bytes = [0x00, 0xFF];
        for ($i = 0; $i < 0x180; $i++) {
            if (!isset($enemy_rooms[$i]) || count($enemy_rooms[$i]) === 0) {
                $output_offsets[$i] = 0x0000;
                continue;
            }
            $output_offsets[$i] = count($output_bytes);
            // Some OAM forcing magic stuff based on room_id
            $output_bytes[] = (int) in_array($i, [0x14, 0x15, 0x51, 0x59, 0x5B, 0x60, 0x62, 0x81, 0x86, 0xA8, 0xAA, 0xB2, 0xB9, 0xC2, 0xCB, 0xCC, 0xDB, 0xDC]);
            foreach ($enemy_rooms[$i] as $enemy) {
                $sprite = $enemy->sprite;
                $output_bytes[] = (($sprite->subtype & 0x18) << 2)
                    + ($enemy->position['z'] << 7)
                    + $enemy->position['y'];
                $output_bytes[] = (($sprite->subtype & 0x07) << 5)
                    + $enemy->position['x'];
                $output_bytes[] = $sprite->byte;
                if ($enemy->item) {
                    // @todo update this when we can place any item
                    $output_bytes[] = strpos($enemy->item->name, 'BigKey') !== false ? 0xFD : 0xFE;
                    $output_bytes[] = 0x00;
                    $output_bytes[] = 0xE4;
                }
            }
            $output_bytes[] = 0xFF;
            // room header
            $rom->write(snes_to_pc(0x30DA00) + ($i * 14) + 3, pack('C', $world->sprite_sheets['underworld'][$i] ?? 0x00));
        }

        // SNES table start _09D62E
        $data_start = 0xD62E + count($output_offsets) * 2;
        foreach ($output_offsets as $room_id => $offset) {
            $rom->write(snes_to_pc(0x9D62E) + $room_id * 2, pack('S', $data_start + $offset));
        }
        $rom->write(snes_to_pc(0x9D62E) + count($output_offsets) * 2, pack('C*', ...$output_bytes));

        // Overworld
        $output_offsets = [];
        // empty map ;)
        $output_bytes = [0xFF];
        /** @var Collection<Collection<Vertex>> $enemy_maps */
        $enemy_maps = $enemies->groupBy(fn ($enemy) => $enemy->map);
        $state_pointer_start = 0x9C881;
        $maps_bytes = [0x0000 => $output_bytes];
        foreach ([0 => 0x9C4F0, 1 => 0x9C504, 2 => 0x9C4FA] as $state => $pointers) {
            // Pointer to pointer table
            $offset = count($output_offsets) * 2;
            $rom->write(snes_to_pc($pointers), pack('S', $state_pointer_start + $offset));
            $rom->write(snes_to_pc($pointers + 5), pack('S', $state_pointer_start + $offset + 1));

            for ($i = 0; $i <= 0x81; $i++) {
                if ($state === 0 && $i > 0x3f) {
                    break;
                }
                if (!isset($enemy_maps[$i]) || count($enemy_maps[$i]) === 0) {
                    $output_offsets[] = 0x0000;
                    continue;
                }
                $output_map = [];
                /** @var Vertex $enemy */
                foreach ($enemy_maps[$i] as $enemy) {
                    if (!in_array($state, $enemy->state)) {
                        continue;
                    }
                    $output_map[] = $enemy->position['y'];
                    $output_map[] = $enemy->position['x'];
                    $output_map[] = $enemy->sprite->byte;
                }
                $output_map[] = 0xFF;

                $possible_repeat = array_search($output_map, $maps_bytes);
                if ($possible_repeat !== false) {
                    $output_offsets[] = $possible_repeat;
                    continue;
                }

                $output_offsets[] = count($output_bytes);
                $maps_bytes[count($output_bytes)] = $output_map;
                $output_bytes = array_merge($output_bytes, $output_map);
            }
        }

        // OW sheets PC 0x7A41
        $data_start = $state_pointer_start + count($output_offsets) * 2;
        foreach ($output_offsets as $map => $offset) {
            $rom->write(snes_to_pc($state_pointer_start) + $map * 2, pack('S', $data_start + $offset));
        }
        $rom->write(snes_to_pc($state_pointer_start) + count($output_offsets) * 2, pack('C*', ...$output_bytes));
        if (count($output_bytes) > 0x0B29) {
            throw new Exception("Trying to write too many enemy sprites to OW!");
        }

        // write new sheet sets
        $rom->write(snes_to_pc(0x00DB97), pack('C*', ...Arr::flatten($world->sprite_sheets['sets'])));
        $rom->write(snes_to_pc(0x00FA41), pack('C*', ...Arr::flatten($world->sprite_sheets['overworld'])));
        // special OW 0x02E575 // zora/msp/hobo
    }

    /**
     * write proper entrance and exit data to rom.
     * 
     * @param World $world world to pull config from
     * @param Rom $rom rom to write data to
     */
    private function writeEntrances(World $world, Rom $rom): void
    {
        $exits = $world->getLocationsOfType('exit');
        $exits_outlets_address = snes_to_pc(0x30EB00);
        /** @var Vertex $exit */
        foreach ($exits as $exit) {
            $target = $world->graph->getTargetVertex($exit);
            if ($target->outletid === null) {
                throw new Exception(vsprintf('bad target: `%s` from `%s`', [
                    $target->name,
                    $exit->name,
                ]));
            }
            $rom->write($exits_outlets_address + $exit->roomid, pack('C', $target->outletid));
        }

        $entrances = $world->getLocationsOfType('entrance');
        $entrances_rooms_address = snes_to_pc(0x1BBB73);
        /** @var Vertex $entrance */
        foreach ($entrances as $entrance) {
            $target = $world->graph->getTargetVertex($entrance);
            if (!$target) {
                throw new Exception(vsprintf('Exit/Inlet mismatch: `%s`', [
                    $entrance->name,
                ]));
            }
            $rom->write($entrances_rooms_address + $entrance->entranceid, pack('C', $target->inletid));
        }

        $holes = $world->getLocationsOfType('hole');
        $entrances_holes_address = snes_to_pc(0x1BB84C);
        /** @var Vertex $hole */
        foreach ($holes as $hole) {
            $target = $world->graph->getTargetVertex($hole);
            foreach ($hole->entranceids ?? [] as $entranceid) {
                $rom->write($entrances_holes_address + $entranceid, pack('C', $target->inletid));
            }
        }
    }

    private function writeShops(World $world, Rom $rom): void
    {
        /** @var Collection<Vertex> $shops */
        $shops = $world->getLocationsOfType('shop');

        $shop_data = [];
        $items_data = [];
        $shop_id = 0x00;
        $sram_offset = 0x00;
        foreach ($shops as $shop) {
            if ($shop_id == $shops->count() - 1) {
                $shop_id = 0xFF;
            }

            $inventory = array_filter(
                $world->graph->getTargets($shop),
                fn ($target) => $target->type === 'shopitem' && $target->item !== null
            );
            // @TODO: make this clever and reuse when inv is the exact same. (except take any's)
            $shop_data = array_merge(
                $shop_data,
                [$shop_id],
                array_values(unpack('C*', pack('S', $shop->roomid ?? 0))),
                [
                    $shop->inletid,
                    0x00,
                    ($shop->shopstyle & 0xFC) + count($inventory),
                    $shop->shopkeeper,
                    $sram_offset,
                ]
            );
            $sram_offset += count($inventory);

            if ($sram_offset > 36) {
                throw new \Exception("Exceeded SRAM indexing for shops");
            }

            foreach ($inventory as $slot) {
                $items_data = array_merge(
                    $items_data,
                    [$shop_id],
                    $slot->item->bytes,
                    array_values(unpack('C*', pack('S', $slot->cost ?? 0))),
                    [0, 0xFF], // max?
                    [0x00, 0x00]
                );
            }
            ++$shop_id;
        }
        $rom->write(0x184800, pack('C*', ...$shop_data));

        $items_data = array_merge($items_data, [0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF]);
        $rom->write(0x184900, pack('C*', ...$items_data));
    }
}
