<?php

namespace ALttP\Location\Drop;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Ether Tablet Location
 */
class Ether extends Location
{
    /**
     * Write item to ROM.
     *
     * @param \ALttP\Rom  $rom  ROM to write to
     * @param \ALttP\Item $item item to write
     *
     * @return \ALttP\Location
     */
    public function writeItem(Rom $rom, Item $item = null)
    {
        parent::writeItem($rom, $item);

        $rom->setText('tablet_ether_book', $this->getItemText());

        return $this;
    }

    private function getItemText()
    {
        $item = ($this->region->getWorld()->config('rom.genericKeys', false) && $this->item instanceof Item\Key)
            ? Item::get('KeyGK', $this->region->getWorld())
            : $this->item;

        switch ($item->getTarget()->getRawName()) {
            case 'BigKeyA2':
                return "The Big Key\nto Ganon's Tower";
            case 'BigKeyD7':
                return "The Big Key\nto Turtle Rock";
            case 'BigKeyD4':
                return "The Big Key\nto Thieves' Town";
            case 'BigKeyP3':
                return "The Big Key\nto The Tower\nof Hera";
            case 'BigKeyD5':
                return "The Big Key\nto Ice Palace";
            case 'BigKeyD3':
                return "The Big Key\nto Skull Woods";
            case 'BigKeyD6':
                return "The Big Key\nto Misery Mire";
            case 'BigKeyD1':
                return "The Big Key\nto Dark Palace";
            case 'BigKeyD2':
                return "The Big Key\nto Swamp Palace";
            case 'BigKeyA1':
                return "The Big Key\nto Agahnim's Tower";
            case 'BigKeyP2':
                return "The Big Key\nto Desert Palace";
            case 'BigKeyP1':
                return "The Big Key\nto Eastern Palace";
            case 'BigKeyH1':
            case 'BigKeyH2':
                return "The Big Key\nof Hyrule Castle";
            case 'KeyA2':
                return "A small key\nto Ganon's Tower";
            case 'KeyD7':
                return "A small key\nto Turtle Rock";
            case 'KeyD4':
                return "A small key\nto Thieves' Town";
            case 'KeyP3':
                return "A small key\nto The Tower\nof Hera";
            case 'KeyD5':
                return "A small key\nto Ice Palace";
            case 'KeyD3':
                return "A small key\nto Skull Woods";
            case 'KeyD6':
                return "A small key\nto Misery Mire";
            case 'KeyD1':
                return "A small key\nto Dark Palace";
            case 'KeyD2':
                return "A small key\nto Swamp Palace";
            case 'KeyA1':
                return "A small key\nto Agahnim's Tower";
            case 'KeyP2':
                return "A small key\nto Desert Palace";
            case 'KeyP1':
                return "A small key\nto Eastern Palace";
            case 'KeyH1':
            case 'KeyH2':
                return "A small key\nto Hyrule Castle";
        }

        switch (get_class($item->getTarget())) {
            case Item\Key::class:
                return "A small key\nto the Kingdom";
            case Item\BigKey::class:
                return "A big key\nto the Kingdom";
            case Item\Map::class:
                return "You can now\nfind your way\nhome!";
            case Item\Compass::class:
                return "Now you know\nwhere the boss\nhides!";
            case Item\Egg::class:
                return "Egg-cited\nfor this";
        }

        switch ($item->getTarget()->getRawName()) {
            case 'L1Sword':
            case 'L1SwordAndShield':
                return "The Fighter Sword!";
            case 'L2Sword':
            case 'MasterSword':
                return "The Master Sword!";
            case 'L3Sword':
                return "The Tempered Sword!";
            case 'L4Sword':
                return "The Golden Sword!";
            case 'BlueShield':
                return "The Fighter Shield!";
            case 'RedShield':
                return "The Fire Shield!";
            case 'MirrorShield':
                return "The Mirror Shield!";
            case 'FireRod':
                return "The Fire Rod!";
            case 'IceRod':
                return "The Ice Rod!";
            case 'Hammer':
                return "The Magic Hammer!";
            case 'Hookshot':
                return "The Hookshot!";
            case 'Bow':
            case 'ProgressiveBow':
                return "The Bow!";
            case 'BowAndArrows':
                return "The Bow!";
            case 'BowAndSilverArrows':
                return "The Silver Arrows!";
            case 'Boomerang':
                return "The Boomerang!";
            case 'RedBoomerang':
                return "The Magic Boomerang!";
            case 'Powder':
                return "The Magic Powder!";
            case 'Bombos':
                return "The Bombos Medallion!";
            case 'Ether':
                return "The Ether Medallion!";
            case 'Quake':
                return "The Quake Medallion!";
            case 'Lamp':
                return "The Magic Lamp!";
            case 'Shovel':
                return "The Shovel!";
            case 'CaneOfSomaria':
                return "The Cane of Somaria!";
            case 'CaneOfByrna':
                return "The Cane of Byrna!";
            case 'Cape':
                return "The Magic Cape!";
            case 'MagicMirror':
                return "The Magic Mirror!";
            case 'PowerGlove':
                return "The Power Glove!";
            case 'TitansMitt':
                return "The Titan's Mitt!";
            case 'BookOfMudora':
                return "The Book of Mudora!";
            case 'Flippers':
                return "The Flippers!";
            case 'MoonPearl':
                return "The Moon Pearl!";
            case 'BugCatchingNet':
                return "The Bug-Catching Net!";
            case 'BlueMail':
                return "The Blue Mail!";
            case 'RedMail':
                return "The Red Mail!";
            case 'PieceOfHeart':
                return "A Piece of Heart!";
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "A Heart Container!";
            case 'Bomb':
                return "A Single Bomb!";
            case 'ThreeBombs':
                return "Three Bombs!";
            case 'TenBombs':
                return "Ten Bombs!";
            case 'Mushroom':
                return "The Mushroom!";
            case 'Bottle':
                return "A Bottle!";
            case 'BottleWithRedPotion':
                return "A Bottle of\nRed Potion!";
            case 'BottleWithGreenPotion':
                return "A Bottle of\nGreen Potion!";
            case 'BottleWithBluePotion':
                return "A Bottle of\nBlue Potion!";
            case 'BottleWithGoldBee':
            case 'BottleWithBee':
                return "A Bottle with\na Bee Inside!";
            case 'BottleWithFairy':
                return "A Bottle with\na Fairy Inside!";
            case 'Heart':
                return "A single heart!";
            case 'Arrow':
                return "A single arrow!";
            case 'TenArrows':
                return "Ten arrows!";
            case 'SmallMagic':
                return "A small magic\ndecanter!";
            case 'OneRupee':
            case 'FiveRupees':
                return "Some Rupees!";
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "Some Rupees!";
            case 'OneHundredRupees':
                return "A lot of Rupees!";
            case 'ThreeHundredRupees':
                return "A ton of Rupees!";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "The Flute!";
            case 'PegasusBoots':
                return "The Pegasus Boots!";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "A Bomb Capacity\nUpgrade!";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "An Arrow Capacity\nUpgrade!";
            case 'SilverArrowUpgrade':
                return "The Silver Arrows!";
            case 'HalfMagic':
                return "Half Magic!";
            case 'QuarterMagic':
                return "Quarter Magic!";
            case 'PendantOfCourage':
                return "The Pendant of\nCourage!";
            case 'PendantOfWisdom':
                return "The Pendant of\nWisdom!";
            case 'PendantOfPower':
                return "The Pendant of\nPower!";
            case 'Rupoor':
                return "A waste of time!";
            case 'RedClock':
                return "A Clock!";
            case 'BlueClock':
                return "A Clock!";
            case 'GreenClock':
                return "A Clock!";
            case 'ProgressiveSword':
                return "A Sword Upgrade!";
            case 'ProgressiveShield':
                return "A Shield Upgrade!";
            case 'ProgressiveArmor':
                return "An Armor Upgrade!";
            case 'ProgressiveGlove':
                return "A Glove Upgrade!";
            case 'singleRNG':
            case 'multiRNG':
                return "A Random Thing!";
            case 'Triforce':
                return "The Triforce!";
            case 'PowerStar':
                return "A Power Star!";
            case 'TriforcePiece':
                return "A Triforce Piece!";
            case 'Nothing':
            default:
                return "A waste of time!";
        }
    }
}
