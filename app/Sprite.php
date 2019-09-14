<?php

namespace ALttP;

use ALttP\Support\SpriteCollection;

/**
 * A Sprite are the things in game.
 * this is very much a work in progress...
 */
class Sprite
{
    protected $bytes;
    protected $address;
    protected $name;
    protected $nice_name;

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
     * Get the Sprite by byte
     *
     * @param int $byte byte of Sprite
     *
     * @throws \Exception if the Sprite doesn't exist
     *
     * @return Sprite
     */
    public static function getWithByte($byte)
    {
        foreach (static::all() as $item) {
            if ($item->bytes[0] == $byte) {
                return $item;
            }
        }

        throw new \Exception('Unknown Sprite: ' . $byte);
    }

    /**
     * Get the Sprite by bytes
     *
     * @param array $bytes array of bytes of Sprite
     *
     * @throws \Exception if the Sprite doesn't exist
     *
     * @return Sprite
     */
    public static function getWithBytes($bytes)
    {
        foreach (static::all() as $item) {
            foreach ($bytes as $key => $byte) {
                if (!isset($item->bytes[$key]) || $item->bytes[$key] != $byte) {
                    continue 2;
                }
            }
            return $item;
        }

        throw new \Exception('Unknown Sprite: ' . json_encode($bytes));
    }

