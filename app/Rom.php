<?php

namespace ALttP;

use ALttP\Support\Credits;
use ALttP\Support\ItemCollection;
use ALttP\Text;
use Log;

/**
 * Wrapper for ROM file
 */
class Rom
{
    const BUILD = '2019-08-26';
    const HASH = '1907d4caccffe60fc69940cfa11b2dab';
    const SIZE = 2097152;

    private $tmp_file;
    private $credits;
    private $text;
    protected $rom;
    protected $write_log = [];

    /**
     * Save a ROM build the DB for later retervial if someone is patching for an old seed.
     *
     * @param array $patch for the build
     *
     * @return Build
     */
    public static function saveBuild(array $patch, $build = null, $hash = null): Build
    {
        $build = Build::firstOrNew([
            'build' => $build ?? static::BUILD,
        ]);
        $build->hash = $hash ?? static::HASH;
        $build->patch = json_encode($patch);
        $build->save();

        return $build;
    }

    /**
     * Create a new wrapper
     *
     * @param string $source_location location of source ROM to edit
     *
     * @throws \Exception if ROM source isn't readable
     *
     * @return void
     */
    public function __construct(string $source_location = null)
    {
        if ($source_location !== null && !is_readable($source_location)) {
            throw new \Exception('Source ROM not readable');
        }
        $this->tmp_file = tempnam(sys_get_temp_dir(), __CLASS__);

        if ($this->tmp_file === false) {
            throw new \Exception('could not make temp file');
        }

        if ($source_location !== null) {
            copy($source_location, $this->tmp_file);
        }

        $this->rom = fopen($this->tmp_file, "r+");
        $this->credits = new Credits;
        $this->text = new Text;
        $this->text->removeUnwanted();
    }

    /**
     * resize ROM to a given size
     *
     * @param int|null $size number of bytes the ROM should be
     *
     * @return $this
     *
     */
    public function resize(int $size = null): self
    {
        ftruncate($this->rom, $size ?? static::SIZE);

        return $this;
    }

    /**
     * Check to see if this ROM matches base randomizer ROM.
     *
     * @return bool
     */
    public function checkMD5(): bool
    {
        return $this->getMD5() === static::HASH;
    }

    /**
     * Get MD5 of current file.
     *
     * @return string
     */
    public function getMD5(): string
    {
        return hash_file('md5', $this->tmp_file);
    }

    /**
     * Update the ROM's checksum to be proper
     *
     * @return $this
     */
    public function updateChecksum(): self
    {
        fseek($this->rom, 0x0);
        $sum = 0x1FE;
        for ($i = 0; $i < static::SIZE; $i += 1024) {
            $block = fread($this->rom, 1024);
            if ($block === false) {
                throw new \Exception('Could not read block.');
            }
            $bytes = array_values(unpack('C*', $block));
            for ($j = 0; $j < 1024; ++$j) {
                if ($j + $i >= 0x7FDC && $j + $i < 0x7FE0) {
                    // this skip is true for LoROM, HiROM skips: 0xFFDC - 0xFFDF
                    continue;
                }
                $sum += $bytes[$j];
            }
        }

        $checksum = $sum & 0xFFFF;
        $inverse = $checksum ^ 0xFFFF;

        $this->write(0x7FDC, pack('S*', $inverse, $checksum));

        return $this;
    }

    /**
     * Write subsitutions
     *
     * @param array $substitutions [[id, max, replace id, 0xFF], ...]
     *
     * @return $this
     */
    public function setSubstitutions(array $substitutions = [])
    {
        $substitutions = array_merge($substitutions, [0xFF, 0xFF, 0xFF, 0xFF]);

        $this->write(0x184000, pack('C*', ...$substitutions));

        return $this;
    }

