<?php

namespace ALttP\Location\Npc;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Uncle Location
 */
class Uncle extends Location
{
    /**
     * Sets the item for this location. We need to check mode to determine fills/assit.
     *
     * @param \ALttP\Rom  $rom  ROM to write to
     * @param \ALttP\Item $item item to write
     *
     * @return \ALttP\Location
     */
    public function writeItem(Rom $rom, Item $item = null)
    {
        parent::writeItem($rom, $item);
        $item = $this->getItem();

        $world = $this->region->getWorld();

        if ($world->config('mode.state') == 'standard') {
            if ($item instanceof Item\Bow) {
                $rom->setEscapeFills(0b00000001);
                $rom->setUncleSpawnRefills(0, 0, 70);
                $rom->setZeldaSpawnRefills(0, 0, 10);
                $rom->setMantleSpawnRefills(0, 0, 10);
            } elseif ($item == Item::get('TenBombs', $world)) {
                $rom->setEscapeFills(0b00000010);
                $rom->setUncleSpawnRefills(0, 50, 0);
                $rom->setZeldaSpawnRefills(0, 3, 0);
                $rom->setMantleSpawnRefills(0, 3, 0);
            } elseif (
                $item == Item::get('FireRod', $world)
                || $item == Item::get('CaneOfSomaria', $world)
                || $item == Item::get('CaneOfByrna', $world)
            ) {
                $rom->setEscapeFills(0b00000100);
                $rom->setUncleSpawnRefills(0x80, 0, 0);
                $rom->setZeldaSpawnRefills(0x20, 0, 0);
                $rom->setMantleSpawnRefills(0x20, 0, 0);
            } else {
                $rom->setEscapeFills(0b00000000);
                $rom->setUncleSpawnRefills(0, 0, 0);
                $rom->setZeldaSpawnRefills(0, 0, 0);
                $rom->setMantleSpawnRefills(0, 0, 0);
            }

            if ($world->config('rom.HardMode') == -1) {
                if ($item instanceof Item\Bow) {
                    $rom->setEscapeAssist(0b00000001);
                } elseif ($item == Item::get('TenBombs', $world)) {
                    $rom->setEscapeAssist(0b00000010);
                } elseif (
                    $item == Item::get('FireRod', $world)
                    || $item == Item::get('CaneOfSomaria', $world)
                    || $item == Item::get('CaneOfByrna', $world)
                ) {
                    $rom->setEscapeAssist(0b00000100);
                } else {
                    $rom->setEscapeAssist(0b00000000);
                }
            } else {
                $rom->setEscapeAssist(0b00000000);
            }
        } else {
            $rom->setEscapeFills(0b00000000);
            $rom->setUncleSpawnRefills(0, 0, 0);
            $rom->setZeldaSpawnRefills(0, 0, 0);
            $rom->setMantleSpawnRefills(0, 0, 0);
            $rom->setEscapeAssist(0b00000000);
        }

        $rom->setCredit('house', $this->getItemCreditsText());

        return $this;
    }

    private function getItemCreditsText()
    {
        switch (get_class($this->item->getTarget())) {
            case Item\Key::class:
            case Item\BigKey::class:
                return "your uncle picks locks";
            case Item\Map::class:
                return "your uncle finds treasure";
            case Item\Compass::class:
                return "your uncle navigates";
            case Item\Egg::class:
                return "your uncle likes coloring";
        }

        switch ($this->item->getTarget()->getRawName()) {
            case 'L1Sword':
            case 'L1SwordAndShield':
            case 'L2Sword':
            case 'MasterSword':
            case 'L3Sword':
            case 'L4Sword':
            case 'ProgressiveSword':
                return "your uncle recovers";
            case 'BlueShield':
            case 'RedShield':
            case 'MirrorShield':
            case 'ProgressiveShield':
                return "your uncle protects";
            case 'FireRod':
                return "your uncle starts fires";
            case 'IceRod':
                return "your uncle is cold as ice";
            case 'Hammer':
                return "stop...   hammer time";
            case 'Hookshot':
                return "your uncle is BOING";
            case 'Bow':
            case 'BowAndArrows':
            case 'BowAndSilverArrows':
            case 'ProgressiveBow':
                return "your uncle, robin hood";
            case 'Boomerang':
            case 'RedBoomerang':
                return "your uncle is stunning";
            case 'Powder':
                return "your uncle and his sack";
            case 'Bombos':
            case 'Ether':
            case 'Quake':
                return "your uncle collects coins";
            case 'Lamp':
                return "your uncle has night vision";
            case 'Shovel':
                return "your uncle digs it";
            case 'CaneOfSomaria':
                return "your uncle makes blocks";
            case 'CaneOfByrna':
                return "your uncle sparks";
            case 'Cape':
                return "your uncle can hide";
            case 'MagicMirror':
                return "your uncle is vain";
            case 'PowerGlove':
            case 'TitansMitt':
            case 'ProgressiveGlove':
                return "your uncle goes back to the gym";
            case 'BookOfMudora':
                return "your uncle can read";
            case 'Flippers':
                return "your uncle swims";
            case 'MoonPearl':
                return "your uncle shoots marbles";
            case 'BugCatchingNet':
                return "your uncle catches bees";
            case 'BlueMail':
            case 'RedMail':
            case 'ProgressiveArmor':
                return "your uncle tailors";
            case 'PieceOfHeart':
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "your uncle is healthy";
            case 'Bomb':
            case 'ThreeBombs':
            case 'TenBombs':
                return "your uncle believes";
            case 'Mushroom':
                return "your uncle deals drugs";
            case 'Bottle':
                return "your uncle likes turtles";
            case 'BottleWithRedPotion':
            case 'BottleWithGreenPotion':
            case 'BottleWithBluePotion':
                return "your uncle helps out";
            case 'BottleWithGoldBee':
                return "your uncle has beetor";
            case 'BottleWithBee':
                return "your uncle likes arthropods";
            case 'BottleWithFairy':
                return "your uncle has a friend";
            case 'Heart':
                return "your uncle is creepy";
            case 'Arrow':
                return "your uncle believes in you";
            case 'TenArrows':
                return "your uncle sews";
            case 'SmallMagic':
                return "your uncle is magic";
            case 'OneRupee':
            case 'FiveRupees':
                return "your uncle is cheap";
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "your uncle likes cash";
            case 'OneHundredRupees':
            case 'ThreeHundredRupees':
                return "your uncle is rich";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "your uncle trains ducks";
            case 'PegasusBoots':
                return "your uncle goes fast";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "your uncle has the bomb bag";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "your uncle has the quiver";
            case 'SilverArrowUpgrade':
                return "your uncle shaves";
            case 'HalfMagic':
            case 'QuarterMagic':
                return "your uncle is magical";
            case 'Rupoor':
                return "your uncle collects";
            case 'RedClock':
            case 'BlueClock':
            case 'GreenClock':
                return "your uncle keeps time";
            case 'singleRNG':
            case 'multiRNG':
                return "your uncle recovers";
            case 'Triforce':
                return "your uncle wins the game";
            case 'PowerStar':
            case 'TriforcePiece':
                return "your uncle is important";
            case 'Nothing':
            default:
                return "your uncle does nothing";
        }
    }
}