    /**
     * Get the all known Sprites
     *
     * @return SpriteCollection
     */
    public static function all()
    {
        if (static::$items) {
            return static::$items;
        }

        static::$items = new SpriteCollection([
            new Sprite("Raven", [0x00]),
            new Sprite("Vulture", [0x01]),
            new Sprite("FlyingStalfosHead", [0x02]),
            new Sprite("Empty", [0x03]),
            new Sprite("PullSwitchGood", [0x04]),
            new Sprite("PullSwitch1", [0x05]),
            new Sprite("PullSwitchBad", [0x06]),
            new Sprite("PullSwitch2", [0x07]),
            new Sprite("Octorok1", [0x08]),
            new Sprite("Moldorm", [0x09]),
            new Sprite("Octorok4", [0x0A]),
            new Sprite("Chicken", [0x0B]),
            new Sprite("Octorok", [0x0C]),
            new Sprite("Buzzblob", [0x0D]),
            new Sprite("Snapdragon", [0x0E]),
            new Sprite("Octoballoon", [0x0F]),
            new Sprite("OctoballoonHatchlings", [0x10]),
            new Sprite("Hinox", [0x11]),
            new Sprite("Moblin", [0x12]),
            new Sprite("MiniHelmasaur", [0x13]),
            new Sprite("ForkGate", [0x14]),
            new Sprite("Antifairy", [0x15]),
            new Sprite("Sahasrahla", [0x16]),
            new Sprite("BushHoarder", [0x17]),
            new Sprite("MiniMoldorm", [0x18]),
            new Sprite("Poe", [0x19]),
            new Sprite("Dwarves", [0x1A]),
            new Sprite("WallArrow", [0x1B]),
            new Sprite("Statue", [0x1C]),
            new Sprite("Weathervane", [0x1D]),
            new Sprite("CrystalSwitch", [0x1E]),
            new Sprite("SickKid", [0x1F]),
            new Sprite("Sluggula", [0x20]),
            new Sprite("PushSwitch", [0x21]),
            new Sprite("Ropa", [0x22]),
            new Sprite("RedBari", [0x23]),
            new Sprite("BlueBari", [0x24]),
            new Sprite("TalkingTree", [0x25]),
            new Sprite("HardhatBeetle", [0x26]),
            new Sprite("Deadrock", [0x27]),
            new Sprite("Storytellers", [0x28]),
            new Sprite("BlindHistorian", [0x29]),
            new Sprite("SweepingLady", [0x2A]),
            new Sprite("Multipurpose", [0x2B]),
            new Sprite("Lumberjacks", [0x2C]),
            new Sprite("TelepathicStones", [0x2D]),
            new Sprite("FluteBoyNotes", [0x2E]),
            new Sprite("RaceNPCs", [0x2F]),
            new Sprite("Person", [0x30]),
            new Sprite("FortuneTeller", [0x31]),
            new Sprite("AngryBrothers", [0x32]),
            new Sprite("PullForRupees", [0x33]),
            new Sprite("ScaredGirl2", [0x34]),
            new Sprite("Innkeeper", [0x35]),
            new Sprite("Potion Shop", [0x36]),
            new Sprite("Waterfall", [0x37]),
            new Sprite("ArrowTarget", [0x38]),
            new Sprite("AverageMan", [0x39]),
            new Sprite("MagicBat", [0x3A]),
            new Sprite("DashItem", [0x3B]),
            new Sprite("VillageKid", [0x3C]),
            new Sprite("Sign", [0x3D]),
            new Sprite("RockHoarder", [0x3E]),
            new Sprite("TutorialSoldier", [0x3F]),
            new Sprite("LightningLock", [0x40]),
            new Sprite("BlueSwordSoldier", [0x41]),
            new Sprite("GreenSwordSoldier", [0x42]),
            new Sprite("RedSpearSoldier", [0x43]),
            new Sprite("AssaultSwordSoldier", [0x44]),
            new Sprite("GreenSpearSoldier", [0x45]),
            new Sprite("BlueArcher", [0x46]),
            new Sprite("GreenArcher", [0x47]),
            new Sprite("RedJavelinSolider", [0x48]),
            new Sprite("RedJavelinSolider2", [0x49]),
            new Sprite("RedBombSolider", [0x4A]),
            new Sprite("GreenSoldierRecruit", [0x4B]),
            new Sprite("Geldman", [0x4C]),
            new Sprite("Rabbit", [0x4D]),
            new Sprite("Popo", [0x4E]),
            new Sprite("Popo2", [0x4F]),
            new Sprite("CannonBall", [0x50]),
            new Sprite("Armos", [0x51]),
            new Sprite("KingZora", [0x52]),
            new Sprite("ArmosKnights", [0x53]),
            new Sprite("Lanmolas", [0x54]),
            new Sprite("FireballZora", [0x55]),
            new Sprite("WalkingZora", [0x56]),
            new Sprite("DesertPalaceBarrier", [0x57]),
            new Sprite("Crab", [0x58]),
            new Sprite("Bird", [0x59]),
            new Sprite("Squirrel", [0x5A]),
            new Sprite("SparkLR", [0x5B]),
            new Sprite("SparkRL", [0x5C]),
            new Sprite("RollerV1", [0x5D]),
            new Sprite("RollerV2", [0x5E]),
            new Sprite("Roller", [0x5F]),
            new Sprite("RollerH", [0x60]),
            new Sprite("Beamos", [0x61]),
            new Sprite("MasterSword", [0x62]),
            new Sprite("Devalant", [0x63]),
            new Sprite("DevalantShooter", [0x64]),
            new Sprite("ShootingGalleryNPC", [0x65]),
            new Sprite("CannonBallShooterR", [0x66]),
            new Sprite("CannonBallShooterL", [0x67]),
            new Sprite("CannonBallShooterD", [0x68]),
            new Sprite("CannonBallShooterU", [0x69]),
            new Sprite("BallNChainTrooper", [0x6A]),
            new Sprite("CannonSoldier", [0x6B]),
            new Sprite("MirrorPortal", [0x6C]),
            new Sprite("Rat", [0x6D]),
            new Sprite("Rope", [0x6E]),
            new Sprite("Keese", [0x6F]),
            new Sprite("HelmasaurFireball", [0x70]),
            new Sprite("Leever", [0x71]),
            new Sprite("PondActivation", [0x72]),
            new Sprite("Link's Uncle", [0x73]),
            new Sprite("RunningMan", [0x74]),
            new Sprite("BottleSalesman", [0x75]),
            new Sprite("Zelda", [0x76]),
            new Sprite("Antifairy2", [0x77]),
            new Sprite("VillageElder", [0x78]),
            new Sprite\Droppable("Bee", [0x79]), // Bee hoard?
            new Sprite("Agahnim", [0x7A]),
            new Sprite("AgahnimBall", [0x7B]),
            new Sprite("Hyu", [0x7C]),
            new Sprite("BigSpikeTrap", [0x7D]),
            new Sprite("GuruguruBarCW", [0x7E]),
            new Sprite("GuruguruBarCCW", [0x7F]),
            new Sprite("Winder", [0x80]),
            new Sprite("WaterTektite", [0x81]),
            new Sprite("AntifairyCircle", [0x82]),
            new Sprite("EyegoreGreen", [0x83]),
            new Sprite("EyegoreRed", [0x84]),
            new Sprite("StalfosYellow", [0x85]),
            new Sprite("Kodongos", [0x86]),
            new Sprite("Flames", [0x87]),
            new Sprite("Mothula", [0x88]),
            new Sprite("MothulaBeam", [0x89]),
            new Sprite("SpikeTrap", [0x8A]),
            new Sprite("Gibdo", [0x8B]),
            new Sprite("Arrghus", [0x8C]),
            new Sprite("ArrghusSpawn", [0x8D]),
            new Sprite("Terrorpin", [0x8E]),
            new Sprite("Slime", [0x8F]),
            new Sprite("Wallmaster", [0x90]),
            new Sprite("StalfosKnight", [0x91]),
            new Sprite("Helmasaur", [0x92]),
            new Sprite("Bumper", [0x93]),
            new Sprite("Swimmers", [0x94]),
            new Sprite("EyeLaserR", [0x95]),
            new Sprite("EyeLaserL", [0x96]),
            new Sprite("EyeLaserD", [0x97]),
            new Sprite("EyeLaserU", [0x98]),
            new Sprite("Pengator", [0x99]),
            new Sprite("Kyameron", [0x9A]),
            new Sprite("Wizzrobe", [0x9B]),
            new Sprite("Tadpoles", [0x9C]),
            new Sprite("Tadpoles2", [0x9D]),
            new Sprite("Ostrich", [0x9E]),
            new Sprite("Flute", [0x9F]),
            new Sprite("Bird", [0xA0]),
            new Sprite("Freezor", [0xA1]),
            new Sprite("Kholdstare", [0xA2]),
            new Sprite("KholdstareShell", [0xA3]),
            new Sprite("FallingIce", [0xA4]),
            new Sprite("ZazakFireball", [0xA5]),
            new Sprite("ZazakRed", [0xA6]),
            new Sprite("Stalfos", [0xA7]),
            new Sprite("Zirro", [0xA8]),
            new Sprite("Zirro2", [0xA9]),
            new Sprite("Pikit", [0xAA]),
            new Sprite("Maiden", [0xAB]),
            new Sprite("Apple", [0xAC]),
            new Sprite("LostOldMan", [0xAD]),
            new Sprite("PipeD", [0xAE]),
            new Sprite("PipeU", [0xAF]),
            new Sprite("PipeR", [0xB0]),
            new Sprite("PipeL", [0xB1]),
            new Sprite\Droppable("BeeGood", [0xB2]), // released bee
            new Sprite("HylianInscription", [0xB3]),
            new Sprite("PurpleChest", [0xB4]),
            new Sprite("BombSalesman", [0xB5]),
            new Sprite("Kiki", [0xB6]),
            new Sprite("BlindMaiden", [0xB7]),
            new Sprite("Monologue", [0xB8]),
            new Sprite("FeudingFriends", [0xB9]),
            new Sprite("Whirlpool", [0xBA]),
            new Sprite("Salesman", [0xBB]),
            new Sprite("Drunk", [0xBC]),
            new Sprite("Vitreous", [0xBD]),
            new Sprite("VitreousSmallEyeball", [0xBE]),
            new Sprite("VitreousLightning", [0xBF]),
            new Sprite("Catfish", [0xC0]),
            new Sprite("AgahnimTeleporting", [0xC1]),
            new Sprite("Boulders", [0xC2]),
            new Sprite("Gibo", [0xC3]),
            new Sprite("Thief", [0xC4]),
            new Sprite("Medusa", [0xC5]),
            new Sprite("YomoMedusa", [0xC6]),
            new Sprite("HokkuBokku", [0xC7]),
            new Sprite("FairyBig", [0xC8]),
            new Sprite("Tektite", [0xC9]),
            new Sprite("ChainChomp", [0xCA]),
            new Sprite("Trinexx", [0xCB]),
            new Sprite("TrinexxHeadFire", [0xCC]), // might be wrong
            new Sprite("TrinexxHeadIce", [0xCD]), // might be wrong
            new Sprite("Blind", [0xCE]),
            new Sprite("Swamola", [0xCF]),
            new Sprite("Lynel", [0xD0]),
            new Sprite("BunnyBeam", [0xD1]),
            new Sprite("FloppingFish", [0xD2]),
            new Sprite("Stal", [0xD3]),
            new Sprite("Landmine", [0xD4]),
            new Sprite("DiggingGameNPC", [0xD5]),
            new Sprite("Ganon", [0xD6]),
            new Sprite("GanonInvisible", [0xD7]),
            new Sprite\Droppable("Heart", [0xD8]),
            new Sprite\Droppable("RupeeGreen", [0xD9]),
            new Sprite\Droppable("RupeeBlue", [0xDA]),
            new Sprite\Droppable("RupeeRed", [0xDB]),
            new Sprite\Droppable("BombRefill1", [0xDC]),
            new Sprite\Droppable("BombRefill4", [0xDD]),
            new Sprite\Droppable("BombRefill8", [0xDE]),
            new Sprite\Droppable("MagicRefillSmall", [0xDF]),
            new Sprite\Droppable("MagicRefillFull", [0xE0]),
            new Sprite\Droppable("ArrowRefill5", [0xE1]),
            new Sprite\Droppable("ArrowRefill10", [0xE2]),
            new Sprite\Droppable("Fairy", [0xE3]),
            new Sprite("Key", [0xE4]),
            new Sprite("BigKey", [0xE5]),
            new Sprite("Shield", [0xE6]),
            new Sprite("Mushroom", [0xE7]),
            new Sprite("FakeMasterSword", [0xE8]),
            new Sprite("MagicShopDude", [0xE9]),
            new Sprite("HeartContainer", [0xEA]),
            new Sprite("HeartPiece", [0xEB]),
            new Sprite("Bush", [0xEC]),
            new Sprite("SomariaPlatform", [0xED]),
            new Sprite("Mantle", [0xEE]),
            new Sprite("SomariaPlatform1", [0xEF]),
            new Sprite("SomariaPlatform2", [0xF0]),
            new Sprite("SomariaPlatform3", [0xF1]),
            new Sprite("MedallionTablet", [0xF2]),
        ]);
        return static::all();
    }

