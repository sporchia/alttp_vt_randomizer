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
                return "The Big Key\nof evil's bane";
            case 'BigKeyD7':
                return "The big key\nof terrapins";
            case 'BigKeyD4':
                return "The Big Key\nof rogues";
            case 'BigKeyP3':
                return "The big key\nto moldorm's\nheart";
            case 'BigKeyD5':
                return "A frozen\nbig key\nrests here";
            case 'BigKeyD3':
                return "The big key\nof the dark\nforest";
            case 'BigKeyD6':
                return "The big key\nto Vitreous";
            case 'BigKeyD1':
                return "Hammeryump\nwith this\nbig key";
            case 'BigKeyD2':
                return "The Big key\nto the swamp";
            case 'BigKeyA1':
                return "Okay, this big\nkey doesn't\nreally exist";
            case 'BigKeyP2':
                return "Sand spills\nout of this\nbig key";
            case 'BigKeyP1':
                return "The big key\nof the east";
            case 'BigKeyH1':
            case 'BigKeyH2':
                return "You should\nhave got this\nfrom a guard";
            case 'KeyA2':
                return "The small key\nof evil's bane";
            case 'KeyD7':
                return "The small key\nof terrapins";
            case 'KeyD4':
                return "The small key\nof rogues";
            case 'KeyP3':
                return "The key\nto moldorm's\nbasement";
            case 'KeyD5':
                return "A frozen\nsmall key\nrests here";
            case 'KeyD3':
                return "The small key\nof the dark\nforest";
            case 'KeyD6':
                return "The small key\nto Vitreous";
            case 'KeyD1':
                return "A small key\nthat steals\nlight";
            case 'KeyD2':
                return "Access to\nthe swamp\nis granted";
            case 'KeyA1':
                return "Agahnim\nhalfway\nunlocked";
            case 'KeyP2':
                return "Sand spills\nout of this\nsmall key";
            case 'KeyP1':
                return "Okay, this\nkey doesn't\nreally exist";
            case 'KeyH1':
            case 'KeyH2':
                return "The key to\nthe castle";
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
                return "A pathetic\nsword rests\nhere!";
            case 'L2Sword':
            case 'MasterSword':
                return "I thought this\nwas meant to\nbe randomized?";
            case 'L3Sword':
                return "I stole the\nblacksmith's\njob!";
            case 'L4Sword':
                return "The butter\nsword rests\nhere!";
            case 'BlueShield':
                return "Now you can\ndefend against\npebbles!";
            case 'RedShield':
                return "Now you can\ndefend against\nfireballs!";
            case 'MirrorShield':
                return "Now you can\ndefend against\nlasers!";
            case 'FireRod':
                return "I'm the hot\nrod. I make\nthings burn!";
            case 'IceRod':
                return "I'm the cold\nrod. I make\nthings freeze!";
            case 'Hammer':
                return "stop\nhammer time!";
            case 'Hookshot':
                return "BOING!!!\nBOING!!!\nBOING!!!";
            case 'Bow':
            case 'ProgressiveBow':
                return "You have\nchosen the\narcher class.";
            case 'BowAndArrows':
                return "You are now an\naverage archer";
            case 'BowAndSilverArrows':
                return "You are now a\nmaster archer!";
            case 'Boomerang':
                return "No matter what\nyou do, blue\nreturns to you";
            case 'RedBoomerang':
                return "No matter what\nyou do, red\nreturns to you";
            case 'Powder':
                return "you can turn\nanti-faeries\ninto faeries";
            case 'Bombos':
                return "Burn, baby,\nburn! Fear my\nring of fire!";
            case 'Ether':
                return "This magic\ncoin freezes\neverything!";
            case 'Quake':
                return "Maxing out the\nRichter scale\nis what I do!";
            case 'Lamp':
                return "Baby, baby,\nbaby.\nLight my way!";
            case 'Shovel':
                return "Can\n   You\n      Dig it?";
            case 'CaneOfSomaria':
                return "I make blocks\nto hold down\nswitches!";
            case 'CaneOfByrna':
                return "Use this to\nbecome\ninvincible!";
            case 'Cape':
                return "Wear this to\nbecome\ninvisible!";
            case 'MagicMirror':
                return "Isn't your\nreflection so\npretty?";
            case 'PowerGlove':
                return "Now you can\nlift weak\nstuff!";
            case 'TitansMitt':
                return "Now you can\nlift heavy\nstuff!";
            case 'BookOfMudora':
                return "This is a\nparadox?!";
            case 'Flippers':
                return "fancy a swim?";
            case 'MoonPearl':
                return "  Bunny Link\n      be\n     gone!";
            case 'BugCatchingNet':
                return "Let's catch\nsome bees and\nfaeries!";
            case 'BlueMail':
                return "Now you're a\nblue elf!";
            case 'RedMail':
                return "Now you're a\nred elf!";
            case 'PieceOfHeart':
                return "Just a little\npiece of love!";
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "Maximum health\nincreased!\nYeah!";
            case 'Bomb':
                return "I make things\ngo BOOM! But\njust once.";
            case 'ThreeBombs':
                return "I make things\ngo triple\nBOOM!!!";
            case 'TenBombs':
                return "I make things\ngo BOOM!\nso many times!";
            case 'Mushroom':
                return "I'm a fun guy!\n\nI'm a funghi!";
            case 'Bottle':
                return "Now you can\nstore potions\nand stuff!";
            case 'BottleWithRedPotion':
                return "You see red\ngoo in a\nbottle?";
            case 'BottleWithGreenPotion':
                return "You see green\ngoo in a\nbottle?";
            case 'BottleWithBluePotion':
                return "You see blue\ngoo in a\nbottle?";
            case 'BottleWithGoldBee':
            case 'BottleWithBee':
                return "Release me\nso I can go\nbzzzzz!";
            case 'BottleWithFairy':
                return "If you die\nI will revive\nyou!";
            case 'Heart':
                return "I'm a lonely\nheart.";
            case 'Arrow':
                return "a lonely arrow\nsits here.";
            case 'TenArrows':
                return "This will give\nyou ten shots\nwith your bow!";
            case 'SmallMagic':
                return "A tiny magic\nrefill rests\nhere";
            case 'OneRupee':
            case 'FiveRupees':
                return "Just pocket\nchange. Move\nright along.";
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "Just couch\ncash. Move\nright along.";
            case 'OneHundredRupees':
                return "A rupee stash!\nHell yeah!";
            case 'ThreeHundredRupees':
                return "A rupee hoard!\nHell yeah!";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "Save the duck\nand fly to\nfreedom!";
            case 'PegasusBoots':
                return "Gotta go fast!";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "increase bomb\nstorage, low\nlow price";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "increase arrow\nstorage, low\nlow price";
            case 'SilverArrowUpgrade':
                return "Do you fancy\nsilver tipped\narrows?";
            case 'HalfMagic':
                return "Your magic\npower has been\ndoubled!";
            case 'QuarterMagic':
                return "Your magic\npower has been\nquadrupled!";
            case 'PendantOfCourage':
                return "Courage for\nthose who\nalready had it";
            case 'PendantOfWisdom':
                return "Wisdom for\nthose who\nalready had it";
            case 'PendantOfPower':
                return "Power for\nthose who\nalready had it";
            case 'Rupoor':
                return "This is not\nreally worth\nyour time";
            case 'RedClock':
                return "like the sands\nthrough a red\nhourglass";
            case 'BlueClock':
                return "sapphire sand\ntrickles down";
            case 'GreenClock':
                return "tick tock\ntick tock";
            case 'ProgressiveSword':
                return "a better copy\nof your sword\nfor your time";
            case 'ProgressiveShield':
                return "have a better\ndefense in\nfront of you";
            case 'ProgressiveArmor':
                return "time for a\nchange of\nclothes?";
            case 'ProgressiveGlove':
                return "a way to lift\nheavier things";
            case 'singleRNG':
            case 'multiRNG':
                return "who knows? you\nprobably don't\nneed this.";
            case 'Triforce':
                return "\n   YOU WIN!";
            case 'PowerStar':
                return "Aim for the\nmoon. You may\nhit a 'star'";
            case 'TriforcePiece':
                return "a yellow\ntriangle\nyou need this";
            case 'Nothing':
            default:
                return "Don't waste\nyour time!";
        }
    }
}
