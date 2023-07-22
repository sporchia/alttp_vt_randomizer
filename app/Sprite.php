<?php

declare(strict_types=1);

namespace App;

use Illuminate\Support\Collection;

/**
 * A Sprite are the things in game.
 * this is very much a work in progress... and still so after 2 years...
 */
class Sprite
{
    public readonly int $byte;
    public readonly int $subtype;
    public array $sheets;
    public readonly string $name;
    public $nice_name;

    protected static $items;

    /**
     * Get the Sprite by name
     *
     * @param string $name Name of Sprite
     *
     * @throws \Exception if the Sprite doesn't exist
     *
     * @return Sprite
     */
    public static function get($name)
    {
        $items = static::all();
        if (isset($items[$name])) {
            return $items[$name];
        }

        throw new \Exception('Unknown Sprite: ' . $name);
    }

    /**
     * Get the all known Sprites
     *
     * @return Collection
     */
    public static function all(): Collection
    {
        if (static::$items) {
            return static::$items;
        }

        static::$items = new Collection([
            new Sprite("Raven", 0x00, 0x00, [null, null, null, [0x11, 0x19]]),
            new Sprite("Vulture", 0x01, 0x00, [null, null, 0x12, null]),
            new Sprite("FlyingStalfosHead", 0x02, 0x00, [0x1F, null, null, null]),
            new Sprite("Empty", 0x03, 0x00, [null, null, null, null]),
            new Sprite("PullSwitchGood", 0x04, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("PullSwitchGoodUnused", 0x05, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("PullSwitchBad", 0x06, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("PullSwitchBadUnused", 0x07, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("Octorok1", 0x08, 0x00, [null, null, [0x0C, 0x18], null]),
            new Sprite("Moldorm", 0x09, 0x00, [null, null, 0x30, null]),
            new Sprite("Octorok4", 0x0A, 0x00, [null, null, [0x0C, 0x18], null]),
            new Sprite("Chicken", 0x0B, 0x00, [null, null, null, [0x15, 0x50]]),
            new Sprite("@Chicken", 0x0B, 0x00, [null, null, null, [0x15, 0x50]]),
            new Sprite("OctorokStone", 0x0C, 0x00, [null, null, [0x0C, 0x18], null]),
            new Sprite("Buzzblob", 0x0D, 0x00, [null, null, null, 0x11]),
            new Sprite("Snapdragon", 0x0E, 0x00, [0x16, null, 0x17, null]),
            new Sprite("Octoballoon", 0x0F, 0x00, [null, null, 0x0C, null]),
            new Sprite("Octobaby", 0x10, 0x00, [null, null, 0x0C, null]),
            new Sprite("Hinox", 0x11, 0x00, [0x16, null, null, null]),
            new Sprite("Moblin", 0x12, 0x00, [null, null, 0x17, null]),
            new Sprite("MiniHelmasaur", 0x13, 0x00, [null, 0x1E, null, null]),
            new Sprite("ForkGate", 0x14, 0x00, [null, null, null, null]),
            new Sprite("Antifairy", 0x15, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("Sahasrahla", 0x16, 0x00, [null, null, 0x4C, null]),
            new Sprite("BushHoarder", 0x17, 0x00, [null, null, null, [0x10, 0x11]]),
            new Sprite("MiniMoldorm", 0x18, 0x00, [null, 0x1E, null, null]),
            new Sprite("Poe", 0x19, 0x00, [[0x0E, 0x15], null, null, null]),
            new Sprite("DwarfSmith", 0x1A, 0x00, [null, 0x4D, null, 0x15]),
            new Sprite("SpriteArrow", 0x1B, 0x00, [null, null, null, null]),
            new Sprite("Statue", 0x1C, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("FluteQuest", 0x1D, 0x00, [null, null, null, null]),
            new Sprite("CrystalSwitch", 0x1E, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("SickKid", 0x1F, 0x00, [0x51, null, null, null]),
            new Sprite("Sluggula", 0x20, 0x00, [null, null, 0x25, null]),
            new Sprite("PushSwitch", 0x21, 0x00, [null, null, null, 0x53]),
            new Sprite("Ropa", 0x22, 0x00, [0x16, null, null, null]),
            new Sprite("RedBari", 0x23, 0x00, [0x1F, null, null, null]),
            new Sprite("BlueBari", 0x24, 0x00, [0x1F, null, null, null]),
            new Sprite("TalkingTree", 0x25, 0x00, [null, null, null, 0x15]),
            new Sprite("HardhatBeetle", 0x26, 0x00, [null, 0x1E, null, null]),
            new Sprite("Deadrock", 0x27, 0x00, [null, null, null, 0x10]),
            new Sprite("Storyteller", 0x28, 0x00, [0x4B, 0x4D, null, null]),
            new Sprite("Adult", 0x29, 0x00, [[0x0E, 0x4F], null, 0x4A, null]),
            new Sprite("SweepingLady", 0x2A, 0x00, [null, null, 0x4A, null]),
            new Sprite("Hobo", 0x2B, 0x00, [null, null, 0x37, null]),
            new Sprite("Lumberjack", 0x2C, 0x00, [null, null, 0x4A, null]),
            new Sprite("TelepathyTile", 0x2D, 0x00, [null, null, null, null]),
            new Sprite("FluteKid", 0x2E, 0x00, [null, null, 0x4E, 0x4C]),
            new Sprite("RaceGameLady", 0x2F, 0x00, [0x4F, null, null, 0x50]),
            new Sprite("RaceGameBoy", 0x30, 0x00, [0x4F, null, null, 0x50]),
            new Sprite("FortuneTeller", 0x31, 0x00, [0x4B, 0x4D, null, null]),
            new Sprite("AngryBrother", 0x32, 0x00, [0x4F, null, null, null]),
            new Sprite("PullForRupees", 0x33, 0x00, [null, null, null, null]),
            new Sprite("YoungSnitch", 0x34, 0x00, [0x4F, null, null, 0x50]),
            new Sprite("Innkeeper", 0x35, 0x00, [null, null, null, 0x50]),
            new Sprite("Witch", 0x36, 0x00, [null, null, 0x4C, null]),
            new Sprite("Waterfall", 0x37, 0x00, [null, null, null, null]),
            new Sprite("ArrowTarget", 0x38, 0x00, [null, null, null, null]),
            new Sprite("AverageMan", 0x39, 0x00, [null, null, null, 0x11]),
            new Sprite("MagicBat", 0x3A, 0x00, [null, null, null, 0x1D]),
            new Sprite("DashItem", 0x3B, 0x00, [null, null, null, null]),
            new Sprite("VillageKid", 0x3C, 0x00, [null, null, 0x4A, null]),
            new Sprite("OldSnitch", 0x3D, 0x00, [null, null, null, 0x50]),
            new Sprite("RockHoarder", 0x3E, 0x00, [null, null, null, [0x10, 0x11]]),
            new Sprite("TutorialGuard", 0x3F, 0x00, [0x48, 0x49, null, null]),
            new Sprite("LightningLock", 0x40, 0x00, [null, null, null, 0x1D]),
            new Sprite("BlueSwordGuard", 0x41, 0x00, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("BlueSwordGuard01", 0x41, 0x01, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("BlueSwordGuard02", 0x41, 0x02, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("BlueSwordGuard03", 0x41, 0x03, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("BlueSwordGuard05", 0x41, 0x05, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("BlueSwordGuard13", 0x41, 0x13, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("BlueSwordGuard15", 0x41, 0x15, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("BlueSwordGuard1B", 0x41, 0x1b, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("GreenSwordGuard", 0x42, 0x00, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("GreenSwordGuard01", 0x42, 0x01, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("GreenSwordGuard03", 0x42, 0x03, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("GreenSwordGuard1B", 0x42, 0x1b, [null, [0x0D, 0x49], [0x13, 0x29], null]),
            new Sprite("RedSpearGuard", 0x43, 0x00, [null, 0x49, null, null]),
            new Sprite("AssaultSwordGuard", 0x44, 0x00, [0x46, 0x49, null, null]),
            new Sprite("FastRedSpearGuard", 0x45, 0x00, [null, 0x49, null, null]),
            new Sprite("BlueArcher", 0x46, 0x00, [0x48, 0x49, null, null]),
            new Sprite("GreenArcher", 0x47, 0x00, [0x48, 0x49, null, null]),
            new Sprite("RedJavelinGuard", 0x48, 0x00, [0x46, 0x49, null, null]),
            new Sprite("RedJavelinGuard2", 0x49, 0x00, [0x46, 0x49, null, null]),
            new Sprite("RedBombGuard", 0x4A, 0x00, [0x46, 0x49, null, null]),
            new Sprite("GreenGuardRecruit", 0x4B, 0x00, [null, 0x49, 0x13, null]),
            new Sprite("Geldman", 0x4C, 0x00, [null, null, 0x12, null]),
            new Sprite("Rabbit", 0x4D, 0x00, [null, null, null, 0x11]),
            new Sprite("Popo", 0x4E, 0x00, [null, 0x2C, null, null]),
            new Sprite("Popo2", 0x4F, 0x00, [null, 0x2C, null, null]),
            new Sprite("Cannonball", 0x50, 0x00, [null, null, 0x2E, null]),
            new Sprite("Armos", 0x51, 0x00, [null, null, null, 0x10]),
            new Sprite("KingZora", 0x52, 0x00, [null, null, null, 0x44]),
            new Sprite("ArmosKnight", 0x53, 0x00, [null, null, null, 0x1D]),
            new Sprite("Lanmolas", 0x54, 0x00, [null, null, null, 0x31]),
            new Sprite("FireballZora", 0x55, 0x00, [null, null, [0x0C, 0x18], null]),
            new Sprite("WalkingZora", 0x56, 0x00, [null, null, [0x0C, 0x18], 0x44]),
            new Sprite("DesertPalaceBarrier", 0x57, 0x00, [null, null, 0x12, null]),
            new Sprite("Crab", 0x58, 0x00, [null, null, 0x0C, null]),
            new Sprite("Bird", 0x59, 0x00, [null, null, null, 0x36]),
            new Sprite("Squirrel", 0x5A, 0x00, [null, null, null, 0x36]),
            new Sprite("SparkCW", 0x5B, 0x00, [0x1F, null, null, null]),
            new Sprite("SparkCCW", 0x5C, 0x00, [0x1F, null, null, null]),
            new Sprite("RollerVU", 0x5D, 0x00, [null, null, 0x27, null]),
            new Sprite("RollerVD", 0x5E, 0x00, [null, null, 0x27, null]),
            new Sprite("RollerHL", 0x5F, 0x00, [null, null, 0x27, null]),
            new Sprite("RollerHR", 0x60, 0x00, [null, null, 0x27, null]),
            new Sprite("Beamos", 0x61, 0x00, [null, 0x2C, null, null]),
            new Sprite("MasterSword", 0x62, 0x00, [null, null, 0x37, 0x36]),
            new Sprite("DevalantBlue", 0x63, 0x00, [0x2F, null, null, null]),
            new Sprite("DevalantRed", 0x64, 0x00, [0x2F, null, null, null]),
            new Sprite("ShootingGalleryNPC", 0x65, 0x00, [0x4B, null, null, null]),
            new Sprite("CannonBallShooterR", 0x66, 0x00, [0x2F, null, null, null]),
            new Sprite("CannonBallShooterL", 0x67, 0x00, [0x2F, null, null, null]),
            new Sprite("CannonBallShooterD", 0x68, 0x00, [0x2F, null, null, null]),
            new Sprite("CannonBallShooterU", 0x69, 0x00, [0x2F, null, null, null]),
            new Sprite("BallNChainTrooper", 0x6A, 0x00, [0x46, 0x49, null, null]),
            new Sprite("CannonGuard", 0x6B, 0x00, [0x46, 0x49, null, null]),
            new Sprite("MirrorPortal", 0x6C, 0x00, [null, null, null, null]),
            new Sprite("Rat", 0x6D, 0x00, [null, null, [0x1C, 0x24], null]),
            new Sprite("Rope", 0x6E, 0x00, [null, null, [0x1C, 0x24], null]),
            new Sprite("Keese", 0x6F, 0x00, [null, null, [0x1C, 0x24], null]),
            new Sprite("HelmasaurFireball", 0x70, 0x00, [null, null, null, 0x3E]),
            new Sprite("Leever", 0x71, 0x00, [0x2F, null, null, null]),
            new Sprite("PondActivation", 0x72, 0x00, [null, null, null, 0x36]),
            new Sprite("Uncle", 0x73, 0x00, [0x51, null, null, null]),
            new Sprite("Priest", 0x73, 0x00, [0x47, null, null, null]),
            new Sprite("RunningMan", 0x74, 0x00, [0x4F, null, null, 0x50]),
            new Sprite("BottleSalesman", 0x75, 0x00, [null, null, 0x4A, null]),
            new Sprite("Zelda", 0x76, 0x00, [null, null, null, null]),
            new Sprite("Antifairy2", 0x77, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("SahaWife", 0x78, 0x00, [null, null, 0x4A, null]),
            new Sprite("Bee", 0x79, 0x00, [null, null, null, null]),
            new Sprite("Agahnim", 0x7A, 0x00, [null, [0x1A, 0x3D], 0x42, 0x43]),
            new Sprite("AgahnimBall", 0x7B, 0x00, [null, null, null, 0x43]),
            new Sprite("GreenStalfos", 0x7C, 0x00, [0x1F, null, null, null]),
            new Sprite("BigSpikeTrap", 0x7D, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("FireBarCW", 0x7E, 0x00, [0x1F, null, null, null]),
            new Sprite("FireBarCCW", 0x7F, 0x00, [0x1F, null, null, null]),
            new Sprite("FireSnake", 0x80, 0x00, [0x1F, null, null, null]),
            new Sprite("Hover", 0x81, 0x00, [null, null, 0x22, null]),
            new Sprite("AntifairyCircle", 0x82, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("EyegoreGreen", 0x83, 0x00, [null, null, 0x2E, null]),
            new Sprite("MimicGreen", 0x83, 0x01, [null, 0x2C, null, null]),
            new Sprite("EyegoreRed", 0x84, 0x00, [null, null, 0x2E, null]),
            new Sprite("MimicRed", 0x84, 0x01, [null, 0x2C, null, null]),
            new Sprite("StalfosYellow", 0x85, 0x00, [0x1F, null, null, null]),
            new Sprite("Kodongo", 0x86, 0x00, [null, null, 0x2A, null]),
            new Sprite("Flames", 0x87, 0x00, [null, null, 0x2A, null]),
            new Sprite("Mothula", 0x88, 0x00, [null, null, 0x38, null]),
            new Sprite("MothulaBeam", 0x89, 0x00, [null, null, 0x38, null]),
            new Sprite("SpikeTrap", 0x8A, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("Gibdo", 0x8B, 0x00, [null, null, 0x23, null]),
            new Sprite("Arrghus", 0x8C, 0x00, [null, null, 0x39, null]),
            new Sprite("ArrghusSpawn", 0x8D, 0x00, [null, null, 0x39, null]),
            new Sprite("Terrorpin", 0x8E, 0x00, [null, null, 0x2A, null]),
            new Sprite("Zol", 0x8F, 0x00, [null, 0x20, null, null]),
            new Sprite("Wallmaster", 0x90, 0x00, [null, null, 0x23, null]),
            new Sprite("StalfosKnight", 0x91, 0x00, [null, 0x20, null, null]),
            new Sprite("Helmasaur", 0x92, 0x00, [null, null, 0x3A, 0x3E]),
            new Sprite("Bumper", 0x93, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("Pirogisu", 0x94, 0x00, [null, null, 0x22, null]),
            new Sprite("LaserEyeR", 0x95, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("LaserEyeL", 0x96, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("LaserEyeD", 0x97, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("LaserEyeU", 0x98, 0x00, [null, null, null, [0x52, 0x53]]),
            new Sprite("Pengator", 0x99, 0x00, [null, null, 0x26, null]),
            new Sprite("Kyameron", 0x9A, 0x00, [null, null, 0x22, null]),
            new Sprite("Wizzrobe", 0x9B, 0x00, [null, null, [0x25, 0x29], null]),
            new Sprite("Zoro", 0x9C, 0x00, [null, 0x20, null, null]),
            new Sprite("Babasu", 0x9D, 0x00, [null, 0x20, null, null]),
            new Sprite("OstrichHG", 0x9E, 0x00, [null, null, 0x4E, null]),
            new Sprite("RabbitHG", 0x9F, 0x00, [null, null, 0x4E, null]),
            new Sprite("BirdHG", 0xA0, 0x00, [null, null, 0x4E, null]),
            new Sprite("Freezor", 0xA1, 0x00, [null, null, 0x26, null]),
            new Sprite("Kholdstare", 0xA2, 0x00, [null, null, 0x3C, null]),
            new Sprite("KholdstareShell", 0xA3, 0x00, [null, null, null, null]),
            new Sprite("FallingIce", 0xA4, 0x00, [null, null, 0x3C, null]),
            new Sprite("ZazakBlue", 0xA5, 0x00, [null, null, 0x28, null]),
            new Sprite("ZazakRed", 0xA6, 0x00, [null, null, 0x28, null]),
            new Sprite("Stalfos", 0xA7, 0x00, [0x1F, null, null, null]),
            new Sprite("ZirroGreen", 0xA8, 0x00, [null, null, null, 0x1B]),
            new Sprite("ZirroBlue", 0xA9, 0x00, [null, null, null, 0x1B]),
            new Sprite("Pikit", 0xAA, 0x00, [null, null, null, 0x1B]),
            new Sprite("Maiden", 0xAB, 0x00, [null, null, null, null]),
            new Sprite("Apple", 0xAC, 0x00, [null, null, null, null]),
            new Sprite("LostOldMan", 0xAD, 0x00, [null, null, 0x1C, null]),
            new Sprite("PipeD", 0xAE, 0x00, [null, null, null, null]),
            new Sprite("PipeU", 0xAF, 0x00, [null, null, null, null]),
            new Sprite("PipeR", 0xB0, 0x00, [null, null, null, null]),
            new Sprite("PipeL", 0xB1, 0x00, [null, null, null, null]),
            new Sprite("BeeGood", 0xB2, 0x00, [null, null, null, null]),
            new Sprite("HylianPlaque", 0xB3, 0x00, [null, null, null, null]),
            new Sprite("PurpleChest", 0xB4, 0x00, [null, null, null, 0x15]),
            new Sprite("BombSalesman", 0xB5, 0x00, [null, 0x4D, null, 0x5A]),
            new Sprite("Kiki", 0xB6, 0x00, [null, null, null, 0x19]),
            new Sprite("BlindMaiden", 0xB7, 0x00, [null, null, null, null]),
            new Sprite("DialogueTester", 0xB8, 0x00, [null, null, null, null]),
            new Sprite("FeudingFriends", 0xB9, 0x00, [null, null, null, 0x14]),
            new Sprite("Whirlpool", 0xBA, 0x00, [null, null, null, null]),
            new Sprite("Salesman", 0xBB, 0x00, [0x4B, 0x4D, null, 0x5A]),
            new Sprite("Drunkard", 0xBC, 0x00, [0x4F, null, 0x4A, null]),
            new Sprite("Vitreous", 0xBD, 0x00, [null, null, null, 0x3D]),
            new Sprite("VitreousSmallEyeball", 0xBE, 0x00, [null, null, null, 0x3D]),
            new Sprite("Lightning", 0xBF, 0x00, [null, 0x3D, null, 0x3D]),
            new Sprite("Catfish", 0xC0, 0x00, [null, null, 0x18, null]),
            new Sprite("AgahnimCutscene", 0xC1, 0x00, [0x55, 0x3D, 0x42, 0x43]),
            new Sprite("Boulder", 0xC2, 0x00, [null, null, null, 0x10]),
            new Sprite("Gibo", 0xC3, 0x00, [null, null, 0x28, null]),
            new Sprite("Thief", 0xC4, 0x00, [[0x0E, 0x15], null, null, null]),
            new Sprite("Medusa", 0xC5, 0x00, [null, null, null, null]),
            new Sprite("YomoMedusa", 0xC6, 0x00, [null, null, null, null]),
            new Sprite("Pokey", 0xC7, 0x00, [null, null, 0x27, null]),
            new Sprite("FairyBig", 0xC8, 0x00, [null, null, 0x39, null]),
            new Sprite("Tektite", 0xC9, 0x00, [null, null, null, 0x10]),
            new Sprite("ChainChomp", 0xCA, 0x00, [null, null, 0x27, null]),
            new Sprite("Trinexx", 0xCB, 0x00, [0x40, null, null, 0x3F]),
            new Sprite("TrinexxHeadFire", 0xCC, 0x00, [0x40, null, null, null]),
            new Sprite("TrinexxHeadIce", 0xCD, 0x00, [0x40, null, null, null]),
            new Sprite("Blind", 0xCE, 0x00, [null, null, 0x3B, null]),
            new Sprite("Swamola", 0xCF, 0x00, [null, null, null, 0x19]),
            new Sprite("Lynel", 0xD0, 0x00, [null, null, null, 0x14]),
            new Sprite("BunnyBeam", 0xD1, 0x00, [null, null, null, null]),
            new Sprite("FloppingFish", 0xD2, 0x00, [null, null, null, null]),
            new Sprite("Stal", 0xD3, 0x00, [null, null, null, null]),
            new Sprite("Landmine", 0xD4, 0x00, [null, null, null, null]),
            new Sprite("DiggingGameNPC", 0xD5, 0x00, [null, 0x2A, null, null]),
            new Sprite("Ganon", 0xD6, 0x00, [0x21, 0x41, 0x45, 0x33]),
            new Sprite("GanonInvisible", 0xD7, 0x00, [0x21, 0x41, 0x45, 0x33]),
            new Sprite("Heart", 0xD8, 0x00, [null, null, null, null]),
            new Sprite("@Heart", 0xD8, 0x00, [null, null, null, null]),
            new Sprite("RupeeGreen", 0xD9, 0x00, [null, null, null, null]),
            new Sprite("@RupeeGreen", 0xD9, 0x00, [null, null, null, null]),
            new Sprite("RupeeBlue", 0xDA, 0x00, [null, null, null, null]),
            new Sprite("@RupeeBlue", 0xDA, 0x00, [null, null, null, null]),
            new Sprite("RupeeRed", 0xDB, 0x00, [null, null, null, null]),
            new Sprite("BombRefill1", 0xDC, 0x00, [null, null, null, null]),
            new Sprite("@BombRefill1", 0xDC, 0x00, [null, null, null, null]),
            new Sprite("BombRefill4", 0xDD, 0x00, [null, null, null, null]),
            new Sprite("BombRefill8", 0xDE, 0x00, [null, null, null, null]),
            new Sprite("MagicRefillSmall", 0xDF, 0x00, [null, null, null, null]),
            new Sprite("@MagicRefillSmall", 0xDF, 0x00, [null, null, null, null]),
            new Sprite("MagicRefillFull", 0xE0, 0x00, [null, null, null, null]),
            new Sprite("@MagicRefillFull", 0xE0, 0x00, [null, null, null, null]),
            new Sprite("ArrowRefill5", 0xE1, 0x00, [null, null, null, null]),
            new Sprite("@ArrowRefill5", 0xE1, 0x00, [null, null, null, null]),
            new Sprite("ArrowRefill10", 0xE2, 0x00, [null, null, null, null]),
            new Sprite("Fairy", 0xE3, 0x00, [null, null, null, null]),
            new Sprite("Key", 0xE4, 0x00, [null, null, null, null]),
            new Sprite("@Key", 0xE4, 0x00, [null, null, null, null]),
            new Sprite("BigKey", 0xE5, 0x00, [null, null, null, null]),
            new Sprite("Shield", 0xE6, 0x00, [null, null, null, 0x1B]),
            new Sprite("Mushroom", 0xE7, 0x00, [null, null, null, null]),
            new Sprite("FakeMasterSword", 0xE8, 0x00, [null, null, null, 0x11]),
            new Sprite("PotionShop", 0xE9, 0x00, [0x4B, 0x4D, null, 0x5A]),
            new Sprite("HeartContainer", 0xEA, 0x00, [null, null, null, null]),
            new Sprite("HeartPiece", 0xEB, 0x00, [null, null, null, null]),
            new Sprite("Throwable", 0xEC, 0x00, [null, null, null, null]),
            new Sprite("SomariaPlatform", 0xED, 0x00, [null, null, 0x27, null]),
            new Sprite("Mantle", 0xEE, 0x00, [0x5D, null, null, null]),
            new Sprite("SomariaPlatform1", 0xEF, 0x00, [null, null, 0x27, null]),
            new Sprite("SomariaPlatform2", 0xF0, 0x00, [null, null, 0x27, null]),
            new Sprite("SomariaPlatform3", 0xF1, 0x00, [null, null, 0x27, null]),
            new Sprite("MedallionTablet", 0xF2, 0x00, [null, null, 0x12, null]),
            // only works in OW, don't use these next two in UW!!
            new Sprite("Position Target", 0xF3, 0x00, [null, null, null, null]),
            new Sprite("Boulders", 0xF4, 0x00, [null, null, null, 0x10]),
            // Overlords
            new Sprite("FullRoomCannons", 0x02, 0x07, [null, null, 0x2E, null]),
            new Sprite("VerticalCannon", 0x03, 0x07, [null, null, 0x2E, null]),
            new Sprite("FallingStalfos", 0x05, 0x07, [0x1F, null, null, null]),
            new Sprite("BadSwitchSnake", 0x06, 0x07, [null, null, [0x1C, 0x24], null]),
            new Sprite("MovingFloor", 0x07, 0x07, [null, null, null, null]),
            new Sprite("BlobSpawner", 0x08, 0x07, [null, 0x20, null, null]),
            new Sprite("Wallmaster Overlord", 0x09, 0x07, [null, null, 0x23, null]),
            new Sprite("FallingSquare", 0x0A, 0x07, [null, null, null, [0x33, 0x52]]),
            new Sprite("FallingBridge", 0x0B, 0x07, [null, null, null, [0x33, 0x52]]),
            new Sprite("FallingTilesWestToEast", 0x0C, 0x07, [null, null, null, [0x33, 0x52]]),
            new Sprite("FallingTilesNorthToSouth", 0x0D, 0x07, [null, null, null, [0x33, 0x52]]),
            new Sprite("FallingTilesEastToWest", 0x0E, 0x07, [null, null, null, [0x33, 0x52]]),
            new Sprite("FallingTilesSouthToNorth", 0x0F, 0x07, [null, null, null, [0x33, 0x52]]),
            new Sprite("PirogusuSpawnerLeft", 0x10, 0x07, [null, null, 0x22, null]),
            new Sprite("PirogusuSpawnerRight", 0x11, 0x07, [null, null, 0x22, null]),
            new Sprite("PirogusuSpawnerTop", 0x12, 0x07, [null, null, 0x22, null]),
            new Sprite("PirogusuSpawnerBottom", 0x13, 0x07, [null, null, 0x22, null]),
            new Sprite("TileRoom", 0x14, 0x07, [null, null, null, [0x52, 0x53]]),
            new Sprite("WizzrobeSpawner", 0x15, 0x07, [null, null, [0x25, 0x29], null]),
            new Sprite("ZoroSpawner", 0x16, 0x07, [null, 0x20, null, null]),
            new Sprite("PotTrap", 0x17, 0x07, [null, null, null, null]),
            new Sprite("InvisibleStalfos", 0x18, 0x07, [0x1F, null, null, null]),
            new Sprite("ArmosCoordinator", 0x19, 0x07, [0x1F, null, null, null]),
            new Sprite("BadSwitchBomb", 0x1A, 0x07, [null, null, null, null]),
            // Secrets
            new Sprite("Hole", 0x80, 0x00, [null, null, null, null]),
            new Sprite("FloorSwitch", 0x88, 0x00, [null, null, null, null]),
        ]);
        static::$items = static::$items->keyBy(fn ($sprite) => $sprite->name);
        return static::all();
    }

    /**
     * @param string $name unique name of sprite
     * @param int $byte data to write to put sprite in place
     * @param int $subtype data to write to change sprite subtype
     * @param array $sheets Sheets need for proper GFX display
     *
     * @return void
     */
    public function __construct($name, int $byte, int $subtype, array $sheets)
    {
        $this->name = $name;
        $this->nice_name = 'sprite.' . $name;
        $this->byte = $byte;
        $this->subtype = $subtype;
        $this->sheets = $sheets;
    }

    /**
     * Get the nice name of this Sprite.
     *
     * @return string
     */
    public function getNiceName(): string
    {
        $formatted = __($this->nice_name);

        return is_string($formatted) ? $formatted : '';
    }

    /**
     * Get the i18n string of this Sprite.
     *
     * @return string
     */
    public function getI18nName(): string
    {
        return $this->nice_name;
    }

    /**
     * Get the byte to write
     */
    public function getByte(): int
    {
        return $this->byte;
    }

    /**
     * converts 4bpp 8x8 to palette reference at a given offset
     *
     * @author Zarby89
     *
     * @param array $sprite byte array of gfx data
     * @param int $pos position in stream to pull 8x8 from
     */
    public static function load8x8(array $sprite, int $pos = 0): array
    {
        //pos = 32 bytes to read per 8x8 tiles, will return an array of 64bytes
        $positions = [0x80, 0x40, 0x20, 0x10, 0x08, 0x04, 0x02, 0x01];
        $temp_array = [];
        for ($x = 0; $x < 8; $x++) {
            for ($y = 0; $y < 8; $y++) {
                $tmpbyte = 0;
                //There's 4 bit per pixel, 2 at the start, 2 at the middle, for every pixels
                //so we read all of them in order up to 32 byte
                if (($sprite[$pos + ($x * 2)] & $positions[$y]) == $positions[$y]) {
                    $tmpbyte |= 1;
                }
                if (($sprite[$pos + ($x * 2) + 1] & $positions[$y]) == $positions[$y]) {
                    $tmpbyte |= 2;
                }
                if (($sprite[$pos + 16 + ($x * 2)] & $positions[$y]) == $positions[$y]) {
                    $tmpbyte |= 4;
                }
                if (($sprite[$pos + 16 + ($x * 2) + 1] & $positions[$y]) == $positions[$y]) {
                    $tmpbyte |= 8;
                }
                $temp_array[$y + ($x * 8)] = $tmpbyte;
            }
        }

        return $temp_array;
    }

    /**
     * converts 4bpp 16x16 to palette reference at a given offset
     *
     * @author Zarby89
     *
     * @param array $sprite byte array of gfx data
     * @param int $pos position in stream to pull 8x8 from
     */
    public static function load16x16(array $sprite, int $pos = 0): array
    {
        //pos 0x40 = head facing down, pos 0x4C0 = body facing down
        $temp_array = array_fill(0, 16, []);
        $top_left = static::load8x8($sprite, $pos);
        $top_right = static::load8x8($sprite, $pos + 0x20);
        $bottom_left = static::load8x8($sprite, $pos + 0x200);
        $bottom_right = static::load8x8($sprite, $pos + 0x200 + 0x20);

        //copy all the bytes at the correct position in the 2d array
        for ($x = 0; $x < 8; $x++) {
            for ($y = 0; $y < 8; $y++) {
                $temp_array[$x][$y] = $top_left[$x + ($y * 8)];
                $temp_array[$x + 8][$y] = $top_right[$x + ($y * 8)];
                $temp_array[$x][$y + 8] = $bottom_left[$x + ($y * 8)];
                $temp_array[$x + 8][$y + 8] = $bottom_right[$x + ($y * 8)];
            }
        }
        return $temp_array;
    }

    /**
     * serialized version of Sprite
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name . serialize($this->byte);
    }
}
