<?php

namespace ALttP\Location\Npc;

use ALttP\Item;
use ALttP\Location\Npc;
use ALttP\Rom;

/**
 * Zora specifically changes the credits when you write an item.
 */
class Zora extends Npc
{
    /**
     * Write item to rom.
     *
     * @param \ALttP\Rom  $rom  rom to write to
     * @param \ALttP\Item $item item to write
     *
     * @return \ALttP\Location
     */
    public function writeItem(Rom $rom, Item $item = null)
    {
        parent::writeItem($rom, $item);

        $rom->setCredit('zora', $this->getItemCreditsText());

        return $this;
    }

    private function getItemCreditsText()
    {
        switch (get_class($this->item->getTarget())) {
            case Item\Key::class:
            case Item\BigKey::class:
                return "advancement for sale";
            case Item\Map::class:
                return "the world for sale";
            case Item\Compass::class:
                return "bearings for sale";
            case Item\Egg::class:
                return "Eggs for sale";
        }

        switch ($this->item->getTarget()->getRawName()) {
            case 'L1Sword':
            case 'L1SwordAndShield':
                return "sword for sale";
            case 'L2Sword':
            case 'MasterSword':
                return "glow sword for sale";
            case 'L3Sword':
                return "flame sword for sale";
            case 'L4Sword':
                return "butter for sale";
            case 'BlueShield':
                return "bad defense for sale";
            case 'RedShield':
                return "red shield for sale";
            case 'MirrorShield':
                return "face shield for sale";
            case 'FireRod':
                return "rage rod for sale";
            case 'IceRod':
                return "ice cream for sale";
            case 'Hammer':
                return "m c hammer for sale";
            case 'Hookshot':
                return "tickle beam for sale";
            case 'Bow':
            case 'ProgressiveBow':
                return "arrow sling for sale";
            case 'BowAndArrows':
                return "point stick for sale";
            case 'BowAndSilverArrows':
                return "you got lucky";
            case 'Boomerang':
                return "bent stick for sale";
            case 'RedBoomerang':
                return "air foil for sale";
            case 'Powder':
                return "sack for sale";
            case 'Bombos':
                return "swirly coin for sale";
            case 'Ether':
                return "bolt coin for sale";
            case 'Quake':
                return "wavy coin for sale";
            case 'Lamp':
                return "candle for sale";
            case 'Shovel':
                return "dirt spade for sale";
            case 'CaneOfSomaria':
                return "block stick for sale";
            case 'CaneOfByrna':
                return "shiny stick for sale";
            case 'Cape':
                return "red hood for sale";
            case 'MagicMirror':
                return "your face for sale";
            case 'PowerGlove':
                return "lift glove for sale";
            case 'TitansMitt':
                return "carry glove for sale";
            case 'BookOfMudora':
                return "moon runes for sale";
            case 'Flippers':
                return "finger webs for sale";
            case 'MoonPearl':
                return "lunar orb for sale";
            case 'BugCatchingNet':
                return "stick web for sale";
            case 'BlueMail':
                return "banana hat for sale";
            case 'RedMail':
                return "purple hat for sale";
            case 'PieceOfHeart':
                return "little love for sale";
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "love for sale";
            case 'Bomb':
                return "firecracker for sale";
            case 'ThreeBombs':
                return "fireworks for sale";
            case 'TenBombs':
                return "boom boom for sale";
            case 'Mushroom':
                return "legal drugs for sale";
            case 'Bottle':
                return "terrarium for sale";
            case 'BottleWithRedPotion':
                return "red goo for sale";
            case 'BottleWithGreenPotion':
                return "green goo for sale";
            case 'BottleWithBluePotion':
                return "blue goo for sale";
            case 'BottleWithGoldBee':
                return "beetor for sale";
            case 'BottleWithBee':
                return "mad friend for sale";
            case 'BottleWithFairy':
                return "friend for sale";
            case 'Heart':
                return "affection for sale";
            case 'Arrow':
                return "sewing needle for sale";
            case 'TenArrows':
                return "sewing kit for sale";
            case 'SmallMagic':
                return "alchemy for sale";
            case 'OneRupee':
            case 'FiveRupees':
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "life lesson for sale";
            case 'OneHundredRupees':
                return "fair trade for sale";
            case 'ThreeHundredRupees':
                return "good return for sale";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "duck call for sale";
            case 'PegasusBoots':
                return "sprint shoe for sale";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "bomb boost for sale";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "arrow boost for sale";
            case 'SilverArrowUpgrade':
                return "sharp arrow for sale";
            case 'HalfMagic':
            case 'QuarterMagic':
                return "wizardry for sale";
            case 'Rupoor':
                return "double loss for sale";
            case 'RedClock':
                return "ruby clock for sale";
            case 'BlueClock':
                return "blue clock for sale";
            case 'GreenClock':
                return "green clock for sale";
            case 'ProgressiveSword':
                return "some sword for sale";
            case 'ProgressiveShield':
                return "some shield for sale";
            case 'ProgressiveArmor':
                return "unknown hat for sale";
            case 'ProgressiveGlove':
                return "some glove for sale";
            case 'singleRNG':
            case 'multiRNG':
                return "some item for sale";
            case 'Triforce':
                return "game win for sale";
            case 'PowerStar':
                return "power star for sale";
            case 'TriforcePiece':
                return "triangle for sale";
            case 'Nothing':
            default:
                return "Nothing, so stupid";
        }
    }
}
