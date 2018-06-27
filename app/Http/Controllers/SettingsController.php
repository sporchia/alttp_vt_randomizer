<?php namespace ALttP\Http\Controllers;

use ALttP\Item;
use ALttP\Location;
use ALttP\Rom;
use ALttP\Sprite;
use ALttP\World;
use Cache;
use Illuminate\Http\Request;

class SettingsController extends Controller {
	public function item(Request $request) {
		return config('alttp.randomizer.item');
	}

	public function entrance(Request $request) {
		return config('alttp.randomizer.entrance');
	}

	public function customizer(Request $request) {
		//return Cache::rememberForever('customizer_settings', function() {
			$world = new World;
			$items = Item::all();
			$sprites = Sprite::all();
			return [
				'locations' => array_values($world->getLocations()->filter(function($location) {
					return !$location instanceof Location\Prize\Event;
				})->map(function($location) {
					return [
						'hash' => base64_encode($location->getName()),
						'name' => $location->getName(),
						'region' => $location->getRegion()->getName(),
						'class' => $location instanceof Location\Fountain ? 'bottles'
							: $location instanceof Location\Medallion ? 'medallions'
							: $location instanceof Location\Prize ? 'prizes' : 'items',
					];
				})),
				'items' => $items->filter(function($item) {
					return !$item instanceof Item\Pendant
						&& !$item instanceof Item\Crystal
						&& !$item instanceof Item\Event
						&& !$item instanceof Item\Programmable
						&& !$item instanceof Item\BottleContents
						&& !in_array($item->getName(), [
							'BigKey',
							'Compass',
							'Key',
							'L2Sword',
							'Map',
							'multiRNG',
							'PowerStar',
							'singleRNG',
							'TwentyRupees2',
							'HeartContainerNoAnimation',
						]);
				})->map(function($item) {
					return [
						'value' => $item->getName(),
						'name' => $item->getNiceName(),
						'count' => 0,
						'placed' => 0,
					];
				}),
				'prizes' => $items->filter(function($item) {
					return $item instanceof Item\Pendant
						|| $item instanceof Item\Crystal;
				})->map(function($item) {
					return [
						'value' => $item->getName(),
						'name' => $item->getNiceName(),
						'count' => 0,
						'placed' => 0,
					];
				}),
				'medallions' => $items->filter(function($item) {
					return $item instanceof Item\Medallion;
				})->map(function($item) {
					return [
						'value' => $item->getName(),
						'name' => $item->getNiceName(),
						'count' => 0,
						'placed' => 0,
					];
				}),
				'bottles' => $items->filter(function($item) {
					return $item instanceof Item\Bottle;
				})->map(function($item) {
					return [
						'value' => $item->getName(),
						'name' => $item->getNiceName(),
						'count' => 0,
						'placed' => 0,
					];
				}),
				'droppables' => array_values($sprites->filter(function($sprite) {
					return $sprite instanceof Sprite\Droppable;
				})->map(function($item) {
					return [
						'value' => $item->getName(),
						'name' => $item->getNiceName(),
						'count' => 0,
						'placed' => 0,
					];
				})),
			];
		//});
	}

	public function rom(Request $request) {
		return [
			'rom_hash' => Rom::HASH,
			'base_file' => mix('js/base2current.json')->toHtml(),
		];
	}

	public function sprites(Request $request) {
		$sprites =  [];
		foreach (config('sprites') as $file => $info) {
			$sprites[] = [
				'name' => $info['name'],
				'author' => $info['author'],
				'file' => 'http://spr.beegunslingers.com/' . $file,
			];
		}
		return $sprites;
	}
}