    /**
     * set the items passed in as Link's starting equipment
     *
     * @param ItemCollection $items items to equip Link with
     *
     * @return $this
     */
    public function setStartingEquipment(ItemCollection $items)
    {
        $equipment = array_fill(0x340, 0x4F, 0);
        $starting_rupees = 0;
        $starting_arrow_capacity = 0;
        $starting_bomb_capacity = 0;
        // starting heart containers
        if ($items->heartCount(0) < 1) {
            $equipment[0x36C] = 0x18;
            $equipment[0x36D] = 0x18;
        }
        // default abilities
        $equipment[0x379] |= 0b01101000;

        foreach ($items as $item) {
            switch ($item->getTarget()->getRawName()) {
                case 'L1Sword':
                    $equipment[0x359] = 0x01;
                    break;
                case 'L1SwordAndShield':
                    $equipment[0x359] = 0x01;
                    $equipment[0x35A] = 0x01;
                    break;
                case 'L2Sword':
                case 'MasterSword':
                    $equipment[0x359] = 0x02;
                    break;
                case 'L3Sword':
                    $equipment[0x359] = 0x03;
                    break;
                case 'L4Sword':
                    $equipment[0x359] = 0x04;
                    break;
                case 'BlueShield':
                    $equipment[0x35A] = 0x01;
                    break;
                case 'RedShield':
                    $equipment[0x35A] = 0x02;
                    break;
                case 'MirrorShield':
                    $equipment[0x35A] = 0x03;
                    break;
                case 'FireRod':
                    $equipment[0x345] = 0x01;
                    break;
                case 'IceRod':
                    $equipment[0x346] = 0x01;
                    break;
                case 'Hammer':
                    $equipment[0x34B] = 0x01;
                    break;
                case 'Hookshot':
                    $equipment[0x342] = 0x01;
                    break;
                case 'Bow':
                    $equipment[0x340] = 0x01;
                    if ($this->readByte(0x180175) !== 0x01) {
                        $equipment[0x38E] |= 0b10000000;
                    }
                    break;
                case 'BowAndArrows':
                    $equipment[0x340] = 0x02;
                    $equipment[0x38E] |= 0b10000000;
                    if ($this->readByte(0x180175) === 0x01) {
                        $equipment[0x377] = 0x01;
                    }
                    break;
                case 'SilverArrowUpgrade':
                    $equipment[0x38E] |= 0b01000000;
                    if ($this->readByte(0x180175) === 0x01) {
                        $equipment[0x377] = 0x01;
                    }
                    break;
                case 'BowAndSilverArrows':
                    $equipment[0x340] = 0x04;
                    $equipment[0x38E] |= 0b01000000;
                    if ($this->readByte(0x180175) === 0x01) {
                        $equipment[0x377] = 0x01;
                    } else {
                        $equipment[0x38E] |= 0b10000000;
                    }
                    break;
                case 'Progressivebow':
                    min($equipment[0x340] + 2, 4);
                    if ($this->readByte(0x180175) === 0x01) {
                        $equipment[0x377] = 0x01;
                    }
                    // @todo figure out 0x38E
                    break;
                case 'Boomerang':
                    $equipment[0x341] = 0x01;
                    $equipment[0x38C] |= 0b10000000;
                    break;
                case 'RedBoomerang':
                    $equipment[0x341] = 0x02;
                    $equipment[0x38C] |= 0b01000000;
                    break;
                case 'Mushroom':
                    $equipment[0x344] = 0x01;
                    $equipment[0x38C] |= 0b00101000;
                    break;
                case 'Powder':
                    $equipment[0x344] = 0x02;
                    $equipment[0x38C] |= 0b00010000;
                    break;
                case 'Bombos':
                    $equipment[0x347] = 0x01;
                    break;
                case 'Ether':
                    $equipment[0x348] = 0x01;
                    break;
                case 'Quake':
                    $equipment[0x349] = 0x01;
                    break;
                case 'Lamp':
                    $equipment[0x34A] = 0x01;
                    break;
                case 'Shovel':
                    $equipment[0x34C] = 0x01;
                    $equipment[0x38C] |= 0b00000100;
                    break;
                case 'OcarinaInactive':
                    $equipment[0x34C] = 0x02;
                    $equipment[0x38C] |= 0b00000010;
                    break;
                case 'OcarinaActive':
                    $equipment[0x34C] = 0x03;
                    $equipment[0x38C] |= 0b00000001;
                    break;
                case 'CaneOfSomaria':
                    $equipment[0x350] = 0x01;
                    break;
                case 'Bottle':
                    if ($equipment[0x34F] < 4) {
                        $equipment[0x35C + $equipment[0x34F]] = 0x02;
                        $equipment[0x34F] += 1;
                    }
                    break;
                case 'BottleWithRedPotion':
                    if ($equipment[0x34F] < 4) {
                        $equipment[0x35C + $equipment[0x34F]] = 0x03;
                        $equipment[0x34F] += 1;
                    }
                    break;
                case 'BottleWithGreenPotion':
                    if ($equipment[0x34F] < 4) {
                        $equipment[0x35C + $equipment[0x34F]] = 0x04;
                        $equipment[0x34F] += 1;
                    }
                    break;
                case 'BottleWithBluePotion':
                    if ($equipment[0x34F] < 4) {
                        $equipment[0x35C + $equipment[0x34F]] = 0x05;
                        $equipment[0x34F] += 1;
                    }
                    break;
                case 'BottleWithBee':
                    if ($equipment[0x34F] < 4) {
                        $equipment[0x35C + $equipment[0x34F]] = 0x07;
                        $equipment[0x34F] += 1;
                    }
                    break;
                case 'BottleWithFairy':
                    if ($equipment[0x34F] < 4) {
                        $equipment[0x35C + $equipment[0x34F]] = 0x06;
                        $equipment[0x34F] += 1;
                    }
                    break;
                case 'BottleWithGoldBee':
                    if ($equipment[0x34F] < 4) {
                        $equipment[0x35C + $equipment[0x34F]] = 0x08;
                        $equipment[0x34F] += 1;
                    }
                    break;
                case 'CaneOfByrna':
                    $equipment[0x351] = 0x01;
                    break;
                case 'Cape':
                    $equipment[0x352] = 0x01;
                    break;
                case 'MagicMirror':
                    $equipment[0x353] = 0x02;
                    break;
                case 'PowerGlove':
                    $equipment[0x354] = 0x01;
                    break;
                case 'TitansMitt':
                    $equipment[0x354] = 0x02;
                    break;
                case 'BookOfMudora':
                    $equipment[0x34E] = 0x01;
                    break;
                case 'Flippers':
                    $equipment[0x356] = 0x01;
                    $equipment[0x379] |= 0b00000010;
                    break;
                case 'MoonPearl':
                    $equipment[0x357] = 0x01;
                    break;
                case 'BugCatchingNet':
                    $equipment[0x34D] = 0x01;
                    break;
                case 'BlueMail':
                    $equipment[0x35B] = 0x01;
                    break;
                case 'RedMail':
                    $equipment[0x35B] = 0x02;
                    break;
                case 'Bomb':
                    $equipment[0x343] = min($equipment[0x343] + 1, 99);
                    break;
                case 'ThreeBombs':
                    $equipment[0x343] = min($equipment[0x343] + 3, 99);
                    break;
                case 'TenBombs':
                    $equipment[0x343] = min($equipment[0x343] + 10, 99);
                    break;
                case 'OneRupee':
                    $starting_rupees += 1;
                    break;
                case 'FiveRupees':
                    $starting_rupees += 5;
                    break;
                case 'TwentyRupees':
                case 'TwentyRupees2':
                    $starting_rupees += 20;
                    break;
                case 'FiftyRupees':
                    $starting_rupees += 50;
                    break;
                case 'OneHundredRupees':
                    $starting_rupees += 100;
                    break;
                case 'PendantOfCourage':
                    $equipment[0x374] |= 0b00000100;
                    break;
                case 'PendantOfWisdom':
                    $equipment[0x374] |= 0b00000001;
                    break;
                case 'PendantOfPower':
                    $equipment[0x374] |= 0b00000010;
                    break;
                case 'HeartContainerNoAnimation':
                case 'BossHeartContainer':
                case 'HeartContainer':
                    $equipment[0x36C] = min($equipment[0x36C] + 0x08, 0xA0);
                    $equipment[0x36D] = min($equipment[0x36D] + 0x08, 0xA0);
                    break;
                case 'PieceOfHeart':
                    $equipment[0x36B] += 1;
                    if ($equipment[0x36B] >= 4) {
                        $equipment[0x36C] = min($equipment[0x36C] + (0x08 * floor($equipment[0x36B] / 4)), 0xA0);
                        $equipment[0x36B] %= 4;
                    }
                    break;
                case 'Heart':
                    $equipment[0x36D] = min($equipment[0x36D] + 0x08, 0xA0);
                    break;
                case 'Arrow':
                    $equipment[0x377] = min($equipment[0x377] + 1, 99);
                    break;
                case 'TenArrows':
                    $equipment[0x377] = min($equipment[0x377] + 10, 99);
                    break;
                case 'SmallMagic':
                    $equipment[0x36E] = min($equipment[0x36E] + 0x10, 0x80);
                    break;
                case 'ThreeHundredRupees':
                    $starting_rupees += 300;
                    break;
                case 'PegasusBoots':
                    $equipment[0x355] = 0x01;
                    $equipment[0x379] |= 0b00000100;
                    break;
                case 'BombUpgrade5':
                    $starting_bomb_capacity += 5;
                    break;
                case 'BombUpgrade10':
                    $starting_bomb_capacity += 10;
                    break;
                case 'ArrowUpgrade5':
                    $starting_arrow_capacity += 5;
                    break;
                case 'ArrowUpgrade10':
                    $starting_arrow_capacity += 10;
                    break;
                case 'HalfMagic':
                    $equipment[0x37B] = 0x01;
                    break;
                case 'QuarterMagic':
                    $equipment[0x37B] = 0x02;
                    break;
                case 'ProgressiveSword':
                    $equipment[0x359] = min($equipment[0x359] + 1, 4);
                    break;
                case 'ProgressiveShield':
                    $equipment[0x35A] = min($equipment[0x35A] + 1, 3);
                    break;
                case 'ProgressiveArmor':
                    $equipment[0x35B] = min($equipment[0x35B] + 1, 2);
                    break;
                case 'ProgressiveGlove':
                    $equipment[0x354] = min($equipment[0x354] + 1, 2);
                    break;
                case 'MapLW':
                    $equipment[0x368] |= 0b00000001;
                    break;
                case 'MapDW':
                    $equipment[0x368] |= 0b00000010;
                    break;
                case 'MapA2':
                    $equipment[0x368] |= 0b00000100;
                    break;
                case 'MapD7':
                    $equipment[0x368] |= 0b00001000;
                    break;
                case 'MapD4':
                    $equipment[0x368] |= 0b00010000;
                    break;
                case 'MapP3':
                    $equipment[0x368] |= 0b00100000;
                    break;
                case 'MapD5':
                    $equipment[0x368] |= 0b01000000;
                    break;
                case 'MapD3':
                    $equipment[0x368] |= 0b10000000;
                    break;
                case 'MapD6':
                    $equipment[0x369] |= 0b00000001;
                    break;
                case 'MapD1':
                    $equipment[0x369] |= 0b00000010;
                    break;
                case 'MapD2':
                    $equipment[0x369] |= 0b00000100;
                    break;
                case 'MapA1':
                    $equipment[0x369] |= 0b00001000;
                    break;
                case 'MapP2':
                    $equipment[0x369] |= 0b00010000;
                    break;
                case 'MapP1':
                    $equipment[0x369] |= 0b00100000;
                    break;
                case 'MapH1':
                    $equipment[0x369] |= 0b01000000;
                    break;
                case 'MapH2':
                    $equipment[0x369] |= 0b10000000;
                    break;
                case 'CompassA2':
                    $equipment[0x364] |= 0b00000100;
                    break;
                case 'CompassD7':
                    $equipment[0x364] |= 0b00001000;
                    break;
                case 'CompassD4':
                    $equipment[0x364] |= 0b00010000;
                    break;
                case 'CompassP3':
                    $equipment[0x364] |= 0b00100000;
                    break;
                case 'CompassD5':
                    $equipment[0x364] |= 0b01000000;
                    break;
                case 'CompassD3':
                    $equipment[0x364] |= 0b10000000;
                    break;
                case 'CompassD6':
                    $equipment[0x365] |= 0b00000001;
                    break;
                case 'CompassD1':
                    $equipment[0x365] |= 0b00000010;
                    break;
                case 'CompassD2':
                    $equipment[0x365] |= 0b00000100;
                    break;
                case 'CompassA1':
                    $equipment[0x365] |= 0b00001000;
                    break;
                case 'CompassP2':
                    $equipment[0x365] |= 0b00010000;
                    break;
                case 'CompassP1':
                    $equipment[0x365] |= 0b00100000;
                    break;
                case 'CompassH1':
                    $equipment[0x365] |= 0b01000000;
                    break;
                case 'CompassH2':
                    $equipment[0x365] |= 0b10000000;
                    break;
                case 'BigKeyA2':
                    $equipment[0x366] |= 0b00000100;
                    break;
                case 'BigKeyD7':
                    $equipment[0x366] |= 0b00001000;
                    break;
                case 'BigKeyD4':
                    $equipment[0x366] |= 0b00010000;
                    break;
                case 'BigKeyP3':
                    $equipment[0x366] |= 0b00100000;
                    break;
                case 'BigKeyD5':
                    $equipment[0x366] |= 0b01000000;
                    break;
                case 'BigKeyD3':
                    $equipment[0x366] |= 0b10000000;
                    break;
                case 'BigKeyD6':
                    $equipment[0x367] |= 0b00000001;
                    break;
                case 'BigKeyD1':
                    $equipment[0x367] |= 0b00000010;
                    break;
                case 'BigKeyD2':
                    $equipment[0x367] |= 0b00000100;
                    break;
                case 'BigKeyA1':
                    $equipment[0x367] |= 0b00001000;
                    break;
                case 'BigKeyP2':
                    $equipment[0x367] |= 0b00010000;
                    break;
                case 'BigKeyP1':
                    $equipment[0x367] |= 0b00100000;
                    break;
                case 'BigKeyH1':
                    $equipment[0x367] |= 0b01000000;
                    break;
                case 'BigKeyH2':
                    $equipment[0x367] |= 0b10000000;
                    break;
                case 'KeyH2':
                    $equipment[0x37C] += 1;
                    break;
                case 'KeyH1':
                    $equipment[0x37D] += 1;
                    break;
                case 'KeyP1':
                    $equipment[0x37E] += 1;
                    break;
                case 'KeyP2':
                    $equipment[0x37F] += 1;
                    break;
                case 'KeyA1':
                    $equipment[0x380] += 1;
                    break;
                case 'KeyD2':
                    $equipment[0x381] += 1;
                    break;
                case 'KeyD1':
                    $equipment[0x382] += 1;
                    break;
                case 'KeyD6':
                    $equipment[0x383] += 1;
                    break;
                case 'KeyD3':
                    $equipment[0x384] += 1;
                    break;
                case 'KeyD5':
                    $equipment[0x385] += 1;
                    break;
                case 'KeyP3':
                    $equipment[0x386] += 1;
                    break;
                case 'KeyD4':
                    $equipment[0x387] += 1;
                    break;
                case 'KeyD7':
                    $equipment[0x388] += 1;
                    break;
                case 'KeyA2':
                    $equipment[0x389] += 1;
                    break;
                case 'Crystal1':
                    $equipment[0x37A] |= 0b00000010;
                    break;
                case 'Crystal2':
                    $equipment[0x37A] |= 0b00010000;
                    break;
                case 'Crystal3':
                    $equipment[0x37A] |= 0b01000000;
                    break;
                case 'Crystal4':
                    $equipment[0x37A] |= 0b00100000;
                    break;
                case 'Crystal5':
                    $equipment[0x37A] |= 0b00000100;
                    break;
                case 'Crystal6':
                    $equipment[0x37A] |= 0b00000001;
                    break;
                case 'Crystal7':
                    $equipment[0x37A] |= 0b00001000;
                    break;
            }
        }

        $equipment[0x362] = $equipment[0x360] = $starting_rupees & 0xFF;
        $equipment[0x363] = $equipment[0x361] = $starting_rupees >> 8;

        $this->write(0x183000, pack('C*', ...$equipment));
        // For file select screen
        $this->write(0x271A6, pack('C*', ...array_slice($equipment, 0, 60)));
        $this->setMaxArrows($starting_arrow_capacity);
        $this->setMaxBombs($starting_bomb_capacity);

        // not swordless mode and setting a sword
        if ($this->readByte(0x180043) !== 0xFF && $equipment[0x359]) {
            // write starting sword
            $this->write(0x180043, pack('C*', $equipment[0x359]));
        }

        return $this;
    }

    /**
     * Set the Low Health Beep Speed
     *
     * @param string $setting name (0x00: off, 0x20: normal, 0x40: half, 0x80: quarter)
     *
     * @return $this
     */
    public function setHeartBeepSpeed(string $setting): self
    {
        switch ($setting) {
            case 'off':
                $byte = 0x00;
                break;
            case 'half':
                $byte = 0x40;
                break;
            case 'quarter':
                $byte = 0x80;
                break;
            case 'double':
                $byte = 0x10;
                break;
            case 'normal':
            default:
                $byte = 0x20;
        }

        $this->write(0x180033, pack('C', $byte));

        return $this;
    }

    /**
     * Set the Rupoor value to take rupees
     *
     * @param int $value
     *
     * @return $this
     */
    public function setRupoorValue(int $value = 10): self
    {
        $this->write(0x180036, pack('v*', $value));

        return $this;
    }

    /**
     * Set Cane of Byrna Cave spike floor damage
     *
     * @param int $dmg_value (0x08: 1 Heart, 0x02: 1/4 Heart)
     *
     * @return $this
     */
    public function setByrnaCaveSpikeDamage(int $dmg_value = 0x08): self
    {
        $this->write(0x180168, pack('C*', $dmg_value));

        return $this;
    }

    /**
     * Set Cane of Byrna Cave and Misery Mire spike room Byrna usage
     *
     * @param int $normal normal magic usage
     * @param int $half half magic usage
     * @param int $quarter quarter magic usage
     *
     * @return $this
     */
    public function setCaneOfByrnaSpikeCaveUsage(int $normal = 0x04, int $half = 0x02, int $quarter = 0x01): self
    {
        $this->write(0x18016B, pack('C*', $normal, $half, $quarter));

        return $this;
    }