    /**
     * Create a new Sprite
     *
     * @param string $name Unique name of item
     * @param array $bytes data to write to Location addresses
     * @param array|null $address Addresses in ROM to write back Location data if set
     *
     * @return void
     */
    public function __construct($name, array $bytes, array $address = null)
    {
        $this->name = $name;
        $this->nice_name = 'sprite.' . $name;
        $this->bytes = $bytes;
        $this->address = (array) $address;
    }

    /**
     * Get the name of this Sprite.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get the bytes to write
     *
     * @return array
     */
    public function getBytes()
    {
        return $this->bytes;
    }

    /**
     * Get the addresses to write to
     *
     * @return array
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * converts 4bpp 8x8 to palette reference at a given offset
     *
     * @author Zarby89
     *
     * @param array $sprite byte array of gfx data
     * @param int $pos position in stream to pull 8x8 from
     *
     * @return array
     */
    public static function load8x8(array $sprite, int $pos = 0)
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
                    $tmpbyte += 1;
                }
                if (($sprite[$pos + ($x * 2) + 1] & $positions[$y]) == $positions[$y]) {
                    $tmpbyte += 2;
                }
                if (($sprite[$pos + 16 + ($x * 2)] & $positions[$y]) == $positions[$y]) {
                    $tmpbyte += 4;
                }
                if (($sprite[$pos + 16 + ($x * 2) + 1] & $positions[$y]) == $positions[$y]) {
                    $tmpbyte += 8;
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
     *
     * @return array
     */
    public static function load16x16(array $sprite, int $pos = 0)
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

    public function dumpBinBlock(Rom $rom)
    {
        return [
            '0x6B080' => sprintf("%08b", $rom->readByte(0x6B080 + (int) $this->bytes[0])),
            '0x6B173' => sprintf("%08b", $rom->readByte(0x6B173 + (int) $this->bytes[0])),
            '0x6B266' => sprintf("%08b", $rom->readByte(0x6B266 + (int) $this->bytes[0])),
            '0x6B359' => sprintf("%08b", $rom->readByte(0x6B359 + (int) $this->bytes[0])),
            '0x6B44C' => sprintf("%08b", $rom->readByte(0x6B44C + (int) $this->bytes[0])),
            '0x6B53F' => sprintf("%08b", $rom->readByte(0x6B53F + (int) $this->bytes[0])),
            '0x6B632' => sprintf("%08b", $rom->readByte(0x6B632 + (int) $this->bytes[0])),
            '0x6B725' => sprintf("%08b", $rom->readByte(0x6B725 + (int) $this->bytes[0])),
        ];
    }

    public function readPropertiesFromRom(Rom $rom)
    {
        $bytes = [
            $rom->readByte(0x6B080 + (int) $this->bytes[0]),
            $rom->readByte(0x6B173 + (int) $this->bytes[0]),
            $rom->readByte(0x6B266 + (int) $this->bytes[0]),
            $rom->readByte(0x6B359 + (int) $this->bytes[0]),
            $rom->readByte(0x6B44C + (int) $this->bytes[0]),
            $rom->readByte(0x6B53F + (int) $this->bytes[0]),
            $rom->readByte(0x6B632 + (int) $this->bytes[0]),
            $rom->readByte(0x6B725 + (int) $this->bytes[0]),
        ];

        // these need to be bit shifted with mask, otherwise the "flag" might appear wrong
        return [
            'harmless' => $bytes[0] >> 7 & 1,
            'mastersword_ceremony' => $bytes[0] >> 6 & 1,
            'towards_walls' => $bytes[0] >> 5 & 1,
            'visibility' => $bytes[0] & 0x1F,
            'hit_points' => $bytes[1],
            'damage_type' => $bytes[2] & 0x0F,
            'unknown' => $bytes[2] >> 4,
            'death_animation_extra' => $bytes[3] >> 7 & 1,
            'invincible' => $bytes[3] >> 6 & 1,
            'width' => $bytes[3] >> 5 & 1,
            'shadow' => $bytes[3] >> 4 & 1,
            'palette' => $bytes[3] >> 1 & 0x07,
            'unknown2' => $bytes[3] & 1,
            'ignore_collision' => $bytes[4] >> 7 & 1,
            'statis' => $bytes[4] >> 6 & 1,
            'persist' => $bytes[4] >> 5 & 1,
            'hitbox' => $bytes[4] & 0x1F,
            'hitbox_interaction' => $bytes[5] >> 4,
            'deflect_arrows' => $bytes[5] >> 3 & 1,
            'unknown4' => $bytes[5] >> 2 & 1,
            'death_boss' => $bytes[5] >> 1 & 1,
            'falls_in_holes' => $bytes[5] & 1,
            'disable_interactions' => $bytes[6] >> 7 & 1,
            'water' => $bytes[6] >> 6 & 1,
            'shield_destruction' => $bytes[6] >> 5 & 1,
            'damage_sound' => $bytes[6] >> 4 & 1,
            'prize_pack' => $bytes[6] & 0x0F,
            'death_conditional' => $bytes[7] >> 7 & 1,
            'death_conditional2' => $bytes[7] >> 6 & 1,
            'unused2' => $bytes[7] >> 5 & 1,
            'deflect_missles' => $bytes[7] >> 4 & 1,
            'collide_less' => $bytes[7] >> 3 & 1,
            'impervious_sword_hammer' => $bytes[7] >> 2 & 1,
            'impervious_arrows' => $bytes[7] >> 1 & 1,
            'disabled' => $bytes[7] & 1,
        ];
    }

    /**
     * serialized version of Sprite
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name . serialize($this->bytes);
    }
}
