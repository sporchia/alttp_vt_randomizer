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
