@extends('layouts.default')

@section('content')
<h1 id="rules">What are these Rules?</h1>
<div>
	<h2>v8</h2>
	<p>This is the main set of new features for v8.</p>
	<ul>
		<li>Bonk items in Ganons Tower and Desert are in item pool</li>
		<li>+5/+10 Arrow and Bomb upgrades are in item pool (+50/+70 removed)</li>
		<li>Bow and Silver Arrows are in item pool</li>
		<li>Bosses have dungeon items</li>
		<li>there is a 5% chance Uncle will tell you what part of the world the Pegasus Boots are in</li>
		<li>Pendants/Crystals are shuffled in the same prize pool and can be found cross Light/Dark worlds</li>
	</ul>
</div>
<div>
	<h2>v8 (hard mode)</h2>
	<p>This has all the Features of v8 with some modifications to the item pool.</p>
	<ul>
		<li>No saftey items:
			<ul>
				<li>Red/Blue Mail</li>
				<li>Bottles</li>
				<li>Bug Catching Net</li>
				<li>Boss Hearts</li>
				<li>Bomb/Arrow Upgrades</li>
				<li>Boomerangs</li>
				<li>Powder</li>
				<li>Blue/Red/Mirror Shield</li>
				<li>Staff Of Byrna</li>
			</ul>
		</li>
		<li>Reduced Count:
			<ul>
				<li>Rupees</li>
				<li>Bombs</li>
				<li>Arrows</li>
				<li>Pieces of Heart Container</li>
			</ul>
		</li>
	</ul>
</div>
<h1 id="modes">What are these Modes?</h1>
<div>
	<h2>Casual (NMG)</h2>
	<p>This mode requires no knowledge of and glitches other than possibly need to <em>Save and Quit</em> Sometimes you
		end up in Dark World without a Mirror and this will be your only way back.</p>
	<h2>Speed Runner</h2>
	<p>This mode is designed for people who have a fair knowledge of the game. There is a chance that poor pathing can
		lead to soft locks.</p>
	<p>One could be required to know some advanced stratigies such as:
		<ul>
			<li>Bomb Jumping</li>
			<li>Super Bunny</li>
			<li>Dark Room Navigation without Lamp</li>
		</ul>
	</p>
	<h2>Glitched</h2>
	<p>This mode is all out glitched, you will be required to have knowledge of:
		<ul>
			<li>YBA</li>
			<li>Super Bunny</li>
			<li>Clipping</li>
		</ul>
	</p>
</div>
@overwrite
