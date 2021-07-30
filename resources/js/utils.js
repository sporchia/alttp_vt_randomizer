export function fy_shuffle(array, rand) {
    let new_array = Array.from(array);

	for (let i = array.length - 1; i >= 0; --i) {
		let r = rand.nextInt(0, i);
		[new_array[i], new_array[r]] = [new_array[r], new_array[i]];
	}

	return new_array;
};

export function int16_as_bytes(value) {
	value = value & 0xffff;
	return [value & 0xff, (value >> 8) & 0xff];
};