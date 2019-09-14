<?php

namespace ALttP\Location\Npc;

use ALttP\Item;
use ALttP\Location\Npc;
use ALttP\Rom;

/**
 * Witch specifically changes the credits when you write an item.
 */
class Witch extends Npc
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

        $rom->setCredit('witch', $this->getItemCreditsText());

        return $this;
    }

    private function getItemCreditsText()
    {
        switch (get_class($this->item->getTarget())) {
            case Item\Key::class:
            case Item\BigKey::class:
                return "keys, keys, keys";
            case Item\Map::class:
                return "shrooms find secrets";
            case Item\Compass::class:
                return "shrooms for navigation";
            case Item\Egg::class:
                return "shrooms for eggs";
        }

        switch ($this->item->getTarget()->getRawName()) {
            case 'L1Sword':
            case 'L1SwordAndShield':
                return "fungus for slasher";
            case 'L2Sword':
            case 'MasterSword':
                return "fungus for blue slasher";
            case 'L3Sword':
                return "fungus for red slasher";
            case 'L4Sword':
                return "cap churned to butter";
            case 'BlueShield':
                return "fungus for shield";
            case 'RedShield':
                return "fungus for fire shield";
            case 'MirrorShield':
                return "fungus for shiny shield";
            case 'FireRod':
                return "fungus for rage-rod";
            case 'IceRod':
                return "fungus for ice-rod";
            case 'Hammer':
                return "stop...   hammer time";
            case 'Hookshot':
                return "witch and tickle boy";
            case 'Bow':
            case 'BowAndArrows':
            case 'BowAndSilverArrows':
            case 'ProgressiveBow':
                return "witch and robin hood";
            case 'Boomerang':
                return "fungus for puma-stick";
            case 'RedBoomerang':
                return "fungus for return-stick";
            case 'Powder':
                return "the witch and assistant";
            case 'Bombos':
                return "shrooms for swirly-coin";
            case 'Ether':
                return "shrooms for bolt-coin";
            case 'Quake':
                return "shrooms for wavy-coin";
            case 'Lamp':
                return "fungus for illumination";
            case 'Shovel':
                return "can you dig it";
            case 'CaneOfSomaria':
                return "twizzle-stick for trade";
            case 'CaneOfByrna':
                return "spark-stick for trade";
            case 'Cape':
                return "hood from a hood";
            case 'MagicMirror':
                return "trades looking-glass";
            case 'PowerGlove':
                return "fungus for gloves";
            case 'TitansMitt':
                return "fungus for bling-gloves";
            case 'BookOfMudora':
                return "drugs for literacy";
            case 'Flippers':
                return "shrooms let you swim";
            case 'MoonPearl':
                return "shrooms for moon rock";
            case 'BugCatchingNet':
                return "fungus for butterflies";
            case 'BlueMail':
                return "the clothing store";
            case 'RedMail':
                return "the nice clothing store";
            case 'PieceOfHeart':
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "fungus for life";
            case 'Bomb':
            case 'ThreeBombs':
            case 'TenBombs':
                return "blend fungus into bombs";
            case 'Mushroom':
                return "my name is error";
            case 'Bottle':
                return "first taste is not free";
            case 'BottleWithRedPotion':
            case 'BottleWithGreenPotion':
            case 'BottleWithBluePotion':
                return "free samples";
            case 'BottleWithGoldBee':
            case 'BottleWithBee':
                return "insects for trade";
            case 'BottleWithFairy':
                return "shrooms for friends";
            case 'Heart':
                return "trading for transplant";
            case 'Arrow':
                return "fungus for arrow";
            case 'TenArrows':
                return "fungus for arrows";
            case 'SmallMagic':
                return "fungus for magic";
            case 'OneRupee':
            case 'FiveRupees':
                return "buying cheap drugs";
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "the witch buying drugs";
            case 'OneHundredRupees':
                return "buying good drugs";
            case 'ThreeHundredRupees':
                return "buying the best drugs";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "duck-calls for trade";
            case 'PegasusBoots':
                return "shrooms for speed";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "the shroom goes boom";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "witch and more arrows";
            case 'SilverArrowUpgrade':
                return "arrow-honing service";
            case 'HalfMagic':
            case 'QuarterMagic':
                return "mekalekahi mekahiney ho";
            case 'Rupoor':
                return "witch stole your rupees";
            case 'RedClock':
                return "shrooms for ruby time";
            case 'BlueClock':
                return "fungus for blue time";
            case 'GreenClock':
                return "shrooms for green time";
            case 'ProgressiveSword':
                return "fungus for some slasher";
            case 'ProgressiveShield':
                return "fungus for some shield";
            case 'ProgressiveArmor':
                return "the clothing store";
            case 'ProgressiveGlove':
                return "fungus for gloves";
            case 'singleRNG':
            case 'multiRNG':
                return "fungus for something";
            case 'Triforce':
                return "mushrooms win the game";
            case 'PowerStar':
                return "the powder or the stars";
            case 'TriforcePiece':
                return "hoarding for ganon";
            case 'Nothing':
            default:
                return "mushrooms go poof";
        }
    }
}
