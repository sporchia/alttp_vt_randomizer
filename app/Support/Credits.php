<?php

namespace ALttP\Support;

/**
 * Class to handle Credits Sequence
 */
class Credits
{
    private $scenes = [
        'castle' => [
            ['type' => 'small', 'x' => 5, 'y' => 19, 'text' => 'The return of the King'],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => 'Hyrule Castle'],
        ],
        'sanctuary' => [
            ['type' => 'small', 'x' => 8, 'y' => 19, 'text' => 'The loyal priest'],
            ['type' => 'large', 'x' => 11, 'y' => 23, 'text' => 'Sanctuary'],
        ],
        'kakariko' => [
            ['type' => 'small', 'x' => 4, 'y' => 19, 'text' => "Sahasralah's Homecoming"],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => 'Kakariko Town'],
        ],
        'desert' => [
            ['type' => 'small', 'x' => 4, 'y' => 19, 'text' => 'vultures rule the desert'],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => 'Desert Palace'],
        ],
        'hera' => [
            ['type' => 'small', 'x' => 4, 'y' => 19, 'text' => 'the bully makes a friend'],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => 'Mountain Tower'],
        ],
        'house' => [
            ['type' => 'small', 'x' => 6, 'y' => 19, 'text' => 'your uncle recovers'],
            ['type' => 'large', 'x' => 11, 'y' => 23, 'text' => 'Your House'],
        ],
        'zora' => [
            ['type' => 'small', 'x' => 6, 'y' => 19, 'text' => 'finger webs for sale'],
            ['type' => 'large', 'x' => 8, 'y' => 23, 'text' => "Zora's Waterfall"],
        ],
        'witch' => [
            ['type' => 'small', 'x' => 4, 'y' => 19, 'text' => 'the witch and assistant'],
            ['type' => 'large', 'x' => 11, 'y' => 23, 'text' => 'Magic Shop'],
        ],
        'lumberjacks' => [
            ['type' => 'small', 'x' => 8, 'y' => 19, 'text' => 'twin lumberjacks'],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => "Woodsmen's Hut"],
        ],
        'grove' => [
            ['type' => 'small', 'x' => 4, 'y' => 19, 'text' => 'ocarina boy plays again'],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => 'Haunted Grove'],
        ],
        'well' => [
            ['type' => 'small', 'x' => 4, 'y' => 19, 'text' => 'venus, queen of faeries'],
            ['type' => 'large', 'x' => 10, 'y' => 23, 'text' => 'Wishing Well'],
        ],
        'smithy' => [
            ['type' => 'small', 'x' => 4, 'y' => 19, 'text' => 'the dwarven swordsmiths'],
            ['type' => 'large', 'x' => 12, 'y' => 23, 'text' => 'Smithery'],
        ],
        'kakariko2' => [
            ['type' => 'small', 'x' => 6, 'y' => 19, 'text' => 'the bug-catching kid'],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => 'Kakariko Town'],
        ],
        'bridge' => [
            ['type' => 'small', 'x' => 8, 'y' => 19, 'text' => 'the lost old man'],
            ['type' => 'large', 'x' => 9, 'y' => 23, 'text' => 'Death Mountain'],
        ],
        'woods' => [
            ['type' => 'small', 'x' => 8, 'y' => 19, 'text' => 'the forest thief'],
            ['type' => 'large', 'x' => 11, 'y' => 23, 'text' => 'Lost Woods'],
        ],
        'pedestal' => [
            ['type' => 'small', 'x' => 6, 'y' => 19, 'text' => 'and the master sword'],
            ['type' => 'small_alt', 'x' => 8, 'y' => 21, 'text' => 'sleeps again...'],
            ['type' => 'large', 'x' => 12, 'y' => 23, 'text' => 'Forever!'],
        ],
    ];

    public function updateCreditLine(string $scene, int $line, string $text, string $align = 'center')
    {
        if (!isset($this->scenes[$scene][$line])) {
            return false;
        }

        $text = substr($text, 0, 32);

        $this->scenes[$scene][$line]['text'] = $text;

        switch ($align) {
            case 'left':
                $this->scenes[$scene][$line]['x'] = 0;
                break;
            case 'right':
                $this->scenes[$scene][$line]['x'] = (int) max(0, 32 - strlen($text));
                break;
            case 'center':
            default:
                $this->scenes[$scene][$line]['x'] = (int) max(0, floor((32 - strlen($text)) / 2));
                break;
        }
    }

    public function getBinaryData(): array
    {
        $pointers = [];
        $data = [];
        foreach ($this->scenes as $scene) {
            array_push($pointers, count($data));
            foreach ($scene as $part) {
                switch ($part['type']) {
                    case 'small':
                        $data = array_merge($data, $this->getSmallConverted($part));
                        break;
                    case 'small_alt':
                        $data = array_merge($data, $this->getSmallAltConverted($part));
                        break;
                    case 'large':
                        $data = array_merge($data, $this->getLargeConverted($part));
                        break;
                }
            }
        }
        array_push($pointers, count($data));

        return [
            'pointers' => $pointers,
            'data' => $data,
        ];
    }

    // @TODO: consider making the records a proper type
    protected function getSmallConverted(array $record)
    {
        $data = [];

        $converted_text = $this->convertCredits($record['text']);
        $header = $this->getHeader($record['x'], $record['y'], count($converted_text));
        $data = array_merge($header, $converted_text);

        // special handler for apostrophies
        $apostrophies = (string) preg_replace("/'/", ',', (string) preg_replace("/[^']/", " ", (string) $record['text']));
        if (trim($apostrophies)) {
            $converted_text = $this->convertCredits(trim($apostrophies));
            $header = $this->getHeader($record['x'] + strpos($apostrophies, ','), $record['y'] - 1, count($converted_text));
            $data = array_merge($data, $header, $converted_text);
        }

        // special handler for commas
        $commas = (string) preg_replace("/,/", "'", (string) preg_replace("/[^,]/", " ", (string) $record['text']));
        if (trim($commas)) {
            $converted_text = $this->convertCredits(trim($commas));
            $header = $this->getHeader($record['x'] + strpos($commas, "'"), $record['y'] + 1, count($converted_text));
            $data = array_merge($data, $header, $converted_text);
        }

        return $data;
    }

    protected function getSmallAltConverted(array $record)
    {
        $converted_text = $this->convertAltCredits($record['text']);
        $header = $this->getHeader($record['x'], $record['y'], count($converted_text));
        return array_merge($header, $converted_text);
    }

    protected function getlargeConverted(array $record)
    {
        $data = [];

        $converted_text = $this->convertLargeCreditsTop($record['text']);
        $header = $this->getHeader($record['x'], $record['y'], count($converted_text));
        $data = array_merge($header, $converted_text);

        $converted_text = $this->convertLargeCreditsBottom($record['text']);
        $header = $this->getHeader($record['x'], $record['y'] + 1, count($converted_text));
        $data = array_merge($data, $header, $converted_text);

        return $data;
    }

    protected function getHeader($x, $y, $length)
    {
        return unpack('C*', pack('N', (0x6000
            | ($y >> 5 << 11) | (($y & 0x1F) << 5)
            | ($x >> 5 << 10) | ($x & 0x1F)) << 16
            | ($length * 2 - 1)));
    }

    /**
     * Convert string to byte array for Credits that can be written to ROM
     *
     * @param string $string string to convert
     *
     * @return array
     */
    public function convertLargeCreditsTop(string $string): array
    {
        $byte_array = [];
        foreach (str_split(strtolower($string)) as $char) {
            if (!preg_match('/[a-z]/', $char)) {
                switch ($char) {
                    case "'":
                        $byte_array[] = 0x77;
                        break;
                    case '!':
                        $byte_array[] = 0x78;
                        break;
                    default:
                        $byte_array[] = 0x9F;
                        break;
                }
                continue;
            }

            $byte_array[] = ord($char) - 0x4;
        }

        return $byte_array;
    }

    /**
     * Convert string to byte array for Credits that can be written to ROM
     *
     * @param string $string string to convert
     *
     * @return array
     */
    public function convertLargeCreditsBottom(string $string): array
    {
        $byte_array = [];
        foreach (str_split(strtolower($string)) as $char) {
            if (!preg_match('/[a-z]/', $char)) {
                switch ($char) {
                    case "'":
                        $byte_array[] = 0x9D;
                        break;
                    case '!':
                        $byte_array[] = 0x9E;
                        break;
                    default:
                        $byte_array[] = 0x9F;
                        break;
                }
                continue;
            }

            $byte_array[] = ord($char) + 0x22;
        }

        return $byte_array;
    }

    /**
     * Convert string to byte array for Credits that can be written to ROM
     *
     * @param string $string string to convert
     *
     * @return array
     */
    public function convertAltCredits(string $string): array
    {
        $byte_array = [];
        foreach (str_split(strtolower($string)) as $char) {
            $byte_array[] = $this->charToAltCreditsHex($char);
        }

        return $byte_array;
    }

    /**
     * Convert character to byte for ROM in Credits Sequence
     *
     * @param string $char character to convert
     *
     * @return int
     */
    private function charToAltCreditsHex(string $char): int
    {
        if (preg_match('/[a-z]/', $char)) {
            return ord($char) - 0x29;
        }
        switch ($char) {
            case '.':
                return 0x52;
            default:
                return 0x9F;
        }
    }

    /**
     * Convert string to byte array for Credits that can be written to ROM
     *
     * @param string $string string to convert
     *
     * @return array
     */
    public function convertCredits(string $string): array
    {
        $byte_array = [];
        foreach (str_split(strtolower($string)) as $char) {
            $byte_array[] = $this->charToCreditsHex($char);
        }

        return $byte_array;
    }

    /**
     * Convert character to byte for ROM in Credits Sequence
     *
     * @param string $char character to convert
     *
     * @return int
     */
    private function charToCreditsHex(string $char): int
    {
        if (preg_match('/[a-z]/', $char)) {
            return ord($char) - 0x47;
        }
        switch ($char) {
            case ' ':
                return 0x9F;
            case ',':
                return 0x34;
            case '.':
                return 0x37;
            case '-':
                return 0x36;
            case "'":
                return 0x35;
            default:
                return 0x9F;
        }
    }
}