    /**
     * Enable Byrna's ability to make you Invulnerable
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setCaneOfByrnaInvulnerability(bool $enable = true): self
    {
        $this->write(0x18004F, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Set Cane of Byrna Cave and Misery Mire spike room Cape usage
     *
     * @param int $normal normal magic usage
     * @param int $half half magic usage
     * @param int $quarter quarter magic usage
     *
     * @return $this
     */
    public function setCapeSpikeCaveUsage(int $normal = 0x04, int $half = 0x08, int $quarter = 0x10): self
    {
        $this->write(0x18016E, pack('C*', $normal, $half, $quarter));

        return $this;
    }

    /**
     * Set mode for HUD clock
     *
     * @param string $mode off|stopwatch|countdown-stop|countdown-continue
     * @param bool $restart wether to restart the timer
     *
     * @return $this;
     */
    public function setClockMode(string $mode = 'off', bool $restart = false): self
    {
        $compass_override = true;
        switch ($mode) {
            case 'stopwatch':
                $bytes = [0x02, 0x01];
                break;
            case 'countdown-ohko':
                $bytes = [0x01, 0x02];
                $restart = true;
                break;
            case 'countdown-continue':
                $bytes = [0x01, 0x01];
                break;
            case 'countdown-stop':
                $bytes = [0x01, 0x00];
                break;
            case 'countdown-end':
                $bytes = [0x01, 0x03];
                $restart = false;
                break;
            case 'off':
            default:
                $bytes = [0x00, 0x00];
                $compass_override = false;
                break;
        }

        // @TODO: temporarly disable compass mode while this is enabled since they occupy the same region of the hud.
        if ($compass_override) {
            $this->setCompassMode('off');
        }

        $bytes = array_merge($bytes, [$restart ? 0x01 : 0x00]);

        $this->write(0x180190, pack('C*', ...$bytes));

        return $this;
    }

    /**
     * Enable triforce-hunt turn in mode.
     *
     * @param bool  $enable  enable or disable turn in mode.
     *
     * @return void
     */
    public function enableTriforceTurnIn(bool $enable = true): void
    {
        $this->write(0x180194, pack('C', $enable ? 0x01 : 0x00));
    }

    /**
     * Set starting time for HUD clock.
     *
     * @param int $seconds time in seconds
     *
     * @return $this;
     */
    public function setStartingTime(int $seconds = 0): self
    {
        $this->write(0x18020C, pack('l*', $seconds * 60));

        return $this;
    }

    /**
     * Set time adjustment for collecting Red Clock Item
     *
     * @param int $seconds time in seconds
     *
     * @return $this;
     */
    public function setRedClock(int $seconds = 0): self
    {
        $this->write(0x180200, pack('l*', $seconds * 60));

        return $this;
    }

    /**
     * Set time adjustment for collecting Blue Clock Item
     *
     * @param int $seconds time in seconds
     *
     * @return $this;
     */
    public function setBlueClock(int $seconds = 0): self
    {
        $this->write(0x180204, pack('l*', $seconds * 60));

        return $this;
    }

    /**
     * Set time adjustment for collecting Green Clock Item
     *
     * @param int $seconds time in seconds
     *
     * @return $this;
     */
    public function setGreenClock(int $seconds = 0): self
    {
        $this->write(0x180208, pack('l*', $seconds * 60));

        return $this;
    }

    /**
     * Set the starting Max Arrows
     *
     * @param int $max
     *
     * @return $this
     */
    public function setMaxArrows(int $max = 30): self
    {
        $this->write(0x180035, pack('C', $max));

        return $this;
    }

    /**
     * Set the Digging Game Rng
     *
     * @param int $digs
     *
     * @return $this
     */
    public function setDiggingGameRng(int $digs = 15): self
    {
        $this->write(0x180020, pack('C', $digs));
        $this->write(0xEFD95, pack('C', $digs));

        return $this;
    }

    /**
     * Set the starting Max Bombs
     *
     * @param int $max
     *
     * @return $this
     */
    public function setMaxBombs(int $max = 10): self
    {
        $this->write(0x180034, pack('C', $max));

        return $this;
    }

    /**
     * Set values to fill for Capacity Upgrades
     * currently only 4 things: Bomb5, Bomb10, Arrow5, Arrow10
     *
     * @param array $fills array of values to fill in
     *
     * @return $this
     */
    public function setCapacityUpgradeFills(array $fills): self
    {
        $this->write(0x180080, pack('C*', ...array_slice($fills, 0, 4)));

        return $this;
    }

    /**
     * Set values to fill for Health/Magic fills from Bottles
     * currently only 2 things: Health, Magic
     *
     * @param array $fills array of values to fill in [health (0xA0 default), magic (0x80 default)]
     *
     * @return $this
     */
    public function setBottleFills(array $fills): self
    {
        $this->write(0x180084, pack('C*', ...array_slice($fills, 0, 2)));

        return $this;
    }

    /**
     * Set the number of goal items to collect
     *
     * @param int $goal
     *
     * @return $this
     */
    public function setGoalRequiredCount(int $goal = 0): self
    {
        $this->write(0x180167, pack('C', $goal));

        return $this;
    }

    /**
     * Set the goal item icon
     *
     * @param string $goal_icon
     *
     * @return $this
     */
    public function setGoalIcon(string $goal_icon = 'triforce'): self
    {
        switch ($goal_icon) {
            case 'triforce':
                $byte = pack('S*', 0x280E);
                break;
            case 'star':
            default:
                $byte = pack('S*', 0x280D);
                break;
        }
        $this->write(0x180165, $byte);

        return $this;
    }

    /**
     * Set Progressive Sword limit and item after limit is reached
     *
     * @param int $limit max number to receive
     * @param int $item item byte to collect once limit is collected
     *
     * @return $this
     */
    public function setLimitProgressiveSword(int $limit = 4, int $item = 0x36): self
    {
        $this->write(0x180090, pack('C*', $limit, $item));

        return $this;
    }

    /**
     * Set Progressive Shield limit and item after limit is reached
     *
     * @param int $limit max number to receive
     * @param int $item item byte to collect once limit is collected
     *
     * @return $this
     */
    public function setLimitProgressiveShield(int $limit = 3, int $item = 0x36): self
    {
        $this->write(0x180092, pack('C*', $limit, $item));

        return $this;
    }

    /**
     * Set Progressive Armor limit and item after limit is reached
     *
     * @param int $limit max number to receive
     * @param int $item item byte to collect once limit is collected
     *
     * @return $this
     */
    public function setLimitProgressiveArmor(int $limit = 2, int $item = 0x36): self
    {
        $this->write(0x180094, pack('C*', $limit, $item));

        return $this;
    }

    /**
     * Set Bottle limit and item after limit is reached
     *
     * @param int $limit max number to receive
     * @param int $item item byte to collect once limit is collected
     *
     * @return $this
     */
    public function setLimitBottle(int $limit = 4, int $item = 0x36): self
    {
        $this->write(0x180096, pack('C*', $limit, $item));

        return $this;
    }

    /**
     * Set Progressive Bow limit and item after limit is reached
     *
     * @param int $limit max number to receive
     * @param int $item item byte to collect once limit is collected
     *
     * @return $this
     */
    public function setLimitProgressiveBow(int $limit = 2, int $item = 0x36): self
    {
        $this->write(0x180098, pack('C*', $limit, $item));

        return $this;
    }

    /**
     * Set Ganon to Invincible. 'dungeons' will require all dungeon bosses are dead to be able to damage Ganon.
     *
     * @param string $setting
     *
     * @return $this
     */
    public function setGanonInvincible(string $setting = 'no'): self
    {
        switch ($setting) {
            case 'crystals':
                $byte = pack('C*', 0x03);
                break;
            case 'dungeons':
                $byte = pack('C*', 0x02);
                break;
            case 'yes':
                $byte = pack('C*', 0x01);
                break;
            case 'custom':
                $byte = pack('C', 0x04);
                break;
            case 'no':
            default:
                $byte = pack('C*', 0x00);
                break;
        }
        $this->write(0x18003E, $byte);

        return $this;
    }

    /**
     * Set hearts color for low vision people
     *
     * @param string $color color to have HUD hearts
     *
     * @return $this
     */
    public function setHeartColors(string $color): self
    {
        switch ($color) {
            case 'blue':
                $byte = 0x2C;
                $file_byte = 0x0D;
                break;
            case 'green':
                $byte = 0x3C;
                $file_byte = 0x19;
                break;
            case 'yellow':
                $byte = 0x28;
                $file_byte = 0x09;
                break;
            case 'red':
            default:
                $byte = 0x24;
                $file_byte = 0x05;
        }
        $this->write(0x6FA1E, pack('C*', $byte));
        $this->write(0x6FA20, pack('C*', $byte));
        $this->write(0x6FA22, pack('C*', $byte));
        $this->write(0x6FA24, pack('C*', $byte));
        $this->write(0x6FA26, pack('C*', $byte));
        $this->write(0x6FA28, pack('C*', $byte));
        $this->write(0x6FA2A, pack('C*', $byte));
        $this->write(0x6FA2C, pack('C*', $byte));
        $this->write(0x6FA2E, pack('C*', $byte));
        $this->write(0x6FA30, pack('C*', $byte));

        $this->write(0x65561, pack('C*', $file_byte));

        return $this;
    }

    /**
     * Set the specified text to a custom value
     *
     * @param string $key which text to set
     * @param string $string text to display
     *
     * @return $this
     */
    public function setText(string $key, string $string, ...$flags): self
    {
        $this->text->setString($key, $string, ...$flags);

        return $this;
    }

    /**
     * Commit the text table to rom
     *
     * @return $this
     */
    public function writeText(): self
    {
        $this->write(0xE0000, pack('C*', ...$this->text->getByteArray()));
        return $this;
    }

    /**
     * Set the specified credits line to a custom value
     *
     * @param string $key    which credit to set
     * @param string $string text to display
     *
     * @return $this
     */
    public function setCredit(string $key, string $string, ...$flags): self
    {
        $this->credits->updateCreditLine($key, 0, $string);

        return $this;
    }

    /**
     * Write the credits sequnce
     *
     * @return $this
     */
    public function writeCredits(): self
    {
        $data = $this->credits->getBinaryData();

        $this->write(0x181500, pack('C*', ...$data['data']));
        $this->write(0x76CC0, pack('S*', ...$data['pointers']));

        return $this;
    }

    /**
     * Set Menu Speed
     *
     * @param string $menu_speed speed at which the menu enters the screen
     *
     * @return $this
     */
    public function setMenuSpeed($menu_speed = 'normal'): self
    {
        $fast = false;
        switch ($menu_speed) {
            case 'instant':
                $speed = pack('C*', 0xE8);
                $fast = true;
                break;
            case 'fast':
                $speed = pack('C*', 0x10);
                break;
            case 'normal':
            default:
                $speed = pack('C*', 0x08);
                break;
            case 'slow':
                $speed = pack('C*', 0x04);
                break;
        }
        $this->write(0x180048, $speed);
        $this->write(0x6DD9A, pack('C*', $fast ? 0x20 : 0x11));
        $this->write(0x6DF2A, pack('C*', $fast ? 0x20 : 0x12));
        $this->write(0x6E0E9, pack('C*', $fast ? 0x20 : 0x12));

        return $this;
    }

