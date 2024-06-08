<?php

namespace ALttP\Location;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Master Sword Pedestal Location
 */
class Pedestal extends Location
{
    /**
     * Sets the item for this location. The L2Sword normally sits here, so if we get MasterSword as our Item we need to
     * change it to the L2Sword, it will make the pulling of the sword look better.
     *
     * @param Item|null $item Item to be placed at this Location
     *
     * @return $this
     */
    public function setItem(Item $item = null)
    {
        if ($item == Item::get('MasterSword', $this->region->getWorld())) {
            $item = Item::get('L2Sword', $this->region->getWorld());
        }

        return parent::setItem($item);
    }

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

        $rom->setCredit('pedestal', $this->getItemCreditsText());
        $rom->setText('mastersword_pedestal_translated', $this->getItemPedestalText());

        return $this;
    }


    private function getItemCreditsText()
    {
        switch ($this->item->getTarget()->getRawName()) {
            case 'BigKeyA2':
                return "la key of evils bane";
        }

        switch (get_class($this->item->getTarget())) {
            case Item\Key::class:
            case Item\BigKey::class:
                return "and the key";
            case Item\Map::class:
                return "and the map";
            case Item\Compass::class:
                return "and the compass";
            case Item\Egg::class:
                return "and the egg";
        }

        switch ($this->item->getTarget()->getRawName()) {
            case 'L1Sword':
            case 'L1SwordAndShield':
                return "the plastic sword";
            case 'L2Sword':
            case 'MasterSword':
                return "and the master sword";
            case 'L3Sword':
                return "the tempered sword";
            case 'L4Sword':
                return "and the butter sword";
            case 'BlueShield':
                return "the useless shield";
            case 'RedShield':
                return "near useless shield";
            case 'MirrorShield':
                return "and the ditto shield";
            case 'FireRod':
                return "and the rage rod";
            case 'IceRod':
                return "and the freeze ray";
            case 'Hammer':
                return "and m c hammer";
            case 'Hookshot':
                return "and the tickle beam";
            case 'Bow':
            case 'BowAndArrows':
            case 'ProgressiveBow':
                return "the stick and twine";
            case 'BowAndSilverArrows':
                return "the stick and shine";
            case 'Boomerang':
                return "the backlash stick";
            case 'RedBoomerang':
                return "and the rebound rod";
            case 'Powder':
                return "and the magic sack";
            case 'Bombos':
                return "and the swirly coin";
            case 'Ether':
                return "and the bolt coin";
            case 'Quake':
                return "and the wavy coin";
            case 'Lamp':
                return "and the flashlight";
            case 'Shovel':
                return "and the flute scoop";
            case 'CaneOfSomaria':
                return "the walking stick";
            case 'CaneOfByrna':
                return "and the blue bat";
            case 'Cape':
                return "the camouflage cape";
            case 'MagicMirror':
                return "the face reflector";
            case 'PowerGlove':
                return "and the grey mittens";
            case 'TitansMitt':
                return "and the golden glove";
            case 'BookOfMudora':
                return "and the story book";
            case 'Flippers':
                return "the water airfoil";
            case 'MoonPearl':
                return "and the jaw breaker";
            case 'BugCatchingNet':
                return "and the surprise net";
            case 'BlueMail':
                return "and the banana hat";
            case 'RedMail':
                return "and the eggplant hat";
            case 'PieceOfHeart':
                return "and the broken heart";
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "and the full heart";
            case 'Bomb':
                return "and the explosion";
            case 'ThreeBombs':
                return "the explosions";
            case 'TenBombs':
                return "the many explosions";
            case 'Mushroom':
                return "and the legal drugs";
            case 'Bottle':
                return "and the terrarium";
            case 'BottleWithRedPotion':
                return "and the red goo";
            case 'BottleWithGreenPotion':
                return "and the green goo";
            case 'BottleWithBluePotion':
                return "and the blue goo";
            case 'BottleWithGoldBee':
                return "and the beetor";
            case 'BottleWithBee':
                return "and the mad friend";
            case 'BottleWithFairy':
                return "and the fairy friend";
            case 'Heart':
                return "and the tiny heart";
            case 'Arrow':
                return "the vampire skewer";
            case 'TenArrows':
                return "the vampire skewers";
            case 'SmallMagic':
                return "and the tiny pouch";
            case 'OneRupee':
            case 'FiveRupees':
                return "the pocket change";
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "and the couch cash";
            case 'OneHundredRupees':
                return "and the rupee stash";
            case 'ThreeHundredRupees':
                return "and the rupee hoard";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "and the duck call";
            case 'PegasusBoots':
                return "and the sprint shoes";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "and the bomb booster";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "and the arrow boost";
            case 'SilverArrowUpgrade':
                return "and the razer blade";
            case 'HalfMagic':
            case 'QuarterMagic':
                return "and the magic saver";
            case 'Rupoor':
                return "and the toll-booth";
            case 'RedClock':
                return "and the ruby clock";
            case 'BlueClock':
                return "the sapphire clock";
            case 'GreenClock':
                return "the emerald clock";
            case 'ProgressiveSword':
                return "the unknown sword";
            case 'ProgressiveShield':
                return "the unknown shield";
            case 'ProgressiveArmor':
                return "the unknown hat";
            case 'ProgressiveGlove':
                return "the magic hand cover";
            case 'singleRNG':
            case 'multiRNG':
                return "the whatever";
            case 'Triforce':
                return "and the triforce";
            case 'PowerStar':
                return "and the power star";
            case 'TriforcePiece':
                return "the triforce piece";
            case 'Nothing':
            default:
                return "and nothing";
        }
    }

    private function getItemPedestalText()
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
