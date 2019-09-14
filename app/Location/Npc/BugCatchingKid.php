<?php

namespace ALttP\Location\Npc;

use ALttP\Item;
use ALttP\Location\Npc;
use ALttP\Rom;

/**
 * Bug-Catching Kid specifically changes the credits when you write an item.
 */
class BugCatchingKid extends Npc
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

        $rom->setCredit('kakariko2', $this->getItemCreditsText());

        return $this;
    }

    private function getItemCreditsText()
    {
        switch (get_class($this->item->getTarget())) {
            case Item\Key::class:
            case Item\BigKey::class:
                return "the key-holding kid";
            case Item\Map::class:
                return "the cartographer kid";
            case Item\Compass::class:
                return "the navigating kid";
            case Item\Egg::class:
                return "the decorating kid";
        }

        switch ($this->item->getTarget()->getRawName()) {
            case 'ProgressiveSword':
            case 'L1Sword':
            case 'L1SwordAndShield':
            case 'L2Sword':
            case 'MasterSword':
            case 'L3Sword':
            case 'L4Sword':
                return "sword-wielding kid";
            case 'ProgressiveShield':
            case 'BlueShield':
            case 'RedShield':
            case 'MirrorShield':
                return "shield-wielding kid";
            case 'FireRod':
                return "fire-starting kid";
            case 'IceRod':
                return "the ice-bending kid";
            case 'Hammer':
                return "hammer-smashing kid";
            case 'Hookshot':
                return "tickle-monster kid";
            case 'Bow':
            case 'BowAndArrows':
            case 'BowAndSilverArrows':
            case 'ProgressiveBow':
                return "arrow-slinging kid";
            case 'Boomerang':
                return "the bat-throwing kid";
            case 'RedBoomerang':
                return "the bat-throwing kid";
            case 'Powder':
                return "the sack-holding kid";
            case 'Bombos':
                return "coin-collecting kid";
            case 'Ether':
                return "coin-collecting kid";
            case 'Quake':
                return "coin-collecting kid";
            case 'Lamp':
                return "light-shining kid";
            case 'Shovel':
                return "archaeologist kid";
            case 'CaneOfSomaria':
                return "the block-making kid";
            case 'CaneOfByrna':
                return "the spark-making kid";
            case 'Cape':
                return "red riding-hood kid";
            case 'MagicMirror':
                return "the narcissistic kid";
            case 'ProgressiveGlove':
            case 'PowerGlove':
            case 'TitansMitt':
                return "body-building kid";
            case 'BookOfMudora':
                return "the scholarly kid";
            case 'Flippers':
                return "the swimming kid";
            case 'MoonPearl':
                return "fortune-telling kid";
            case 'BugCatchingNet':
                return "the bug-catching kid";
            case 'ProgressiveArmor':
            case 'BlueMail':
                return "the protected kid";
            case 'RedMail':
                return "well-protected kid";
            case 'PieceOfHeart':
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "the life-giving kid";
            case 'Bomb':
            case 'ThreeBombs':
            case 'TenBombs':
                return "the bomb-holding kid";
            case 'Mushroom':
                return "the drug-dealing kid";
            case 'Bottle':
                return "the terrarium kid";
            case 'BottleWithRedPotion':
            case 'BottleWithGreenPotion':
            case 'BottleWithBluePotion':
                return "potion-slinging kid";
            case 'BottleWithGoldBee':
            case 'BottleWithBee':
                return "the bug-caught kid";
            case 'BottleWithFairy':
                return "fairy-catching kid";
            case 'Heart':
                return "affection-giving kid";
            case 'Arrow':
            case 'TenArrows':
                return "stick-collecting kid";
            case 'SmallMagic':
                return "magic-slinging kid";
            case 'OneRupee':
            case 'FiveRupees':
                return "poverty-struck kid";
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "the piggy-bank kid";
            case 'OneHundredRupees':
                return "the kind-of-rich kid";
            case 'ThreeHundredRupees':
                return "the really-rich kid";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "the duck-call kid";
            case 'PegasusBoots':
                return "the running-man kid";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "boom-enlarging kid";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "quiver-enlarging kid";
            case 'SilverArrowUpgrade':
                return "arrow-sharpening kid";
            case 'HalfMagic':
            case 'QuarterMagic':
                return "the magic-saving kid";
            case 'Rupoor':
                return "the toll-booth kid";
            case 'RedClock':
                return "the ruby-time kid";
            case 'BlueClock':
                return "the indigo-time kid";
            case 'GreenClock':
                return "the emerald-time kid";
            case 'singleRNG':
            case 'multiRNG':
                return "the something kid";
            case 'Triforce':
                return "the game-winning kid";
            case 'PowerStar':
                return "the starry-eyed kid";
            case 'TriforcePiece':
                return "triforce-holding kid";
            case 'Nothing':
            default:
                return "nothing-having kid";
        }
    }
}
