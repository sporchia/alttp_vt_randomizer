<?php

/**
 * mb_wordwrap
 *
 * @param string $str
 * @param int $width
 * @param string $break
 * @param bool $cut
 *
 * @return string
 */
function mb_wordwrap(string $str, int $width = 75, string $break = "\n", bool $cut = false): string
{
    if (mb_strlen($str) === strlen($str)) {
        return wordwrap($str, $width, $break, $cut);
    }

    $lines = explode($break, $str);

    if ($lines === false) {
        return $str;
    }

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