    /**
     * Enable/Disable the Quickswap function
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setQuickSwap($enable = false): self
    {
        $this->write(0x18004B, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable the Smithy Full Travel function
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setSmithyFreeTravel($enable = false): self
    {
        $this->write(0x18004C, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Set Programmable 1 item.
     *
     * @return $this
     */
    public function setProgrammable1(string $custom): self
    {
        switch ($custom) {
            case 'bees':
                $this->write(0x1D8000, pack(
                    'C*',
                    0xA9,
                    0x79,
                    0x22,
                    0x5D,
                    0xF6,
                    0x1D,
                    0x30,
                    0x14,
                    0xA5,
                    0x22,
                    0x99,
                    0x10,
                    0x0D,
                    0xA5,
                    0x23,
                    0x99,
                    0x30,
                    0x0D,
                    0xA5,
                    0x20,
                    0x99,
                    0x00,
                    0x0D,
                    0xA5,
                    0x21,
                    0x99,
                    0x20,
                    0x0D,
                    0x6B
                ));
                $this->write(0x180061, pack('C*', 0x00, 0x80, 0x3B));

                break;
        }

        return $this;
    }

    /**
     * Set the Seed Type
     *
     * @param string $setting name
     *
     * @return $this
     */
    public function setRandomizerSeedType(string $setting): self
    {
        switch ($setting) {
            case 'OverworldGlitches':
                $byte = 0x02;
                break;
            case 'MajorGlitches':
                $byte = 0x01;
                break;
            case 'off':
                $byte = 0xFF;
                break;
            case 'NoGlitches':
            default:
                $byte = 0x00;
        }

        $this->write(0x180210, pack('C', $byte));

        return $this;
    }

    /**
     * Set the Game Type
     *
     * @param string $setting name
     *
     * @return $this
     */
    public function setGameType(string $setting): self
    {
        switch ($setting) {
            case 'enemizer':
                $byte = 0b00000101;

                break;
            case 'entrance':
                $byte = 0b00000110;

                break;
            case 'room':
                $byte = 0b00001000;

                break;
            case 'item':
            default:
                $byte = 0b00000100;
        }

        $this->write(0x180211, pack('C', $byte));

        return $this;
    }

    /**
     * Set the Plandomizer Author
     *
     * @param string $name name of author
     *
     * @return $this
     */
    public function setPlandomizerAuthor(string $name): self
    {
        $this->write(0x180220, substr($name, 0, 31));

        return $this;
    }

    /**
     * Set the Tournament Type
     *
     * @param string $setting name
     *
     * @return $this
     */
    public function setTournamentType(string $setting): self
    {
        switch ($setting) {
            case 'standard':
                $bytes = [0x01, 0x00];

                break;
            case 'none':
            default:
                $bytes = [0x00, 0x01];
        }

        $this->write(0x180213, pack('C*', ...$bytes));

        return $this;
    }

    /**
     * Set the Hash on the Start Screen
     *
     * @param array $bytes 5 bytes that will appear on the start screen for verification
     *
     * @return $this
     */
    public function setStartScreenHash(array $bytes): self
    {
        $this->write(0x180215, pack('C*', ...array_pad(array_slice($bytes, 0, 5), 5, 0x00)));

        return $this;
    }

    /**
     * Removes Shield from Uncle by moving the tiles for shield to his head and replaces them with his head.
     *
     * @return $this
     */
    public function removeUnclesShield(): self
    {
        $this->write(0x6D253, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
        $this->write(0x6D25B, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
        $this->write(0x6D283, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
        $this->write(0x6D28B, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x00, 0x0E));
        $this->write(0x6D2CB, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x02, 0x0E));
        $this->write(0x6D2FB, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x02, 0x0E));
        $this->write(0x6D313, pack('C*', 0x00, 0x00, 0xe4, 0xff, 0x08, 0x0E));

        return $this;
    }

