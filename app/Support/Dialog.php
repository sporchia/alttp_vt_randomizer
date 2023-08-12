<?php

namespace ALttP\Support;

/**
 * Dialog Conversion
 */
class Dialog
{
    /**
     * Convert string to byte array for Dialog Box that can be written to ROM
     *
     * @param string $string string to convert
     * @param int $max_bytes maximum bytes to return
     *
     * @return array
     */
    public function convertDialog(string $string, $max_bytes = 256)
    {
        $new_string = [];
        $lines = explode("\n", $string);
        $i = 0;
        foreach ($lines as $line) {
            switch ($i) {
                case 0:
                    $new_string[] = 0x74;
                    break;
                case 1:
                    $new_string[] = 0x75;
                    break;
                case 2:
                default:
                    $new_string[] = 0x76;
                    break;
            }

            $line_chars = preg_split('//u', mb_substr($line, 0, 19), null, PREG_SPLIT_NO_EMPTY);

            if ($line_chars === false) {
                continue;
            }

            foreach ($line_chars as $char) {
                $write = $this->charToHex($char);
                if ($write[0] == 0xFD) {
                    $new_string = array_merge($new_string, $write);
                } else {
                    foreach ($write as $byte) {
                        $new_string = array_merge($new_string, array_pad([$byte], -2, 0x00));
                    }
                }
            }
            if (++$i % 3 == 0 && count($lines) > $i) {
                $new_string[] = 0x7E;
            }
            if ($i >= 3 && $i < count($lines)) {
                $new_string[] = 0x73;
            }
        }

        $new_string[] = 0x7F;
        if (count($new_string) > $max_bytes) {
            return array_merge(array_slice($new_string, 0, $max_bytes - 1), [0x7F]);
        }
        return $new_string;
    }

    /**
     * Convert string to byte array for Compressed Dialog Box that can be written to ROM
     *
     * @param string $string string to convert
     * @param bool $pause whether to pause for input
     * @param int $max_bytes maximum bytes to return
     * @param int $wrap if greater than 0 wrap lines to this value
     *
     * @return array
     */
    public function convertDialogCompressed(string $string, $pause = true, $max_bytes = 2046, $wrap = 19)
    {
        $pad_out = false;
        $new_string = [0xFB];
        $lines = explode("\n", $string);
        if ($wrap > 0) {
            $new_lines = [];
            foreach ($lines as $line) {
                $new_line = mb_wordwrap($line, $wrap, "\n");
                $new_lines = array_merge($new_lines, explode("\n", $new_line));
            }
            $lines = $new_lines;
        }
        $i = 0;
        $line_count = (substr((string) end($lines), 0, 1) == '{') ? count($lines) - 1 : count($lines);
        foreach ($lines as $line) {
            $line_chars = preg_split('//u', mb_substr($line, 0, 19), null, PREG_SPLIT_NO_EMPTY);
            if ($line_chars === false) {
                continue;
            }
            // command
            // @TODO: refactor this to use regex
            if (reset($line_chars) == "{") {
                switch (trim($line)) {
                    case "{SPEED0}":
                        $new_string = array_merge($new_string, [0xFC, 0x00]);
                        break;
                    case "{SPEED2}":
                        $new_string = array_merge($new_string, [0xFC, 0x02]);
                        break;
                    case "{SPEED6}":
                        $new_string = array_merge($new_string, [0xFC, 0x06]);
                        break;
                    case "{PAUSE1}":
                        $new_string = array_merge($new_string, [0xFE, 0x78, 0x01]);
                        break;
                    case "{PAUSE3}":
                        $new_string = array_merge($new_string, [0xFE, 0x78, 0x03]);
                        break;
                    case "{PAUSE5}":
                        $new_string = array_merge($new_string, [0xFE, 0x78, 0x05]);
                        break;
                    case "{PAUSE7}":
                        $new_string = array_merge($new_string, [0xFE, 0x78, 0x07]);
                        break;
                    case "{PAUSE9}":
                        $new_string = array_merge($new_string, [0xFE, 0x78, 0x09]);
                        break;
                    case "{INPUT}":
                        $new_string = array_merge($new_string, [0xFA]);
                        break;
                    case "{CHOICE}":
                        $new_string = array_merge($new_string, [0xFE, 0x68]);
                        break;
                    case "{ITEMSELECT}":
                        $new_string = array_merge($new_string, [0xFE, 0x69]);
                        break;
                    case "{CHOICE2}":
                        $new_string = array_merge($new_string, [0xFE, 0x71]);
                        break;
                    case "{CHOICE3}":
                        $new_string = array_merge($new_string, [0xFE, 0x72]);
                        break;
                    case "{C:GREEN}":
                        $new_string = array_merge($new_string, [0xFE, 0x77, 0x07]);
                        break;
                    case "{C:YELLOW}":
                        $new_string = array_merge($new_string, [0xFE, 0x77, 0x02]);
                        break;
                    case "{HARP}":
                        $new_string = array_merge($new_string, [0xFE, 0x79, 0x2D]);
                        break;
                    case "{MENU}":
                        $new_string = array_merge($new_string, [0xFE, 0x6D, 0x00]);
                        break;
                    case "{BOTTOM}":
                        $new_string = array_merge($new_string, [0xFE, 0x6D, 0x01]);
                        break;
                    case "{NOBORDER}":
                        $new_string = array_merge($new_string, [0xFE, 0x6B, 0x02]);
                        break;
                    case "{CHANGEPIC}":
                        $new_string = array_merge($new_string, [0xFE, 0x67, 0xFE, 0x67]);
                        break;
                    case "{CHANGEMUSIC}":
                        $new_string = array_merge($new_string, [0xFE, 0x67]);
                        break;
                    case "{INTRO}":
                        $pad_out = true;
                        $new_string = array_merge($new_string, [0xFE, 0x6E, 0x00, 0xFE, 0x77, 0x07, 0xFC, 0x03, 0xFE, 0x6B, 0x02, 0xFE, 0x67]);
                        break;
                    case "{NOTEXT}":
                        return [0xFB, 0xFE, 0x6E, 0x00, 0xFE, 0x6B, 0x04];
                    case "{IBOX}":
                        $new_string = array_merge($new_string, [0xFE, 0x6B, 0x02, 0xFE, 0x77, 0x07, 0xFC, 0x03, 0xF7]);
                        break;
                }
                $line_count--;
                if (count($new_string) > $max_bytes) {
                    throw new \Exception("command overflowed byte length");
                }
                continue;
            }

            switch ($i) {
                case 0:
                    break;
                case 1:
                    $new_string[] = 0xF8; // row 2
                    break;
                case 2:
                default:
                    if ($i >= 3 && $i < count($lines)) {
                        $new_string[] = 0xF6; // scroll
                    } else {
                        $new_string[] = 0xF9; // row 3
                    }
                    break;
            }

            // the first box needs to fill the full width with spaces as the palette is loaded weird.
            if ($pad_out && $i < 3) {
                $line_chars = array_pad($line_chars, 19, ' ');
            }

            foreach ($line_chars as $char) {
                $new_string = array_merge($new_string, $this->charToHex($char));
            }
            $i++;

            if ($pause && $i % 3 == 0 && $line_count > $i) {
                $new_string[] = 0xFA; // wait for input
            }
        }

        if (count($new_string) > $max_bytes) {
            return array_merge(array_slice($new_string, 0, $max_bytes));
        }
        return $new_string;
    }

