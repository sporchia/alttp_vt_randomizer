<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Turtle Rock Region and it's Locations contained within
 */
class TurtleRock extends Region\Standard\TurtleRock {
	protected function enterTopNoGlitches($locations, $items) {
		return ((($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
				&& ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword()))
			&& $items->has('CaneOfSomaria')
			&& $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items);
	}

	protected function enterMiddleNoGlitches($locations, $items) {
		return $items->has('MagicMirror')
			&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
	}

	protected function enterBottomNoGlitches($locations, $items) {
		return $items->has('MagicMirror')
			&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
	}

	protected function enterTopOverworldGlitches($locations, $items) {
		return $this->enterTopNoGlitches($locations, $items);
	}

	protected function enterMiddleOverworldGlitches($locations, $items) {
		return $this->enterMiddleNoGlitches($locations, $items)
			|| ($this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items)
				&& $items->has('PegasusBoots')
				&& ($items->has('Hookshot') || $items->hasSword(1)));
	}

	protected function enterBottomOverworldGlitches($locations, $items) {
		return $this->enterBottomNoGlitches($locations, $items);
	}

	protected function enterTopMajorGlitches($locations, $items) {
		return $this->enterTopOverworldGlitches($locations, $items);
	}

	protected function enterMiddleMajorGlitches($locations, $items) {
		return $this->enterMiddleOverworldGlitches($locations, $items);
	}

	protected function enterBottomMajorGlitches($locations, $items) {
		return $this->enterBottomOverworldGlitches($locations, $items);
	}

	protected function enterTopNone($locations, $items) {
		return true;
	}

	protected function enterMiddleNone($locations, $items) {
		return true;
	}

	protected function enterBottomNone($locations, $items) {
		return true;
	}

	protected function enterTop($locations, $items) {
		return call_user_func([$this, 'enterTop' . $this->world->logic], $locations, $items);
	}

	protected function enterMiddle($locations, $items) {
		return call_user_func([$this, 'enterMiddle' . $this->world->logic], $locations, $items);
	}

	protected function enterBottom($locations, $items) {
		return call_user_func([$this, 'enterBottom' . $this->world->logic], $locations, $items);
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->locations["Turtle Rock - Chain Chomps"]->setRequirements(function($locations, $items) {
			return ($this->enterTop($locations, $items) && $items->has('KeyD7'))
				|| $this->enterMiddle($locations, $items)
				|| ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria'));
		});

		$this->locations["Turtle Rock - Roller Room - Left"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& ($this->enterTop($locations, $items)
					|| ($this->enterMiddle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Right",
								"Turtle Rock - Compass Chest",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4)))
				|| ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyD7', 4)));
		});

		$this->locations["Turtle Rock - Roller Room - Right"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& ($this->enterTop($locations, $items)
					|| ($this->enterMiddle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Left",
								"Turtle Rock - Compass Chest",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4)))
				|| ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyD7', 4)));
		});

		$this->locations["Turtle Rock - Compass Chest"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria')
				&& ($this->enterTop($locations, $items)
					|| ($this->enterMiddle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Left",
								"Turtle Rock - Roller Room - Right",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4)))
					|| ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyD7', 4)));
		});

		$this->locations["Turtle Rock - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD7')
				&& (($this->enterTop($locations, $items) && $items->has('KeyD7', 2))
					|| ($this->enterMiddle($locations, $items) && ($items->has('Hookshot') || $items->has('CaneOfSomaria')))
					|| ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria')));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["Turtle Rock - Big Key Chest"]->setRequirements(function($locations, $items) {
			return (($this->enterTop($locations, $items) || $this->enterMiddle($locations, $items)) && $items->has('KeyD7', 2))
				|| ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('KeyD7', 4));
		});

		$this->locations["Turtle Rock - Crystaroller Room"]->setRequirements(function($locations, $items) {
			return ($items->has('BigKeyD7') && (($this->enterTop($locations, $items) && $items->has('KeyD7', 2))
				|| $this->enterMiddle($locations, $items))
				|| ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria')));
		});

		$this->locations["Turtle Rock - Eye Bridge - Bottom Left"]->setRequirements(function($locations, $items) {
			return ($this->enterBottom($locations, $items)
				|| (($this->enterTop($locations, $items) || $this->enterMiddle($locations, $items)) &&
					$items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Bottom Right"]->setRequirements(function($locations, $items) {
			return ($this->enterBottom($locations, $items)
				|| (($this->enterTop($locations, $items) || $this->enterMiddle($locations, $items)) &&
					$items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Top Left"]->setRequirements(function($locations, $items) {
			return ($this->enterBottom($locations, $items)
				|| (($this->enterTop($locations, $items) || $this->enterMiddle($locations, $items)) &&
					$items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Top Right"]->setRequirements(function($locations, $items) {
			return ($this->enterBottom($locations, $items)
				|| (($this->enterTop($locations, $items) || $this->enterMiddle($locations, $items)) &&
					$items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->can_complete = function($locations, $items) {
			return $this->locations["Turtle Rock - Boss"]->canAccess($items);
		};

		$this->locations["Turtle Rock - Boss"]->setRequirements(function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('KeyD7', 4)
				&& $items->has('Lamp', $this->world->config('item.require.Lamp', 1))
				&& $items->has('BigKeyD7') && $items->has('CaneOfSomaria')
				&& $this->boss->canBeat($items, $locations)
				&& (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD7') || $this->locations["Turtle Rock - Boss"]->hasItem(Item::get('CompassD7')))
				&& (!$this->world->config('region.wildMaps', false) || $items->has('MapD7') || $this->locations["Turtle Rock - Boss"]->hasItem(Item::get('MapD7')));
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& ($item instanceof Item\Key || $item instanceof Item\BigKey
					|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
				return false;
			}

			return true;
		})->setAlwaysAllow(function($item, $items) {
			return $this->world->config('region.bossNormalLocation', true)
				&& ($item == Item::get('CompassD7') || $item == Item::get('MapD7'));
		});

		$this->can_enter = function($locations, $items) {
			return $this->enterTop($locations, $items)
				|| $this->enterMiddle($locations, $items)
				|| $this->enterBottom($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
