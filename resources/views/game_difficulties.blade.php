@extends('layouts.default')

@section('content')
<h1>What are the different Difficulties?</h1>
<div class="well">
<p>Difficulty will affect what items one has avilable to them to complete the game as well as modify some of the
	usages of items.</p>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Normal</h3>
		</div>
		<div class="panel-body">
			<p>This is the standard game item pool. no special rules or adjustments have been changes with
				items or counts from what one would find in the original game.</p>
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
				<li>Bug Catching Net</li>
				<li>Cane Of Byrna</li>
				<li>Compasses</li>
				<li>Golden Sword</li>
				<li>Heart Containers</li>
				<li>Magic Upgrade</li>
				<li>Red Mail</li>
				<li>Maps</li>
				<li>Mirror Shield</li>
			</ul>
			<p>The following items have had their count reduced:</p>
			<ul>
				<li>Arrows</li>
				<li>Bombs</li>
				<li>Rupees</li>
			</ul>
			<p>The following items have been adjusted:</p>
			<ul>
				<li>Magic Cape uses 2x Magic</li>
				<li>Magic Powder does not turn Bubbles into Fairies</li>
				<li>There are only 2 Bottles</li>
				<li>Potions and Shields in shops cost twice as much</li>
			</ul>
			<p>The following items have been added:</p>
			<ul>
				<li>Rupoors (-5 rupees when collected)</li>
			</ul>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Masochist</h3>
		</div>
		<div class="panel-body">
			<p>Masochist was designed for people who hate themselves. The following items have been removed:</p>
			<ul>
				<li>Arrow Capacity Upgrades</li>
				<li>Bomb Capacity Upgrades</li>
				<li>Boomerangs</li>
				<li>Bug Catching Net</li>
				<li>Cane Of Byrna</li>
				<li>Compasses</li>
				<li>Golden Sword</li>
				<li>Heart Containers</li>
				<li>Magic Upgrade</li>
				<li>Mails</li>
				<li>Maps</li>
				<li>Shields</li>
				<li>Silver Arrows</li>
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
				<li>Magic Cape uses 4x Magic</li>
				<li>Magic Powder does not turn Bubbles into Fairies</li>
				<li>There is only 1 Bottle</li>
				<li>Potions and Shields in Shops are unpurchasable</li>
			</ul>
			<p>The following items have been added:</p>
			<ul>
				<li>Rupoors (-10 rupees when collected)</li>
			</ul>

		</div>
	</div>

</div>
@overwrite
