<?php

/**
 * mb_str_pad
 *
 * @param string $input
 * @param int $pad_length
 * @param string $pad_string
 * @param int $pad_type
 * @param string $encoding
 */
function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = null): string
{
    if (!$encoding) {
        $diff = strlen($input) - mb_strlen($input);
    } else {
        $diff = strlen($input) - mb_strlen($input, $encoding);
    }
    return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
}

/**
 * mb_wordwrap
 *
 * @param string $str
 * @param int $width
 * @param string $break
 * @param bool $cut
 */
function mb_wordwrap(string $str, int $width = 75, string $break = "\n", bool $cut = false): string
{
    if (mb_strlen($str) === strlen($str)) {
        return wordwrap($str, $width, $break, $cut);
    }

    if ($break === "") {
        return $str;
    }

    $lines = explode($break, $str);

    foreach ($lines as &$line) {
        $line = rtrim($line);
        if (mb_strlen($line) <= $width) {
            continue;
        }
        $words = explode(' ', $line);
        $line = '';
        $actual = '';
        foreach ($words as $word) {
            if (mb_strlen($actual . $word) <= $width) {
                $actual .= $word . ' ';
            } else {
                if ($actual != '') {
                    $line .= rtrim($actual) . $break;
                }
                $actual = $word;
                if ($cut) {
                    while (mb_strlen($actual) > $width) {
                        $line .= mb_substr($actual, 0, $width) . $break;
                        $actual = mb_substr($actual, $width);
                    }
                }
                $actual .= ' ';
            }
        }
        $line .= trim($actual);
    }
    return implode($break, $lines);
}
