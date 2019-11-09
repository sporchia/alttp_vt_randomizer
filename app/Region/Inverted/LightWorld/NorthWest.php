<?php

namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * North West Light World Region and it's Locations contained within
 */
class NorthWest extends Region\Standard\LightWorld\NorthWest
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["Bush Covered House"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				);
        });

        $this->shops["Bomb Hut"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) && 
					$items->canBombThings();
        });

        // Bunny can pull pedestal
        $this->locations["Master Sword Pedestal"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('PendantOfPower')
                && $items->has('PendantOfWisdom')
                && $items->has('PendantOfCourage');
        });

        $this->locations["King's Tomb"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('PegasusBoots')
				&& (
					$items->has('MoonPearl') 
					|| (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					)
				) && (
					$items->canLiftDarkRocks()
					|| (
						$this->world->config('canMirrorClip', false) 
						&& $items->has('MagicMirror')
						&& $items->has('MoonPearl')
						&& (
							$this->world->config('canBootsClip', false) 
							&& $items->has('PegasusBoots')
						) ||
							$this->world->config('canOneFrameClipOW', false)
						|| (
							$this->world->getRegion('East Death Mountain')->canEnter($locations, $items) 
							&& (
								$this->world->config('canSuperSpeed', false) 
								&& $items->canSpinSpeed()
								&& (
									$items->has('MoonPearl')
									||( 
										$this->world->config('canOWYBA', false) 
										&& $items->hasABottle(2)
				)	)	)	)	)	);
        });

        $this->locations["Kakariko Tavern"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canSuperBunny', false) 
					&& $items->has('MagicMirror')
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Chicken House"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Kakariko Well - Top"]->setRequirements(function ($locations, $items) {
            return 
				$items->canBombThings()
				&& (
					$items->has('MoonPearl')
					|| (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
				)	);
        });

        $this->locations["Kakariko Well - Left"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| $this->world->config('canSuperBunny', false)
				|| (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Kakariko Well - Middle"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| $this->world->config('canSuperBunny', false)
				|| (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Kakariko Well - Right"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| $this->world->config('canSuperBunny', false)
				|| (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Kakariko Well - Bottom"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| $this->world->config('canSuperBunny', false)
				|| (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Blind's Hideout - Top"]->setRequirements(function ($locations, $items) {
            return 
				$items->canBombThings()
				&& (
					$items->has('MoonPearl')
					|| (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
				)	);
        });

        $this->locations["Blind's Hideout - Left"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canSuperBunny', false) 
					&& $items->has('MagicMirror')
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Blind's Hideout - Right"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canSuperBunny', false) 
					&& $items->has('MagicMirror')
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Blind's Hideout - Far Left"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canSuperBunny', false) 
					&& $items->has('MagicMirror')
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Blind's Hideout - Far Right"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canSuperBunny', false) 
					&& $items->has('MagicMirror')
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				);
        });

        $this->locations["Pegasus Rocks"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('PegasusBoots') 
				&& (
					$items->has('MoonPearl')
					|| (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
				)	);
        });

        $this->locations["Magic Bat"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('Powder')
				&& (
					$items->has('MoonPearl')
					|| (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					)
				) && (
					$items->has('Hammer')
					|| (
						(
							$this->world->config('canBootsClip', false) 
							&& $items->has('PegasusBoots')
						) || 
							$this->world->config('canOneFrameClipOW', false)
					) && (
						$this->world->config('canFakeFlipper', false) 
						|| $items->has('Flippers')
				)	);
        });

        $this->locations["Sick Kid"]->setRequirements(function ($locations, $items) {
            return 
				$items->hasBottle();
        });

        $this->locations["Lumberjack Tree"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('DefeatAgahnim') 
				&& (
					$items->has('PegasusBoots') 
					&& (
						$items->has('MoonPearl')
						|| (
							$this->world->config('canBunnyRevive', false) 
							&& $items->canBunnyRevive()
						) || (
							$this->world->config('canOWYBA', false) 
							&& $items->hasABottle()
						)
					) || 
						$this->world->config('canOneFrameClipOW', false)
					|| (
						$this->world->config('canMirrorWrap', false) 
						&& $items->has('MagicMirror')
				)	);
		});

        $this->locations["Graveyard Ledge"]->setRequirements(function ($locations, $items) {
            return 
				(
					$items->has('MoonPearl') 
					|| (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					)
				) && 
					$items->canBombThings();
        });

        $this->locations["Mushroom"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				);
        });

        $this->locations["Lost Woods Hideout"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('MoonPearl')
				|| (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				);
        });

        $this->can_enter = function ($locations, $items) {
            return 
				$this->world->getRegion('North East Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
