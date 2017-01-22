<?php
/**
 * Shuffle the contents of an array using mt_rand
 *
 * @param array $array array to shuffle
 *
 * @return array
 */
function mt_shuffle(array $array) {
	$new_array = [];
	while(count($array)) {
		$pull_key = mt_rand(0, count($array) - 1);
		$new_array = array_merge($new_array, array_splice($array, $pull_key, 1));
	}
	return $new_array;
}

/**
 * Sort array by key recursively (this is basically an extension of ksort)
 * @see http://php.net/manual/en/function.ksort.php
 *
 * @param array &$array array to sort
 * @param int $sort_flags optional sort flags see PHP's sort() function for details
 *
 * @return bool
 */
function ksortr(array &$array, int $sort_flags = SORT_REGULAR) {
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
