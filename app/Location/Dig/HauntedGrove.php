<?php

namespace ALttP\Location\Dig;

use ALttP\Item;
use ALttP\Location\Dig;
use ALttP\Rom;

/**
 * Haunted Grove specifically changes the credits when you write an item.
 */
class HauntedGrove extends Dig
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

        $rom->setCredit('grove', $this->getItemCreditsText());

        return $this;
    }

    private function getItemCreditsText()
    {
        switch (get_class($this->item->getTarget())) {
            case Item\Key::class:
            case Item\BigKey::class:
                return "key boy picks locks again";
            case Item\Map::class:
                return "map boy navigates again";
            case Item\Compass::class:
                return "compass boy finds boss again";
            case Item\Egg::class:
                return "egg boy paints again";
        }

        switch ($this->item->getTarget()->getRawName()) {
            case 'ProgressiveSword':
            case 'L1Sword':
            case 'L1SwordAndShield':
            case 'L2Sword':
            case 'MasterSword':
            case 'L3Sword':
            case 'L4Sword':
                return "sword boy fights again";
            case 'ProgressiveShield':
            case 'BlueShield':
            case 'RedShield':
            case 'MirrorShield':
                return "shield boy defends again";
            case 'FireRod':
                return "firestarter boy burns again";
            case 'IceRod':
                return "ice-cube boy freezes again";
            case 'Hammer':
                return "stop, hammer time";
            case 'Hookshot':
                return "beam boy tickles again";
            case 'Bow':
            case 'BowAndArrows':
            case 'BowAndSilverArrows':
            case 'ProgressiveBow':
                return "archer boy shoots again";
            case 'Boomerang':
                return "throwing boy plays fetch again";
            case 'RedBoomerang':
                return "magical boy plays fetch again";
            case 'Powder':
                return "magic boy plays marbles again";
            case 'Bombos':
                return "medallion boy melts room again";
            case 'Ether':
                return "medallion boy sees floor again";
            case 'Quake':
                return "medallion boy shakes dirt again";
            case 'Lamp':
                return "illuminated boy can see again";
            case 'Shovel':
                return "shovel boy digs again";
            case 'CaneOfSomaria':
                return "cane boy makes blocks again";
            case 'CaneOfByrna':
                return "cane boy encircles again";
            case 'Cape':
                return "dapper boy hides again";
            case 'MagicMirror':
                return "narcissistic boy is happy again";
            case 'ProgressiveGlove':
            case 'PowerGlove':
                return "body-building boy lifts again";
            case 'TitansMitt':
                return "body-building boy has gold again";
            case 'BookOfMudora':
                return "book-worm boy can read again";
            case 'Flippers':
                return "swimming boy swims again";
            case 'MoonPearl':
                return "moon boy plays ball again";
            case 'BugCatchingNet':
                return "wrong boy catches bees again";
            case 'BlueMail':
                return "tailor boy banana hatted again";
            case 'RedMail':
                return "tailor boy fears nothing again";
            case 'PieceOfHeart':
                return "life boy feels some love again";
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "life boy feels love again";
            case 'Bomb':
                return "'splosion boy explodes again";
            case 'ThreeBombs':
                return "'splosion boy explodes again";
            case 'TenBombs':
                return "'splosion boy explodes again";
            case 'Mushroom':
                return "shroom boy sells drugs again";
            case 'Bottle':
                return "bottle boy has terrarium again";
            case 'BottleWithRedPotion':
                return "bottle boy has red goo again";
            case 'BottleWithGreenPotion':
                return "bottle boy has green goo again";
            case 'BottleWithBluePotion':
                return "bottle boy has blue goo again";
            case 'BottleWithGoldBee':
                return "bottle boy has beetor again";
            case 'BottleWithBee':
                return "bottle boy has mad bee again";
            case 'BottleWithFairy':
                return "bottle boy has friend again";
            case 'Heart':
                return "loving boy has affection again";
            case 'Arrow':
                return "archer boy sews again";
            case 'TenArrows':
                return "archer boy sews again";
            case 'SmallMagic':
                return "magic boy summons again";
            case 'OneRupee':
            case 'FiveRupees':
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "destitute boy has lunch again";
            case 'OneHundredRupees':
                return "affluent boy goes drinking again";
            case 'ThreeHundredRupees':
                return "fat-cat boy is rich again";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "ocarina boy plays again";
            case 'PegasusBoots':
                return "gotta-go-fast boy runs again";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "upgrade boy explodes more again";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "upgrade boy sews more again";
            case 'SilverArrowUpgrade':
                return "archer boy shines again";
            case 'HalfMagic':
            case 'QuarterMagic':
                return "magic boy saves magic again";
            case 'Rupoor':
                return "affluent boy steals rupees";
            case 'RedClock':
                return "moment boy travels time again";
            case 'BlueClock':
                return "moment boy time travels again";
            case 'GreenClock':
                return "moment boy adjusts time again";
            case 'ProgressiveArmor':
                return "tailor boy has threads again";
            case 'singleRNG':
            case 'multiRNG':
                return "unknown boy somethings again";
            case 'Triforce':
                return "greedy boy wins game again";
            case 'PowerStar':
                return "mario powers up again";
            case 'TriforcePiece':
                return "wise boy has triangle again";
            case 'Nothing':
            default:
                return "empty boy does nothing again";
        }
    }
}