    /**
     * Removes Sword from Uncle by moving the tiles for sword to his head and replaces them with his head.
     *
     * @return $this
     */
    public function removeUnclesSword(): self
    {
        $this->write(0x6D263, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
        $this->write(0x6D26B, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
        $this->write(0x6D293, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
        $this->write(0x6D29B, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x00, 0x0E));
        $this->write(0x6D2B3, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x02, 0x0E));
        $this->write(0x6D2BB, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x02, 0x0E));
        $this->write(0x6D2E3, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x02, 0x0E));
        $this->write(0x6D2EB, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x02, 0x0E));
        $this->write(0x6D31B, pack('C*', 0x00, 0x00, 0xe4, 0xff, 0x08, 0x0E));
        $this->write(0x6D323, pack('C*', 0x00, 0x00, 0xe4, 0xff, 0x08, 0x0E));

        return $this;
    }

    /**
     * Set the sprite that spawns when a stunned Enemy is killed
     *
     * @param int $sprite id of sprite to drop (0xD9 green rupee)
     *
     * @return $this
     */
    public function setStunnedSpritePrize(int $sprite = 0xD9): self
    {
        $this->write(0x37993, pack('C*', $sprite));

        return $this;
    }

    /**
     * Set the sprite that spawns when powdered sprite that usually spawns a faerie is powdered.
     *
     * @param int $sprite id of sprite to drop
     *
     * @return $this
     */
    public function setPowderedSpriteFairyPrize(int $sprite = 0xE3): self
    {
        $this->write(0x36DD0, pack('C*', $sprite));

        return $this;
    }

    /**
     * Set pull tree prizes
     *
     * @param int $low id of sprite to drop (0xD9 green rupee)
     * @param int $mid id of sprite to drop (0xDA blue rupee)
     * @param int $high id of sprite to drop (0xDB red rupee)
     *
     * @return $this
     */
    public function setPullTreePrizes(int $low = 0xD9, int $mid = 0xDA, int $high = 0xDB): self
    {
        $this->write(0xEFBD4, pack('C*', $low, $mid, $high));

        return $this;
    }


    /**
     * Set rupee crab, first and final prizes
     *
     * @param int $main id of sprite to drop (0xD9 green rupee)
     * @param int $final id of sprite to drop (0xDB red rupee)
     *
     * @return $this
     */
    public function setRupeeCrabPrizes(int $main = 0xD9, int $final = 0xDB): self
    {
        $this->write(0x329C8, pack('C*', $main));
        $this->write(0x329C4, pack('C*', $final));

        return $this;
    }

    /**
     * Set fish save prize
     *
     * @param int $prize id of sprite to drop (0xDB red rupee)
     *
     * @return $this
     */
    public function setFishSavePrize(int $prize = 0xDB): self
    {
        $this->write(0xE82CC, pack('C*', $prize));

        return $this;
    }

    /**
     * Set Overworld bonk prizes
     *
     * @param array $prizes ids of sprites to drop (0x03 empty)
     *
     * @return $this
     */
    public function setOverworldBonkPrizes(array $prizes = []): self
    {
        $addresses = [
            0x4CF6C, 0x4CFBA, 0x4CFE0, 0x4CFFB, 0x4D018, 0x4D01B, 0x4D028, 0x4D03C,
            0x4D059, 0x4D07A, 0x4D09E, 0x4D0A8, 0x4D0AB, 0x4D0AE, 0x4D0BE, 0x4D0DD,
            0x4D16A, 0x4D1E5, 0x4D1EE, 0x4D20B, 0x4CBBF, 0x4CBBF, 0x4CC17, 0x4CC1A,
            0x4CC4A, 0x4CC4D, 0x4CC53, 0x4CC69, 0x4CC6F, 0x4CC7C, 0x4CCEF, 0x4CD51,
            0x4CDC0, 0x4CDC3, 0x4CDC6, 0x4CE37, 0x4D2DE, 0x4D32F, 0x4D355, 0x4D367,
            0x4D384, 0x4D387, 0x4D397, 0x4D39E, 0x4D3AB, 0x4D3AE, 0x4D3D1, 0x4D3D7,
            0x4D3F8, 0x4D416, 0x4D420, 0x4D423, 0x4D42D, 0x4D449, 0x4D48C, 0x4D4D9,
            0x4D4DC, 0x4D4E3, 0x4D504, 0x4D507, 0x4D55E, 0x4D56A,
        ];

        foreach ($addresses as $address) {
            $item = array_pop($prizes);
            $this->write($address, pack('C*', $item ?? 0x03));
        }

        return $this;
    }

    /**
     * Set Overworld dig prizes.
     *
     * @todo this should really truncate the data to not overwrite past the table!
     *
     * @param array $prizes ids of sprites to dig up
     *
     * @return $this
     */
    public function setOverworldDigPrizes(array $prizes = []): self
    {
        $this->write(0x180100, pack('C*', ...$prizes));

        return $this;
    }

    /**
     * Adjust some settings for hard mode
     *
     * @param int $level how hard to make it, higher should be harder
     *
     * @throws \Exception if an unknown hard mode is selected
     *
     * @return $this
     */
    public function setHardMode(int $level = 0): self
    {
        $this->setCaneOfByrnaSpikeCaveUsage();
        $this->setCapeSpikeCaveUsage();
        $this->setByrnaCaveSpikeDamage(0x08);
        // Bryna magic amount used per "cycle"
        $this->write(0x45C42, pack('C*', 0x04, 0x02, 0x01));

        switch ($level) {
            case -1:
            case 0:
                // Cape magic
                $this->write(0x3ADA7, pack('C*', 0x04, 0x08, 0x10));
                $this->setCaneOfByrnaInvulnerability(true);
                $this->setPowderedSpriteFairyPrize(0xE3);
                $this->setBottleFills([0xA0, 0x80]);
                $this->setCatchableFairies(true);
                $this->setCatchableBees(true);
                $this->setStunItems(0x03);
                $this->setSilversOnlyAtGanon(false);

                break;
            case 1:
                $this->write(0x3ADA7, pack('C*', 0x02, 0x04, 0x08));
                $this->setCaneOfByrnaInvulnerability(false);
                $this->setPowderedSpriteFairyPrize(0xD8); // 1 heart
                $this->setBottleFills([0x38, 0x40]); // 7 hearts, 1/2 magic refills
                $this->setCatchableFairies(false);
                $this->setCatchableBees(true);
                $this->setStunItems(0x02);
                $this->setSilversOnlyAtGanon(true);

                break;
            case 2:
                $this->write(0x3ADA7, pack('C*', 0x02, 0x04, 0x08));
                $this->setCaneOfByrnaInvulnerability(false);
                $this->setPowderedSpriteFairyPrize(0xD8); // 1 heart
                $this->setBottleFills([0x20, 0x20]); // 4 heart, 1/4 magic refills
                $this->setCatchableFairies(false);
                $this->setCatchableBees(true);
                $this->setStunItems(0x00);
                $this->setSilversOnlyAtGanon(true);

                break;
            case 3:
                $this->write(0x3ADA7, pack('C*', 0x01, 0x02, 0x04));
                $this->setCaneOfByrnaInvulnerability(false);
                $this->setPowderedSpriteFairyPrize(0x79); // Bees
                $this->setBottleFills([0x00, 0x00]); // 0 hearts, 0 magic refills
                $this->setCatchableFairies(false);
                $this->setCatchableBees(true);
                $this->setStunItems(0x00);
                $this->setSilversOnlyAtGanon(true);

                break;
            default:
                throw new \Exception("Trying to set hard mode that doesn't exist");
        }

        return $this;
    }

    /**
     * Quick and dirty shop setting code.
     *
     * @param \ALttP\Support\ShopCollection $shops shops to write to rom
     *
     * @return $this
     */
    public function setupCustomShops($shops): self
    {
        $shops = $shops->filter(function ($shop) {
            return $shop->getActive();
        });

        $shop_data = [];
        $items_data = [];
        $shop_id = 0x00;
        $sram_offset = 0x00;
        foreach ($shops as $shop) {
            if ($shop_id == $shops->count() - 1) {
                $shop_id = 0xFF;
            }
            $shop->writeExtraData($this);
            // @TODO: make this clever and reuse when inv is the exact same. (except take any's)
            $shop_data = array_merge($shop_data, [$shop_id], $shop->getBytes($sram_offset));
            $sram_offset += ($shop instanceof Shop\TakeAny) ? 1 : count($shop->getInventory());

            if ($sram_offset > 36) {
                throw new \Exception("Exceeded SRAM indexing for shops");
            }

            foreach ($shop->getInventory() as $item) {
                $items_data = array_merge(
                    $items_data,
                    [$shop_id, $item['id']],
                    array_values(unpack('C*', pack('S', $item['price'] ?? 0))),
                    [$item['max'] ?? 0, $item['replace_id'] ?? 0xFF],
                    array_values(unpack('C*', pack('S', $item['replace_price'] ?? 0)))
                );
            }
            ++$shop_id;
        }
        $this->write(0x184800, pack('C*', ...$shop_data));

        $items_data = array_merge($items_data, [0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF]);
        $this->write(0x184900, pack('C*', ...$items_data));

        return $this;
    }

    /**
     * Set Rupee Arrow mode
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setRupeeArrow(bool $enable = false): self
    {
        $this->write(0x30052, pack('C*', $enable ? 0xDB : 0xE2)); // fish bottle merchant
        $this->write(0x301FC, pack('C*', $enable ? 0xDA : 0xE1)); // replace Pot rupees
        $this->write(0xECB4E, $enable ? pack('C*', 0xA9, 0x00, 0xEA, 0xEA) : pack('C*', 0xAF, 0x77, 0xF3, 0x7E)); // thief
        $this->write(0xF0D96, $enable ? pack('C*', 0xA9, 0x00, 0xEA, 0xEA) : pack('C*', 0xAF, 0x77, 0xF3, 0x7E)); // pikit
        $this->write(0x180175, pack('C*', $enable ? 0x01 : 0x00)); // enable mode
        $this->write(0x180176, pack('S*', $enable ? 0x0A : 0x00)); // wood cost
        $this->write(0x180178, pack('S*', $enable ? 0x32 : 0x00)); // silver cost
        $this->write(0xEDA5, $enable ? pack('C*', 0x35, 0x41) : pack('C*', 0x43, 0x44)); // DW chest game

        return $this;
    }

    /**
     * Set whether Sahasrahla updates your map with Green Pendant when you talk to him
     *
     * @param int $reveals bitfield of what he reveals
     *
     * @return $this
     */
    public function setMapRevealSahasrahla(int $reveals = 0x0000): self
    {
        $this->write(0x18017A, pack('S*', $reveals));

        return $this;
    }

    /**
     * Set whether Bomb Shop dude updates your map with Red Cyrstals when you talk to him
     *
     * @param int $reveals bitfield of what he reveals
     *
     * @return $this
     */
    public function setMapRevealBombShop(int $reveals = 0x0000): self
    {
        $this->write(0x18017C, pack('S*', $reveals));

        return $this;
    }

    /**
     * Set it so trade fairies only trade bottles
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setRestrictFairyPonds(bool $enable = true): self
    {
        $this->write(0x18017E, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable Escape Assist
     *
     * @param int $flags assist -----mba m: Infinite Magic, b: Infinite Bombs, a: Infinite Arrows
     *
     * @return $this
     */
    public function setEscapeAssist(int $flags = 0x00): self
    {
        $this->write(0x18004D, pack('C*', $flags));

        return $this;
    }

    /**
     * Enable Escape Fills
     *
     * @param int $flags  assist -----mba m: Magic refill, b: Bomb refill, a: Arrow refill
     * @param int $rupees if rupee bow is enabled, this value is used for starting rupees
     *
     * @return $this
     */
    public function setEscapeFills(int $flags = 0x00, int $rupees = 300): self
    {
        $this->write(0x18004E, pack('C*', $flags));
        $this->write(0x180183, pack('S*', $rupees));

        return $this;
    }

    /**
     * Set Uncle Refills on respawn
     *
     * @param int $magic
     * @param int $bombs
     * @param int $arrows
     *
     * @return $this
     */
    public function setUncleSpawnRefills(int $magic = 0x00, int $bombs = 0x00, int $arrows = 0x00): self
    {
        $this->write(0x180185, pack('C*', $magic, $bombs, $arrows));

        return $this;
    }

    /**
     * Set Zelda Cell Refills on respawn
     *
     * @param int $magic
     * @param int $bombs
     * @param int $arrows
     *
     * @return $this
     */
    public function setZeldaSpawnRefills(int $magic = 0x00, int $bombs = 0x00, int $arrows = 0x00): self
    {
        $this->write(0x180188, pack('C*', $magic, $bombs, $arrows));

        return $this;
    }

    /**
     * Set Mantle Refills on respawn
     *
     * @param int $magic
     * @param int $bombs
     * @param int $arrows
     *
     * @return $this
     */
    public function setMantleSpawnRefills(int $magic = 0x00, int $bombs = 0x00, int $arrows = 0x00): self
    {
        $this->write(0x18018B, pack('C*', $magic, $bombs, $arrows));

        return $this;
    }

    /**
     * Set the prizes for the pick 3 chest games.
     *
     * @param array $prizes item id's of prizes should be length 32
     *
     * @return $this
     */
    public function setChancePrizes(array $prizes = null)
    {
        if (!$prizes) {
            $prizes = [
                // high stakes game
                0x47, 0x34, 0x46, 0x34, 0x46, 0x46, 0x34, 0x47,
                0x46, 0x47, 0x34, 0x46, 0x47, 0x34, 0x46, 0x47,
                // low stakes game
                0x34, 0x47, 0x41, 0x47, 0x41, 0x41, 0x47, 0x34,
                0x41, 0x34, 0x47, 0x41, 0x34, 0x47, 0x41, 0x34,
            ];
        }

        $this->write(0xEED5, pack('C*', ...$prizes)); // 32 bytes

        return $this;
    }

    /**
     * Set Generic keys mode, if enabled all keys will share 1 pool.
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setGenericKeys(bool $enable = false): self
    {
        $this->write(0x180172, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Set Smithy Quick Item Give mode. I.E. just gives an item if you rescue him with no sword bogarting
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setSmithyQuickItemGive(bool $enable = true): self
    {
        $this->write(0x180029, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Set Pyramid Fountain to have 2 chests
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setPyramidFairyChests(bool $enable = true): self
    {
        $this->write(0x1FC16, $enable
            ? pack('C*', 0xB1, 0xC6, 0xF9, 0xC9, 0xC6, 0xF9)
            : pack('C*', 0xA8, 0xB8, 0x3D, 0xD0, 0xB8, 0x3D));

        return $this;
    }

    /**
     * Enable Hammer activates tablets
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setHammerTablet(bool $enable = false): self
    {
        $this->write(0x180044, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable Hammer breaks Aghanim's barrier no matter what
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setHammerBarrier(bool $enable = false): self
    {
        $this->write(0x18005D, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable ability to bug net catch Fairy
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setCatchableFairies(bool $enable = true): self
    {
        $this->write(0x34FD6, pack('C*', $enable ? 0xF0 : 0x80));

        return $this;
    }


    /**
     * Enable which objects stun
     *
     * @param int $flags display ------hb h: hookshot, b: Boomerang
     *
     * @return $this
     */
    public function setStunItems(int $flags = 0x03): self
    {
        $this->write(0x180180, pack('C*', $flags));

        return $this;
    }

    /**
     * Enable silver arrows can only be used in Ganon's room
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setSilversOnlyAtGanon(bool $enable = false): self
    {
        $this->write(0x180181, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Set when silvers equip
     *
     * @param string $setting name
     *
     * @return $this
     */
    public function setSilversEquip(string $setting): self
    {
        switch ($setting) {
            case 'both':
                $byte = 0x03;
                break;
            case 'ganon':
                $byte = 0x02;
                break;
            case 'off':
                $byte = 0x00;
                break;
            case 'collection':
            default:
                $byte = 0x01;
        }

        $this->write(0x180182, pack('C*', $byte));

        return $this;
    }

    /**
     * Enable/Disable ability to bug net catch Bee (also makes them attack you?)
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setCatchableBees(bool $enable = true): self
    {
        $this->write(0xF5D73, pack('C*', $enable ? 0xF0 : 0x80));
        $this->write(0xF5F10, pack('C*', $enable ? 0xF0 : 0x80));

        return $this;
    }

    /**
     * Place 2 chests in Waterfall of Wishing Fairy.
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setWishingWellChests(bool $enable = false): self
    {
        // set item table to proper room
        $this->write(0xE9AE, $enable ? pack('C*', 0x14, 0x01) : pack('C*', 0x05, 0x00));
        $this->write(0xE9CF, $enable ? pack('C*', 0x14, 0x01) : pack('C*', 0x3D, 0x01));

        // room 276 remodel
        $this->write(0x1F714, $enable
            ? (base64_decode(
                "4QAQrA0pmgFYmA8RsWH8TYEg2gIs4WH8voFhsWJU2gL9jYNE4WL9HoMxpckxpGkxwCJNpGkxxvlJxvkQmaBcmaILmGAN6MBV6MALk" .
                    "gBzmGD+aQCYo2H+a4H+q4WpyGH+roH/aQLYo2L/a4P/K4fJyGL/LoP+oQCqIWH+poH/IQLKIWL/JoO7I/rDI/q7K/rDK/q7U/rDU/" .
                    "qwoD2YE8CYUsCIAGCQAGDoAGDwAGCYysDYysDYE8DYUsD8vYX9HYf/////8P+ALmEOgQ7//w=="
            ) ?: '')
            : (base64_decode(
                "4QAQrA0pmgFYmA8RsGH8TQEg0gL8vQUs4WH8voFhsGJU0gL9jQP9HQdE4WL9HoMxpckxpGkxwCJNpGkouD1QuD0QmaBcmaILmGAN4" .
                    "cBV4cALkgBzmGD+aQCYo2H+a4H+q4WpyGH+roH/aQLYo2L/a4P/K4fJyGL/LoP+oQCqIWH+poH/IQLKIWL/JoO7I/rDI/q7K/rDK/" .
                    "q7U/rDU/qwoD2YE8CYUsCIAGCQAGDoAGDwAGCYysDYysDYE8DYUsD/////8P+ALmEOgQ7//w=="
            ) ?: ''));

        return $this;
    }

    /**
     * Remove 2 statues at hylia fairy
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setHyliaFairyShop(bool $enable = false): self
    {
        $this->write(0x01F810, $enable
            ? pack('C*', 0x1A, 0x1E, 0x01, 0x1A, 0x1E, 0x01)
            : pack('C*', 0xFC, 0x94, 0xE4, 0xFD, 0x34, 0xE4));

        return $this;
    }

    /**
     * Enable/Disable Waterfall of Wishing Fairy's ability to upgrade items.
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setWishingWellUpgrade(bool $enable = false): self
    {
        $this->write(0x348DB, pack('C*', $enable ? 0x0C : 0x2A));
        $this->write(0x348EB, pack('C*', $enable ? 0x04 : 0x05));

        return $this;
    }

    public function setGameState(string $state = null)
    {
        $this->setOpenMode(false);
        $this->setFixFakeWorld(false);
        switch ($state) {
            case 'open':
            case 'retro':
                return $this->setOpenMode(true);
            case 'inverted':
                return $this->setInvertedMode(true);
            case 'standard':
            default:
                return $this;
        }
    }

    /**
     * Set Game in Open Mode. (Post rain state with Escape undone)
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setOpenMode(bool $enable = true): self
    {
        $this->write(0x180032, pack('C*', $enable ? 0x01 : 0x00));
        $this->setSewersLampCone(!$enable);
        $this->setLightWorldLampCone(false);
        $this->setDarkWorldLampCone(false);

        return $this;
    }

    /**
     * Set Game in Inverted Mode. (Post rain state with Escape undone and in the Dark Wold with a whole slew of other crap)
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setInvertedMode(bool $enable = true): self
    {
        // this mode is based on open mode ;)
        $this->setOpenMode($enable);

        $this->write(snes_to_pc(0x30804A), pack('C*', 0x01)); // ; main toggle
        $this->write(snes_to_pc(0x0283E0), pack('C*', 0xF0)); // ; residual portal
        $this->write(snes_to_pc(0x02B34D), pack('C*', 0xF0)); // ; residual portal
        $this->write(snes_to_pc(0x06DB78), pack('C*', 0x8B)); // ; residual portal
        $this->write(snes_to_pc(0x05AF79), pack('C*', 0xF0)); // ; vortex
        $this->write(snes_to_pc(0x0DB3C5), pack('C*', 0xC6)); // ; vortex
        $this->write(snes_to_pc(0x07A3F4), pack('C*', 0xF0)); // ; duck
        $this->write(snes_to_pc(0x07A3F4), pack('C*', 0xF0)); // ; duck
        $this->write(snes_to_pc(0x02E849), pack('S*', 0x0043, 0x0056, 0x0058, 0x006C, 0x006F, 0x0070, 0x007B, 0x007F, 0x001B)); // ; Dark World Flute Spots
        $this->write(snes_to_pc(0x02E8D5), pack('S*', 0x07C8)); // ; nudge flute spot 3 out of gargoyle statue
        $this->write(snes_to_pc(0x02E8F7), pack('S*', 0x01F8)); // ; nudge flute spot 3 out of gargoyle statue
        $this->write(snes_to_pc(0x07A943), pack('C*', 0xF0)); // ; Dark to light world mirror
        $this->write(snes_to_pc(0x07A96D), pack('C*', 0xD0)); // ; residual portal?
        $this->write(snes_to_pc(0x08D40C), pack('C*', 0xD0)); // ; morph poof

        $this->write(0x15B8C, pack('C', 0x6C)); // update link's house exit to be dark world (All the other exit table values can be reused)
        $this->write(0xDBB73 + 0x00, pack('C', 0x53)); // entering links house door leads to bomb shop
        $this->write(0xDBB73 + 0x52, pack('C', 0x01)); // entering bomb shop leads to links house

        // swap GT and AT entrances
        $this->write(0xDBB73 + 0x23, pack('C', 0x37)); // entering AT Door Leads to GT
        $this->write(0xDBB73 + 0x36, pack('C', 0x24)); // entering GT Door Leads to AT
        $this->write(0x15AEE + 2 * 0x38, pack('S*', 0x00e0)); // exiting AT leads to GT
        $this->write(0x15AEE + 2 * 0x25, pack('S*', 0x000c)); // exiting GT leads to AT

        // Bumper Cave (Bottom) => Old Man Cave (West)
        $this->write(0xDBB73 + 0x15, pack('C', 0x06));
        $this->write(0x15AEE + 2 * 0x17, pack('S*', 0x00F0));

        // Old Man Cave (West) => Bumper Cave (Bottom)
        $this->write(0xDBB73 + 0x05, pack('C', 0x16));
        $this->write(0x15AEE + 2 * 0x07, pack('S*', 0x00FB));

        // Death Mountain Return Cave (West) => Bumper Cave (Top)
        $this->write(0xDBB73 + 0x2D, pack('C', 0x17));
        $this->write(0x15AEE + 2 * 0x2F, pack('S*', 0x00EB));

        // Old Man Cave (East) => Death Mountain Return Cave (West)
        $this->write(0xDBB73 + 0x06, pack('C', 0x2E));
        $this->write(0x15AEE + 2 * 0x08, pack('S*', 0x00e6));

        // Bumper Cave (Top) => Dark Death Mountain Fairy
        $this->write(0xDBB73 + 0x16, pack('C', 0x5E));

        // fix trock doors for reverse entrances
        $this->write(0xFED31, pack('C', 0x0E)); // preopen bombable exit
        $this->write(0xFEE41, pack('C', 0x0E)); // preopen bombable exit

        // Dark Death Mountain Healer Fairy => Old Man Cave (East)
        $this->write(0xDBB73 + 0x6F, pack('C', 0x07));
        $this->write(0x15AEE + 2 * 0x18, pack('S*', 0x00f1));
        $this->write(0x15B8C + 0x18, pack('C', 0x43));
        $this->write(0x15BDB + 2 * 0x18, pack('S*', 0x1400));
        $this->write(0x15C79 + 2 * 0x18, pack('S*', 0x0294));
        $this->write(0x15D17 + 2 * 0x18, pack('S*', 0x0600));
        $this->write(0x15DB5 + 2 * 0x18, pack('S*', 0x02e8));
        $this->write(0x15E53 + 2 * 0x18, pack('S*', 0x0678));
        $this->write(0x15EF1 + 2 * 0x18, pack('S*', 0x0303));
        $this->write(0x15F8F + 2 * 0x18, pack('S*', 0x0685));
        $this->write(0x1602D + 0x18, pack('C', 0x0a));
        $this->write(0x1607C + 0x18, pack('C', 0xf6));
        $this->write(0x160CB + 2 * 0x18, pack('S*', 0x0000));
        $this->write(0x16169 + 2 * 0x18, pack('S*', 0x0000));

        // Pyramid Exit <= Houlihan
        $this->write(0x15AEE + 2 * 0x3D, pack('S*', 0x0003));
        $this->write(0x15B8C + 0x3D, pack('C', 0x5b));
        $this->write(0x15BDB + 2 * 0x3D, pack('S*', 0x0b0e));
        $this->write(0x15C79 + 2 * 0x3D, pack('S*', 0x075a));
        $this->write(0x15D17 + 2 * 0x3D, pack('S*', 0x0674));
        $this->write(0x15DB5 + 2 * 0x3D, pack('S*', 0x07a8));
        $this->write(0x15E53 + 2 * 0x3D, pack('S*', 0x06e8));
        $this->write(0x15EF1 + 2 * 0x3D, pack('S*', 0x07c7));
        $this->write(0x15F8F + 2 * 0x3D, pack('S*', 0x06f3));
        $this->write(0x1602D + 0x3D, pack('C', 0x06));
        $this->write(0x1607C + 0x3D, pack('C', 0xfa));
        $this->write(0x160CB + 2 * 0x3D, pack('S*', 0x0000));
        $this->write(0x16169 + 2 * 0x3D, pack('S*', 0x0000));

        // Change sanc spawn point to dark sanc
        $this->write(snes_to_pc(0x02D8D4), pack('S*', 0x112));
        $this->write(snes_to_pc(0x02D8E8), pack('C*', 0x22, 0x22, 0x22, 0x23, 0x04, 0x04, 0x04, 0x05));
        $this->write(snes_to_pc(0x02D91A), pack('S*', 0x0400));
        $this->write(snes_to_pc(0x02D928), pack('S*', 0x222e));
        $this->write(snes_to_pc(0x02D936), pack('S*', 0x229a));
        $this->write(snes_to_pc(0x02D944), pack('S*', 0x0480));
        $this->write(snes_to_pc(0x02D952), pack('S*', 0x00a5));
        $this->write(snes_to_pc(0x02D960), pack('S*', 0x007F));
        $this->write(snes_to_pc(0x02D96D), pack('C', 0x14));
        $this->write(snes_to_pc(0x02D974), pack('C', 0x00));
        $this->write(snes_to_pc(0x02D97B), pack('C', 0xFF));
        $this->write(snes_to_pc(0x02D982), pack('C', 0x00));
        $this->write(snes_to_pc(0x02D989), pack('C', 0x02));
        $this->write(snes_to_pc(0x02D990), pack('C', 0x00));
        $this->write(snes_to_pc(0x02D998), pack('S*', 0x0000));
        $this->write(snes_to_pc(0x02D9A6), pack('S*', 0x005A));
        $this->write(snes_to_pc(0x02D9B3), pack('C', 0x12));

        // Write dark sanc exit data to StartingAreaExitTable table
        $this->write(0x180250, pack('S*', 0x0112) . pack('C', 0x53)
            . pack('S*', 0x001e, 0x0400, 0x06e2, 0x0446, 0x0758, 0x046d, 0x075f)
            . pack('C*', 0x00, 0x00, 0x00));

        // Write to StartingAreaExitOffset table to indicate that dark sanc spawn uses first row in table
        $this->write(0x180240, pack('C*', 0x00, 0x01, 0x00, 0x00, 0x00, 0x00, 0x00));

        $this->write(snes_to_pc(0x308350), pack('C*', 0x00, 0x00, 0x01)); // Death mountain cave should start on overworld

        // Change old man spawn point to End of old man cave
        $this->write(snes_to_pc(0x02D8DE), pack('S*', 0x00F1));
        $this->write(snes_to_pc(0x02D910), pack('C*', 0x1F, 0x1E, 0x1F, 0x1F, 0x03, 0x02, 0x03, 0x03));
        $this->write(snes_to_pc(0x02D924), pack('S*', 0x0300));
        $this->write(snes_to_pc(0x02D932), pack('S*', 0x1F10));
        $this->write(snes_to_pc(0x02D940), pack('S*', 0x1FC0));
        $this->write(snes_to_pc(0x02D94E), pack('S*', 0x0378));
        $this->write(snes_to_pc(0x02D95C), pack('S*', 0x0187));
        $this->write(snes_to_pc(0x02D96A), pack('S*', 0x017F));
        $this->write(snes_to_pc(0x02D972), pack('C', 0x06));
        $this->write(snes_to_pc(0x02D979), pack('C', 0x00));
        $this->write(snes_to_pc(0x02D980), pack('C', 0xFF));
        $this->write(snes_to_pc(0x02D987), pack('C', 0x00));
        $this->write(snes_to_pc(0x02D98E), pack('C', 0x22));
        $this->write(snes_to_pc(0x02D995), pack('C', 0x12));
        $this->write(snes_to_pc(0x02D9A2), pack('S*', 0x0000));
        $this->write(snes_to_pc(0x02D9B0), pack('S*', 0x0007));
        $this->write(snes_to_pc(0x02D9B8), pack('C', 0x12));

        // Write to StartingAreaOverworldDoor table to indicate the overworld door being used for
        // the single entrance spawn point
        $this->write(0x180247, pack('C*', 0x00, 0x5A, 0x00, 0x00, 0x00, 0x00, 0x00));

        // aga tower exit/ pyramid spawn (now hyrule castle ledge spawn)
        $this->write(0x15AEE + 2 * 0x06, pack('S', 0x0020));
        $this->write(0x15B8C + 0x06, pack('C', 0x1B));
        $this->write(0x15BDB + 2 * 0x06, pack('S', 0x00AE));
        $this->write(0x15C79 + 2 * 0x06, pack('S', 0x0610));
        $this->write(0x15D17 + 2 * 0x06, pack('S', 0x077E));
        $this->write(0x15DB5 + 2 * 0x06, pack('S', 0x0672));
        $this->write(0x15E53 + 2 * 0x06, pack('S', 0x07F8));
        $this->write(0x15EF1 + 2 * 0x06, pack('S', 0x067D));
        $this->write(0x15F8F + 2 * 0x06, pack('S', 0x0803));
        $this->write(0x1602D + 0x06, pack('C', 0x00));
        $this->write(0x1607C + 0x06, pack('C', 0xf2));
        $this->write(0x160CB + 2 * 0x06, pack('S', 0x0000));
        $this->write(0x16169 + 2 * 0x06, pack('S', 0x0000));

        // move flute spot 9 (notice that the values of this match the 2nd, 3rd etc value of hyrule castle spawn)
        $this->write(snes_to_pc(0x02E87B), pack('S', 0x00ae));
        $this->write(snes_to_pc(0x02E89D), pack('S', 0x0610));
        $this->write(snes_to_pc(0x02E8BF), pack('S', 0x077e));
        $this->write(snes_to_pc(0x02E8E1), pack('S', 0x0672));
        $this->write(snes_to_pc(0x02E903), pack('S', 0x07f8));
        $this->write(snes_to_pc(0x02E925), pack('S', 0x067d));
        $this->write(snes_to_pc(0x02E947), pack('S', 0x0803));
        $this->write(snes_to_pc(0x02E969), pack('S', 0x0000));
        $this->write(snes_to_pc(0x02E98B), pack('S', 0xFFF2));

        $this->write(snes_to_pc(0x1AF696), pack('C', 0xF0)); // Bat X position (sprite_retreat_bat.asm:130)
        $this->write(snes_to_pc(0x1AF6B2), pack('C', 0x33)); // Bat Delay (sprite_retreat_bat.asm:136)

        // New Hole Mask Position
        $this->write(snes_to_pc(0x1AF730), pack(
            'C*',
            0x6A,
            0x9E,
            0x0C,
            0x00,
            0x7A,
            0x9E,
            0x0C,
            0x00,
            0x8A,
            0x9E,
            0x0C,
            0x00,
            0x6A,
            0xAE,
            0x0C,
            0x00,
            0x7A,
            0xAE,
            0x0C,
            0x00,
            0x8A,
            0xAE,
            0x0C,
            0x00,
            0x67,
            0x97,
            0x0C,
            0x00,
            0x8D,
            0x97,
            0x0C,
            0x00
        ));

        // redefine some map16 tiles
        $this->write(snes_to_pc(0x0FF1C8), pack(
            'S*',
            0x190F,
            0x190F,
            0x190F,
            0x194C,
            0x190F,
            0x194B,
            0x190F,
            0x195C,
            0x594B,
            0x194C,
            0x19EE,
            0x19EE,
            0x194B,
            0x19EE,
            0x19EE,
            0x19EE,
            0x594B,
            0x190F,
            0x595C,
            0x190F,
            0x190F,
            0x195B,
            0x190F,
            0x190F,
            0x19EE,
            0x19EE,
            0x195C,
            0x19EE,
            0x19EE,
            0x19EE,
            0x19EE,
            0x595C,
            0x595B,
            0x190F,
            0x190F,
            0x190F
        ));

        // Redefine more map16 tiles
        $this->write(snes_to_pc(0x0FA480), pack('S*', 0x190F, 0x196B, 0x9D04, 0x9D04, 0x196B, 0x190F, 0x9D04, 0x9D04));

        // update pyramid hole entrances
        $this->write(snes_to_pc(0x1bb810), pack('S*', 0x00BE, 0x00C0, 0x013E));
        $this->write(snes_to_pc(0x1bb836), pack('S*', 0x001B, 0x001B, 0x001B));

        // add an extra pyramid hole entrance
        $this->write(snes_to_pc(0x308300), pack('S', 0x0140)); // ExtraHole_Map16
        $this->write(snes_to_pc(0x308320), pack('S', 0x001B)); // ExtraHole_Area
        $this->write(snes_to_pc(0x308340), pack('C', 0x7B)); // ExtraHole_Entrance

        // prioritize retreat Bat and use 3rd sprite group
        $this->write(snes_to_pc(0x1af504), pack('S', 0x148B));
        $this->write(snes_to_pc(0x1af50c), pack('S', 0x149B));
        $this->write(snes_to_pc(0x1af514), pack('S', 0x14A4));
        $this->write(snes_to_pc(0x1af51c), pack('S', 0x1489));
        $this->write(snes_to_pc(0x1af524), pack('S', 0x14AC));
        $this->write(snes_to_pc(0x1af52c), pack('S', 0x54AC));
        $this->write(snes_to_pc(0x1af534), pack('S', 0x148C));
        $this->write(snes_to_pc(0x1af53c), pack('S', 0x548C));
        $this->write(snes_to_pc(0x1af544), pack('S', 0x1484));
        $this->write(snes_to_pc(0x1af54c), pack('S', 0x5484));
        $this->write(snes_to_pc(0x1af554), pack('S', 0x14A2));
        $this->write(snes_to_pc(0x1af55c), pack('S', 0x54A2));
        $this->write(snes_to_pc(0x1af564), pack('S', 0x14A0));
        $this->write(snes_to_pc(0x1af56c), pack('S', 0x54A0));
        $this->write(snes_to_pc(0x1af574), pack('S', 0x148E));
        $this->write(snes_to_pc(0x1af57c), pack('S', 0x548E));
        $this->write(snes_to_pc(0x1af584), pack('S', 0x14AE));
        $this->write(snes_to_pc(0x1af58c), pack('S', 0x54AE));

        // Make retreat bat gfx available in Hyrule castle.
        $this->write(snes_to_pc(0x00DB9D), pack('C', 0x1A)); // sprite set 1, section 3
        $this->write(snes_to_pc(0x00DC09), pack('C', 0x1A)); // sprite set 27, section 3

        // use new castle hole graphics (The values are the SNES address of the graphics: 31e000)
        $this->write(snes_to_pc(0x00D009), pack('C', 0x31));
        $this->write(snes_to_pc(0x00D0e8), pack('C', 0xE0));
        $this->write(snes_to_pc(0x00D1c7), pack('C', 0x00));
        $this->write(snes_to_pc(0x1BE8DA), pack('S', 0x39AD)); // add color for shading for castle hole

        $this->write(0x180169, pack('C', 0x02)); // lock aga door
        $this->write(0xF6E58, pack('C', 0x80)); // don't allow "whirlpool" under castle gate

        // Turtle rock tail
        $this->write(0x0086E, pack('C*', 0x5C, 0x00, 0xA0, 0xA1)); // JML.l $A1A000 (a.k.a. JML.l InvertedTileAttributeLookup)

        // Add warps under rocks, etc.
        $this->write(snes_to_pc(0x1BC67A), pack('C*', 0x2E, 0x0B, 0x82)); // Replace a rupee under bush to add a warp on map 80 (top of kak)
        $this->write(snes_to_pc(0x1BC81E), pack('C*', 0x94, 0x1D, 0x82)); // Replace a heart under bush to add a warp on map 120 (mire)
        $this->write(snes_to_pc(0x1BC655), pack('C*', 0x4A, 0x1D, 0x82)); // Replace a bomb :( under bush to add a warp on map 78 (DM)
        $this->write(snes_to_pc(0x1BC80D), pack('C*', 0xB2, 0x0B, 0x82)); // map 111
        $this->write(snes_to_pc(0x1BC3DF), pack('C*', 0xD8, 0xD1)); // new pointer for map 115 no items to replace
        $this->write(snes_to_pc(0x1BD1D8), pack('C*', 0xA8, 0x02, 0x82, 0xFF, 0xFF)); // new data for map115
        $this->write(snes_to_pc(0x1BC85A), pack('C*', 0x50, 0x0F, 0x82));

        // move pyramid exit overworld door
        $this->write(0xDB96F + 2 * 0x35, pack('S', 0x001B));
        $this->write(0xDBA71 + 2 * 0x35, pack('S', 0x06A4));
        $this->write(0xDBB73 + 0x35, pack('C', 0x36));

        // Remove Hyrule Castle Gate warp
        $this->write(snes_to_pc(0x09D436), pack('C', 0xF3)); // replace whirlpool with (harmless) SpritePositionTarget Overlord

        // Pyramid exits to new hyrule castle area
        $this->write(0x15AEE + 2 * 0x37, pack('S', 0x0010));
        $this->write(0x15B8C + 0x37, pack('C', 0x1B));
        $this->write(0x15BDB + 2 * 0x37, pack('S', 0x0418));
        $this->write(0x15C79 + 2 * 0x37, pack('S', 0x0679));
        $this->write(0x15D17 + 2 * 0x37, pack('S', 0x06B4));
        $this->write(0x15DB5 + 2 * 0x37, pack('S', 0x06C6));
        $this->write(0x15E53 + 2 * 0x37, pack('S', 0x0728));
        $this->write(0x15EF1 + 2 * 0x37, pack('S', 0x06E6));
        $this->write(0x15F8F + 2 * 0x37, pack('S', 0x0733));
        $this->write(0x1602D + 0x37, pack('C', 0x07));
        $this->write(0x1607C + 0x37, pack('C', 0xf9));
        $this->write(0x160CB + 2 * 0x37, pack('S', 0x0000));
        $this->write(0x16169 + 2 * 0x37, pack('S', 0x0000));
        $this->write(snes_to_pc(0x1BC387), pack('C*', 0xDD, 0xD1)); // New pointer for map 71 no items to replace
        $this->write(snes_to_pc(0x1BD1DD), pack('C*', 0xA4, 0x06, 0x82, 0x9E, 0x06, 0x82, 0xFF, 0xFF)); // new data for map 71

        $this->write(0x180089, pack('C', 0x01)); // open TR main entrance on exiting

        $this->write(snes_to_pc(0x0ABFBB), pack('C', 0x90)); // move mirror portal indicator to correct map (0xB0 normally)

        $this->write(snes_to_pc(0x0280A6), pack('C', 0xD0)); // Spawn logic

        $this->write(snes_to_pc(0x06B2AB), pack('C*', 0xF0, 0xE1, 0x05)); // frog pickup on contact

        $this->text->setString('sign_path_to_death_mountain', "→ Bumper Cave\nYou need Cape and Mirror, but not Hookshot");
        $this->text->setString('sign_bumper_cave', "Cave to lost, old man.\nGood luck.");
        $this->text->setString('sign_east_of_bomb_shop', "\n← Your House");
        $this->text->setString('sign_east_of_links_house', "\n← Bomb Shoppe");
        $this->text->setString('kiki_leaving_screen', "{NOTEXT}", false);
        $this->text->setString('dark_sanctuary', "{NOTEXT}", false);
        $this->text->setString('dark_sanctuary_yes', "{NOTEXT}", false);
        $this->text->setString('dark_sanctuary_no', "If you want that healing you're gonna need 20 rupees.");

        $this->text->setString('menu_start_2', "{MENU}\n{SPEED0}\n≥@'s house\n Dark Chapel\n{CHOICE3}", false);
        $this->text->setString('menu_start_3', "{MENU}\n{SPEED0}\n≥@'s house\n Dark Chapel\n Dark Mountain\n{CHOICE2}", false);

        $this->text->setString('intro_main', "{INTRO}\n Episode  III\n{PAUSE3}\n A Link to\n   the Past\n"
            . "{PAUSE3}\nInverted\n  Randomizer\n{PAUSE3}\nAfter mostly disregarding what happened in the first two games,\n"
            . "{PAUSE3}\nLink has been transported to the Dark World\n{PAUSE3}\nWhile he was slumbering,\n"
            . "{PAUSE3}\nWhatever will happen?\n{PAUSE3}\n{CHANGEPIC}\nGanon has moved around all the items in Hyrule.\n"
            . "{PAUSE7}\nYou will have to find all the items necessary to beat Ganon.\n"
            . "{PAUSE7}\nThis is your chance to be a hero.\n{PAUSE3}\n{CHANGEPIC}\n"
            . "You must get the 7 crystals to beat Ganon.\n{PAUSE9}\n{CHANGEPIC}", false);

        return $this;
    }

    /**
     * Enable maps to show crystals on overworld map
     *
     * @param bool $require_map switch on or off
     *
     * @return $this
     */
    public function setMapMode(bool $require_map = false): self
    {
        $this->write(0x18003B, pack('C*', $require_map ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable compass to show dungeon count
     *
     * @param string $setting switch on or off
     *
     * @return $this
     */
    public function setCompassMode(string $setting = 'off'): self
    {
        switch ($setting) {
            case 'on':
                $byte = 0x02;
                break;
            case 'pickup':
                $byte = 0x01;
                break;
            case 'off':
            default:
                $byte = 0x00;
        }

        $this->write(0x18003C, pack('C', $byte));

        return $this;
    }

    /**
     * Enable text box to show with free roaming items
     *
     * ---o bmcs
     * o - enabled for outside dungeon items
     * b - enabled for inside big key items
     * m - enabled for inside map items
     * c - enabled for inside compass items
     * s - enabled for inside small key items
     *
     * @param int $bit_field switch on or off
     *
     * @return $this
     */
    public function setFreeItemTextMode(int $bit_field = 0x00): self
    {
        $this->write(0x18016A, pack('C*', $bit_field));

        return $this;
    }

    /**
     * Enable free items to show up in menu
     *
     * @param int $flags display ----dcba a: Small Keys, b: Big Key, c: Map, d: Compass
     *
     * @return $this
     */
    public function setFreeItemMenu(int $flags = 0x00): self
    {
        $this->write(0x180045, pack('C*', $flags));

        return $this;
    }

    /**
     * Enable swordless mode
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setSwordlessMode(bool $enable = false): self
    {
        $this->write(0x18003F, pack('C*', $enable ? 0x01 : 0x00)); // Hammer Ganon
        $this->write(0x180040, pack('C*', $enable ? 0x01 : 0x00)); // Open Curtains
        $this->write(0x180041, pack('C*', $enable ? 0x01 : 0x00)); // Swordless Medallions
        $this->write(0x180043, pack('C*', $enable ? 0xFF : 0x00)); // set Link's starting sword 0xFF is taken sword

        $this->setHammerTablet($enable);
        $this->setHammerBarrier(false);

        return $this;
    }

    /**
     * Enable lampless light cone in Sewers
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setSewersLampCone(bool $enable = true): self
    {
        $this->write(0x180038, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable lampless light cone in Light World Dungeons
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setLightWorldLampCone(bool $enable = true): self
    {
        $this->write(0x180039, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable lampless light cone in Dark World Dungeons
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setDarkWorldLampCone(bool $enable = true): self
    {
        $this->write(0x18003A, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable the ROM Hack that doesn't leave Link stranded in DW
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setMirrorlessSaveAndQuitToLightWorld(bool $enable = true): self
    {
        $this->write(0x1800A0, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable ability to Save and Quit from Boss room after item collection.
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setSaveAndQuitFromBossRoom(bool $enable = false): self
    {
        $this->write(0x180042, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable the ROM Hack that drains the Swamp on transition
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setSwampWaterLevel(bool $enable = true): self
    {
        $this->write(0x1800A1, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable the ROM Hack that sends Link to Real DW on death in DW dungeon if AG1 is not dead
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setPreAgahnimDarkWorldDeathInDungeon(bool $enable = true): self
    {
        $this->write(0x1800A2, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable World on Agahnim Death
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setWorldOnAgahnimDeath(bool $enable = true): self
    {
        $this->write(0x1800A3, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable PoD EG correction
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setPODEGfix(bool $enable = true): self
    {
        $this->write(0x1800A4, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable locking Hyrule Castle Door to AG1 during escape
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setLockAgahnimDoorInEscape(bool $enable = true): self
    {
        $this->write(0x180169, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Enable/Disable fix Fake Light World/Fake Dark World as caused by leaving the underworld.
     * Generally should only be used/enabled by Entrance Randomizer
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function setFixFakeWorld(bool $enable = false): self
    {
        $this->write(0x180174, pack('C*', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Set the Ganon Warp Phase and Agahnim BB mode
     *
     * @param string $setting name
     *
     * @return $this
     */
    public function setGanonAgahnimRng(string $setting = 'table'): self
    {
        switch ($setting) {
            case 'none':
                $byte = 0x01;
                break;
            case 'vanilla':
            case 'table':
            default:
                $byte = 0x00;
        }

        $this->write(0x180086, pack('C', $byte));

        return $this;
    }

    /**
     * Set the Tower Crystal Requirement
     *
     * @param int $crystals
     *
     * @return $this
     */
    public function setTowerCrystalRequirement(int $crystals = 7): self
    {
        $this->write(0x18005E, pack('C', max(min($crystals, 7), 0)));

        return $this;
    }

    /**
     * Set the Ganon Crystal Requirement
     *
     * @param int $crystals
     *
     * @return $this
     */
    public function setGanonCrystalRequirement(int $crystals = 7): self
    {
        $this->write(0x18005F, pack('C', max(min($crystals, 7), 0)));

        return $this;
    }

    /**
     * Set the Pyramid Hole State.
     *
     * @param bool $open
     *
     * @return $this
     */
    public function setPyramidHoleOpen(bool $open = false): self
    {
        $this->write(0x18008B, pack('C', $open ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Set the Ganon's Tower State.
     *
     * @param bool $open
     *
     * @return $this
     */
    public function setGanonsTowerOpen(bool $open = false): self
    {
        $this->write(0x18008C, pack('C', $open ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Write the seed identifier
     *
     * @param string $seed identifier for this seed
     *
     * @return $this
     */
    public function setSeedString(string $seed): self
    {
        $this->write(0x7FC0, substr($seed, 0, 21));

        return $this;
    }

    /**
     * Write a block of data to RNG Block in ROM.
     *
     * @param callable $random prng byte generator
     *
     * @return $this
     */
    public function writeRNGBlock(callable $random): self
    {
        $string = '';
        for ($i = 0; $i < 1024; $i++) {
            $string .= pack('C*', $random());
        }
        $this->write(0x178000, $string);

        return $this;
    }

    /**
     * set the flags byte in ROM
     *
     * dgGe mutT
     * d - Nonstandard Dungeon Configuration (Not Map/Compass/BigKey/SmallKeys in same quantity as vanilla)
     * g - Requires Minor Glitches (Fake flippers, bomb jumps, etc)
     * G - Requires Major Glitches (OW YBA/Clips, etc)
     * e - Requires EG
     *
     * m - Contains Multiples of Major Items
     * u - Contains Unreachable Items
     * t - Minor Trolling (Swapped around levers, etc)
     * T - Major Trolling (Forced-guess softlocks, impossible seed, etc)
     *
     * @param int $flags byte of flags to set
     *
     * @return $this
     */
    public function setWarningFlags(int $flags): self
    {
        $this->write(0x180212, pack('C*', $flags));

        return $this;
    }

    /**
     * Mute all audio tracks.
     *
     * @param bool $enable switch on or off
     *
     * @return $this
     */
    public function muteMusic(bool $enable = true): self
    {
        $this->write(0x18021A, pack('C', $enable ? 0x01 : 0x00));

        return $this;
    }

    /**
     * Apply a patch to the ROM
     *
     * @param array $patch patch to apply
     *
     * @return $this
     *
     **/
    public function applyPatch(array $patch): self
    {
        foreach ($patch as $part) {
            foreach ($part as $address => $data) {
                $this->write($address, pack('C*', ...array_values($data)), false);
            }
        }

        return $this;
    }

    /**
     * Apply a patch file to the ROM
     *
     * @param string $file_name JSON file to load and apply
     *
     * @throws \Exception if the file isn't readable
     *
     * @return $this
     *
     **/
    public function applyPatchFile(string $file_name): self
    {
        if (!is_readable($file_name)) {
            throw new \Exception('Patch file not readable');
        }

        $data = file_get_contents($file_name);

        if ($data === false) {
            throw new \Exception('Patch file not readable');
        }

        return $this->applyPatch(json_decode($data, true));
    }

    /**
     * rummage table
     *
     * @return $this
     */
    public function rummageTable(): self
    {
        Tournament::apply($this);

        return $this;
    }

    /**
     * Save the changes to this output file
     *
     * @param string $output_location location on the filesystem to write the new ROM.
     *
     * @return bool
     */
    public function save(string $output_location): bool
    {
        return copy($this->tmp_file, $output_location);
    }

    /**
     * Write packed data at the given offset
     *
     * @param int $offset location in the ROM to begin writing
     * @param string $data data to write to the ROM
     * @param bool $log write this write to the log
     *
     * @return $this
     */
    public function write(int $offset, string $data, bool $log = true): self
    {
        if ($log) {
            $unpacked = array_values(unpack('C*', $data));
            $this->write_log[] = [$offset => $unpacked];
        }
        fseek($this->rom, $offset);
        fwrite($this->rom, $data);

        return $this;
    }

    /**
     * Get the array of bytes written in the order they were written to the rom
     *
     * @return array
     */
    public function getWriteLog(): array
    {
        return $this->write_log;
    }

    /**
     * Read data from the ROM file into an array
     *
     * @param int $offset location in the ROM to begin reading
     * @param int $length data to read
     * // TODO: this should probably always be an array, or a new Bytes object
     * @return array
     */
    public function read(int $offset, int $length = 1)
    {
        fseek($this->rom, $offset);
        $packed = fread($this->rom, $length);
        if ($packed === false) {
            throw new \Exception('failed read');
        }
        $unpacked = unpack('C*', $packed);
        return count($unpacked) == 1 ? $unpacked[1] : array_values($unpacked);
    }

    /**
     * Read a byte from the ROM. It will return 0x00 if nothing is set at the
     * address.
     *
     * @param int $offset location in the ROM to begin reading
     *
     * @return int
     */
    public function readByte(int $offset): int
    {
        fseek($this->rom, $offset);
        $packed = fread($this->rom, 1);
        if ($packed === false) {
            throw new \Exception('failed read');
        }
        $unpacked = unpack('C*', $packed);

        return $unpacked[1] ?? 0x00;
    }

    /**
     * Object destruction magic method
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->rom) {
            fclose($this->rom);
        }
        unlink($this->tmp_file);
    }
}
