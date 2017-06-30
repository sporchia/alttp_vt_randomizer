<?php

use ALttP\Console\Commands\Distribution;

Artisan::command('alttp:romtospr {rom} {output}', function ($rom, $output) {
	if (filesize($rom) == 1048576 || filesize($rom) == 2097152) {
		file_put_contents($output, file_get_contents($rom, false, null, 0x80000, 0x7000)
			. file_get_contents($rom, false, null, 0xDD308, 120));
	}
});

// this is a dirty hack to get some stats fast
// @TODO: make this a proper command, and clean it up
Artisan::command('alttp:ss {dir} {outdir}', function($dir, $outdir) {
	$files = scandir($dir);
	$out = [
		'items' => [
			'spheres' => [],
		],
		'locations' => [
			'spheres' => [],
		],
	];
	foreach ($files as $file) {
		$data = json_decode(file_get_contents("$dir/$file"), true);
		if (!$data) {
			continue;
		}
		foreach ($data['playthrough'] as $key => $sphere) {
			if (!is_numeric($key)) {
				continue;
			}
			foreach (array_collapse($sphere) as $location => $item) {
				if (strpos($item, 'Bottle') === 0) {
					$item = 'Bottle';
				}
				if (!isset($out['items']['spheres'][$key][$item])) {
					$out['items']['spheres'][$key][$item] = 0;
				}
				if (!isset($out['locations']['spheres'][$key][$location])) {
					$out['locations']['spheres'][$key][$location] = 0;
				}
				++$out['items']['spheres'][$key][$item];
				++$out['locations']['spheres'][$key][$location];
			}
		}
	}
	$items = $out['items']['spheres'];
	$items = Distribution::_assureColumnsExist($items);
	ksortr($items);
	$csv = fopen("$outdir/item_sphere.csv", 'w');
	fputcsv($csv, array_merge(['item'], array_keys(reset($items))));
	foreach ($items as $name => $item) {
		fputcsv($csv, array_merge([$name], $item));
	}
	fclose($csv);

	$locations = $out['locations']['spheres'];
	$locations = Distribution::_assureColumnsExist($locations);
	ksortr($locations);
	$csv = fopen("$outdir/location_sphere.csv", 'w');
	fputcsv($csv, array_merge(['item'], array_keys(reset($locations))));
	foreach ($locations as $name => $location) {
		fputcsv($csv, array_merge([$name], $location));
	}
	fclose($csv);
});
