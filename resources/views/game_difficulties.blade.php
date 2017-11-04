@extends('layouts.default')

@section('content')
<h1>What are the different Difficulties?</h1>
<div class="well">
<p>Difficulty will affect what items one has avilable to them to complete the game as well as modify some of the
	usages of items.</p>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Easy</h3>
		</div>
		<div class="panel-body">
			<p>Easy is like Normal, but makes it easier travelling through hyrule. While you
				will never find more than 4 swords, there are twice as many chances to get an upgrade.</p>
			<p>Items that have 2x chance of finding:</p>
			<ul>
				<li>Swords</li>
				<li>Armors</li>
				<li>Shields</li>
				<li>Bottles</li>
				<li>½ Magic</li>
			</ul>
			<p>finding the second ½ Magic tucked away in easy will get you ¼ Magic</p>
		</div>
	</div>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Normal</h3>
		</div>
		<div class="panel-body">
			<p>This is the standard game item pool. no special rules or adjustments have been changes with
				items or counts from what one would find in the original game.</p>
			<p>Item pool:</p>
			<div class="row">
				<div class="col-md-6">
					<ul>
						<li>6x Arrow Upgrade (+5)</li>
						<li>1x Arrow Upgrade (+10)</li>
						<li>1x Single Arrow</li>
						<li>10x Big Key</li>
						<li>1x Blue Mail</li>
						<li>6x Bomb Upgrade (+5)</li>
						<li>1x Bomb Upgrade (+10)</li>
						<li>1x Bombos</li>
						<li>1x Book Of Mudora</li>
						<li>1x Boomerang</li>
						<li>4x Bottle (filled with assorted things)</li>
						<li>1x Bow</li>
						<li>1x Bug Catching Net</li>
						<li>1x Cane Of Byrna</li>
						<li>1x Cane Of Somaria</li>
						<li>11x Compass</li>
						<li>12x Dungeon Map</li>
						<li>1x Ether</li>
						<li>7x Fifty Rupees</li>
						<li>1x Fighters Shield</li>
						<li>1x Fighters Sword</li>
						<li>1x Fire Rod</li>
						<li>1x Fire Shield</li>
						<li>4x Five Rupees</li>
						<li>1x Flippers</li>
						<li>1x Flute</li>
						<li>1x Golden Sword</li>
						<li>1x ½ Magic</li>
						<li>1x Hammer</li>
					</ul>
				</div>
				<div class="col-md-6">
					<ul>
						<li>1x Sanctuary Heart Container</li>
						<li>10x Heart Container</li>
						<li>1x Hookshot</li>
						<li>1x Ice Rod</li>
						<li>28x Small Key</li>
						<li>1x Lamp</li>
						<li>1x Magic Cape</li>
						<li>1x Magic Mirror</li>
						<li>1x Magic Powder</li>
						<li>1x Magical Boomerang</li>
						<li>1x Master Sword</li>
						<li>1x Mirror Shield</li>
						<li>1x Moon Pearl</li>
						<li>1x Mushroom</li>
						<li>1x One Hundred Rupees</li>
						<li>2x One Rupee</li>
						<li>1x Pegasus Boots</li>
						<li>24x Piece Of Heart</li>
						<li>1x Power Glove</li>
						<li>1x Quake</li>
						<li>1x Red Mail</li>
						<li>1x Shovel</li>
						<li>1x Silver Arrows Upgrade</li>
						<li>1x Tempered Sword</li>
						<li>5x Ten Arrows</li>
						<li>10x Three Bombs</li>
						<li>5x Three Hundred Rupees</li>
						<li>1x Titans Mitt</li>
						<li>28x Twenty Rupees</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Hard</h3>
		</div>
		<div class="panel-body">
			<p>Hard was designed for people who like a challenge. The following items have been removed:</p>
			<ul>
				<li>Arrow Capacity Upgrades</li>
				<li>Bomb Capacity Upgrades</li>
				<li>Boomerangs</li>
				<li>Golden Sword</li>
				<li>Magic Upgrade</li>
				<li>Red Mail</li>
				<li>Mirror Shield</li>
			</ul>
			<p>The following items have had their count reduced:</p>
			<ul>
				<li>Arrows</li>
				<li>Bombs</li>
				<li>Heart Containers (only 5 available)</li>
				<li>Rupees</li>
			</ul>
			<p>The following items have been adjusted:</p>
			<ul>
				<li>Magic Cape uses 2x Magic (except in spike cave)</li>
				<li>Cane of Byrna uses 2x Magic (except in spike cave)</li>
				<li>Magic Powder does not turn Bubbles into Fairies</li>
				<li>Bug Net doesn't catch fairies</li>
				<li>There are only 2 Bottles (4 in Major Glitches)</li>
				<li>Potions heal 5 hearts and restore 1/2 magic</li>
			</ul>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Expert</h3>
		</div>
		<div class="panel-body">
			<p>Expert is for people really seeking a challenge. The following items have been removed:</p>
			<ul>
				<li>Arrow Capacity Upgrades</li>
				<li>Bomb Capacity Upgrades</li>
				<li>Boomerangs</li>
				<li>Golden Sword</li>
				<li>Heart Containers</li>
				<li>Magic Upgrade</li>
				<li>Mails</li>
				<li>Shields</li>
				<li>Silver Arrow Upgrade (except swordless)</li>
				<li>Tempered Sword</li>
			</ul>
			<p>The following items have had their count reduced:</p>
			<ul>
				<li>Arrows</li>
				<li>Bombs</li>
				<li>Pieces of Heart (only 12 available)</li>
				<li>Rupees</li>
			</ul>
			<p>The following items have been adjusted:</p>
			<ul>
				<li>Magic Cape uses 4x Magic (except in spike cave)</li>
				<li>Cane of Byrna uses 4x Magic (except in spike cave)</li>
				<li>Magic Powder does not turn Bubbles into Fairies</li>
				<li>Bug Net doesn't catch fairies</li>
				<li>There is only 1 Bottle (4 in Major Glitches)</li>
				<li>Potions heal 1 heart and restore 1/4 magic</li>
				<li>Shields in Shops are unpurchasable</li>
			</ul>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Insane</h3>
		</div>
		<div class="panel-body">
			<p>Expert not cutting it for you? The following items have been removed:</p>
			<ul>
				<li>Arrow Capacity Upgrades</li>
				<li>Bomb Capacity Upgrades</li>
				<li>Boomerangs</li>
				<li>Golden Sword</li>
				<li>Heart Containers</li>
				<li>Pieces of Heart</li>
				<li>Magic Upgrade</li>
				<li>Mails</li>
				<li>Shields</li>
				<li>Silver Arrow Upgrade (except swordless)</li>
				<li>Tempered Sword</li>
			</ul>
			<p>The following items have had their count reduced:</p>
			<ul>
				<li>Arrows</li>
				<li>Bombs</li>
				<li>Rupees</li>
			</ul>
			<p>The following items have been adjusted:</p>
			<ul>
				<li>Magic Cape uses 4x Magic (except in spike cave)</li>
				<li>Cane of Byrna uses 4x Magic (except in spike cave)</li>
				<li>Magic Powder does not turn Bubbles into Fairies</li>
				<li>Bug Net doesn't catch fairies</li>
				<li>There is only 1 Bottle (4 in Major Glitches)</li>
				<li>Potions don't heal or restore magic</li>
				<li>Shields in Shops are really unpurchasable</li>
			</ul>
		</div>
	</div>
</div>
@overwrite
