<?php

/**
 * Shuffle the contents of an array using VT Shuffle
 *
 * @param array $array array to shuffle
 *
 * @return array
 */
function mt_shuffle(array $array)
{
    $new_array = [];
    while (count($array)) {
        $pull_key = get_random_int(0, count($array) - 1);
        $new_array = array_merge($new_array, array_splice($array, $pull_key, 1));
    }
    return $new_array;
}

/**
 * Shuffle the contents of an array using Fisher-Yates shuffle
 *
 * @param array $array array to shuffle
 *
 * @return array
 */
function fy_shuffle(array $array)
{
    $new_array = array_values($array);
    $count = count($array);

    for ($i = $count - 1; $i >= 0; --$i) {
        $r = get_random_int(0, $i);
        [$new_array[$i], $new_array[$r]] = [$new_array[$r], $new_array[$i]];
    }

    return $new_array;
}

/**
 * Random weighted select from array using mt_rand and weights
 *
 * @param array $array array to pick from
 * @param array $weights weights of array to pick from
 * @param int $pick number of items to pick
 *
 * @return array
 */
function weighted_random_pick(array $array, array $weights, int $pick = 1)
{
    $picked = [];
    $total_weight = (int) array_sum($weights);
    while (--$pick >= 0) {
        $random_pick = get_random_int(1, $total_weight);
        $current = 0;
        foreach ($array as $key => $item) {
            $current += $weights[$key];
            if ($random_pick <= $current) {
                $picked[] = $item;
                break;
            }
        }
    }
    return $picked;
}

/**
 * Sort array by key recursively (this is basically an extension of ksort)
 * @see http://php.net/manual/en/function.ksort.php
 *
 * @param array $array array to sort
 * @param int $sort_flags optional sort flags see PHP's sort() function for details
 *
 * @return bool
 */
function ksortr(array &$array, int $sort_flags = SORT_REGULAR)
{
    if (!is_array($array)) {
        return false;
    }
    ksort($array, $sort_flags);

    foreach ($array as &$sub_array) {
        if (is_array($sub_array)) {
            ksortr($sub_array, $sort_flags);
        }
    }

    return true;
}

/**
 * Second order sort of array
 *
 * @param array $array array to sort
 * @param mixed $index second order index to sort on
 * @param string $order diretion of sort
 * @param bool $natsort flag for natural sort
 * @param bool $case_sensitive flag for case sensitivity
 *
 * @return array
 */
function sabsi(array $array, $index, string $order = 'asc', bool $natsort = false, bool $case_sensitive = false)
{
    if (!count($array)) {
        return $array;
    }

    $temp = [];
    $sorted = [];

    foreach (array_keys($array) as $key) {
        $temp[$key] = $array[$key][$index];
    }

    if ($natsort) {
        if ($case_sensitive) {
            natsort($temp);
        } else {
            natcasesort($temp);
        }
        if ($order != 'asc') {
            $temp = array_reverse($temp, true);
        }
    } else {
        if ($order == 'asc') {
            asort($temp);
        } else {
            arsort($temp);
        }
    }
    foreach (array_keys($temp) as $key) {
        if (is_numeric($key)) {
            $sorted[] = $array[$key];
        } else {
            $sorted[$key] = $array[$key];
        }
    }
    return $sorted;
}

function hash_array($id)
{
    $ret = 0;
    $id = ($id * 99371) % 33554431;
    for ($i = 0; $i < 25; ++$i) {
        $ret += (($id >> $i) & 1) << ((($i % 5) + 1) * 5 - floor($i / 5));
    }

    return [
        ($ret >> 20) & 0x1F,
        ($ret >> 15) & 0x1F,
        ($ret >> 10) & 0x1F,
        ($ret >> 5) & 0x1F,
        $ret & 0x1F,
    ];
}

/**
 * Take our patch format and merge it down to a more compact version
 *
 * @param array $patch_left Left side of patch
 * @param array $patch_right patch to add to left side
 *
 * @return array
 */
function patch_merge_minify(array $patch_left, array $patch_right = [])
{
    $write_array = [];
    // decompose left
    foreach ($patch_left as $wri) {
        foreach ($wri as $seek => $bytes) {
            for ($i = 0; $i < count($bytes); $i++) {
                $write_array[$seek + $i] = [$bytes[$i]];
            }
        }
    }
    unset($patch_left);
    // decompose right and overwrite
    foreach ($patch_right as $wri) {
        foreach ($wri as $seek => $bytes) {
            for ($i = 0; $i < count($bytes); $i++) {
                $write_array[$seek + $i] = [$bytes[$i]];
            }
        }
    }
    unset($patch_right);
    $out = $write_array;
    unset($write_array);
    ksort($out);

    $backwards = array_reverse($out, true);

    // merge down
    foreach ($backwards as $off => $value) {
        if (isset($backwards[$off - 1])) {
            $backwards[$off - 1] = array_merge($backwards[$off - 1], $backwards[$off]);
            unset($backwards[$off]);
        }
    }

    $forwards = array_reverse($backwards, true);
    unset($backwards);

    array_walk($forwards, function (&$write, $address) {
        $write = [$address => $write];
    });

    return array_values($forwards);
}