    private static $characters = [
        ' ' => [0xFF],
        "≥" => [0x99], // cursor
        "…" => [0x9F],
        '?' => [0xC6],
        '!' => [0xC7],
        ',' => [0xC8],
        '-' => [0xC9],
        '.' => [0xCD],
        '~' => [0xCE],
        '～' => [0xCE],
        "'" => [0x9D],
        "’" => [0x9D],
        "@" => [0xFE, 0x6A], // link's name compressed
        ">" => [0x9B, 0x9C], // link face
        "%" => [0xFD, 0x10], // Hylian Bird
        "^" => [0xFD, 0x11], // Hylian Ankh
        "=" => [0xFD, 0x12], // Hylian Wavy lines
        "↑" => [0xFD, 0x13],
        "↓" => [0xFD, 0x14],
        "→" => [0xFD, 0x15],
        "←" => [0xFD, 0x16],
        "¼" => [0xE5, 0xE7], // ¼ heart
        "½" => [0xE6, 0xE7], // ½ heart
        "¾" => [0xE8, 0xE9], // ¾ heart
        "♥" => [0xEA, 0xEB], // full heart
        "ᚋ" => [0xFE, 0x6C, 0x00], // var 0
        "ᚌ" => [0xFE, 0x6C, 0x01], // var 1
        "ᚍ" => [0xFE, 0x6C, 0x02], // var 2
        "ᚎ" => [0xFE, 0x6C, 0x03], // var 3
        "あ" => [0x00],
        "い" => [0x01],
        "う" => [0x02],
        "え" => [0x03],
        "お" => [0x04],
        "や" => [0x05],
        "ゆ" => [0x06],
        "よ" => [0x07],
        "か" => [0x08],
        "き" => [0x09],
        "く" => [0x0A],
        "け" => [0x0B],
        "こ" => [0x0C],
        "わ" => [0x0D],
        "を" => [0x0E],
        "ん" => [0x0F],
        "さ" => [0x10],
        "し" => [0x11],
        "す" => [0x12],
        "せ" => [0x13],
        "そ" => [0x14],
        "が" => [0x15],
        "ぎ" => [0x16],
        "ぐ" => [0x17],
        "た" => [0x18],
        "ち" => [0x19],
        "つ" => [0x1A],
        "て" => [0x1B],
        "と" => [0x1C],
        "げ" => [0x1D],
        "ご" => [0x1E],
        "ざ" => [0x1F],
        "な" => [0x20],
        "に" => [0x21],
        "ぬ" => [0x22],
        "ね" => [0x23],
        "の" => [0x24],
        "じ" => [0x25],
        "ず" => [0x26],
        "ぜ" => [0x27],
        "は" => [0x28],
        "ひ" => [0x29],
        "ふ" => [0x2A],
        "へ" => [0x2B],
        "ほ" => [0x2C],
        "ぞ" => [0x2D],
        "だ" => [0x2E],
        "ぢ" => [0x2F],
        "ま" => [0x30],
        "み" => [0x31],
        "む" => [0x32],
        "め" => [0x33],
        "も" => [0x34],
        "づ" => [0x35],
        "で" => [0x36],
        "ど" => [0x37],
        "ら" => [0x38],
        "り" => [0x39],
        "る" => [0x3A],
        "れ" => [0x3B],
        "ろ" => [0x3C],
        "ば" => [0x3D],
        "び" => [0x3E],
        "ぶ" => [0x3F],
        "べ" => [0x40],
        "ぼ" => [0x41],
        "ぱ" => [0x42],
        "ぴ" => [0x43],
        "ぷ" => [0x44],
        "ぺ" => [0x45],
        "ぽ" => [0x46],
        "ゃ" => [0x47],
        "ゅ" => [0x48],
        "ょ" => [0x49],
        "っ" => [0x4A],
        "ぁ" => [0x4B],
        "ぃ" => [0x4C],
        "ぅ" => [0x4D],
        "ぇ" => [0x4E],
        "ぉ" => [0x4F],
        "ア" => [0x50],
        "イ" => [0x51],
        "ウ" => [0x52],
        "エ" => [0x53],
        "オ" => [0x54],
        "ヤ" => [0x55],
        "ユ" => [0x56],
        "ヨ" => [0x57],
        "カ" => [0x58],
        "キ" => [0x59],
        "ク" => [0x5A],
        "ケ" => [0x5B],
        "コ" => [0x5C],
        "ワ" => [0x5D],
        "ヲ" => [0x5E],
        "ン" => [0x5F],
        "サ" => [0x60],
        "シ" => [0x61],
        "ス" => [0x62],
        "セ" => [0x63],
        "ソ" => [0x64],
        "ガ" => [0x65],
        "ギ" => [0x66],
        "グ" => [0x67],
        "タ" => [0x68],
        "チ" => [0x69],
        "ツ" => [0x6A],
        "テ" => [0x6B],
        "ト" => [0x6C],
        "ゲ" => [0x6D],
        "ゴ" => [0x6E],
        "ザ" => [0x6F],
        "ナ" => [0x70],
        "ニ" => [0x71],
        "ヌ" => [0x72],
        "ネ" => [0x73],
        "ノ" => [0x74],
        "ジ" => [0x75],
        "ズ" => [0x76],
        "ゼ" => [0x77],
        "ハ" => [0x78],
        "ヒ" => [0x79],
        "フ" => [0x7A],
        "ヘ" => [0x7B],
        "ホ" => [0x7C],
        "ゾ" => [0x7D],
        "ダ" => [0x7E],
        "マ" => [0x80],
        "ミ" => [0x81],
        "ム" => [0x82],
        "メ" => [0x83],
        "モ" => [0x84],
        "ヅ" => [0x85],
        "デ" => [0x86],
        "ド" => [0x87],
        "ラ" => [0x88],
        "リ" => [0x89],
        "ル" => [0x8A],
        "レ" => [0x8B],
        "ロ" => [0x8C],
        "バ" => [0x8D],
        "ビ" => [0x8E],
        "ブ" => [0x8F],
        "ベ" => [0x90],
        "ボ" => [0x91],
        "パ" => [0x92],
        "ピ" => [0x93],
        "プ" => [0x94],
        "ペ" => [0x95],
        "ポ" => [0x96],
        "ャ" => [0x97],
        "ュ" => [0x98],
        "ョ" => [0x99],
        "ッ" => [0x9A],
        "ァ" => [0x9B],
        "ィ" => [0x9C],
        "ゥ" => [0x9D],
        "ェ" => [0x9E],
        "ォ" => [0x9F],
    ];

    /**
     * Convert character to byte for ROM
     *
     * @param string $char character to convert
     *
     * @return array
     */
    private function charToHex(string $char): array
    {
        if (preg_match('/\d/', $char)) {
            return [(int) $char + 0xA0];
        }

        if (preg_match('/[A-Z]/', $char)) {
            return [ord($char) - 65 + 0xAA];
        }

        if (preg_match('/[a-z]/', $char)) {
            return [ord($char) + 0x6F];
        }

        return self::$characters[$char] ?? [0xFF];
    }
}
