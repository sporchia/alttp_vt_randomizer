@extends('layouts.default')

@section('content')
<h1>Options</h1>
<div class="well">
<h2>There are many ways to play LTTP Randomizer!</h2>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Modes</h3>
	</div>
	<div class="panel-body">
		<h4>Standard</h4>
		<p>This mode is closest to the original game. You will start in Link's bed, get a sword from
			Uncle, and rescue Zelda before continuing with the rest of the game.</p>
		<h4>Open</h4>
		<p>This mode starts with the option to start in your house or the sanctuary, you are free to
			explore. There are a few point to note in this mode:</p>
			<ul>
			<li>Uncle is already in the sewers and has a randomized item (not necessarily a sword!)
			<li>Dark rooms don't get a free light cone, not even the sewers.
			<li>You won't start with a sword, and it might be awhile before you find one. Bombs are a
				great early weapon, as well as bushes and signs! Use whatever items you find to
				defend yourself.
			</ul>
		<h4>Swordless</h4>
		<p>Not for the faint of heart, you'll need to use unconventional methods along every step of
			your adventure. Some changes have been made to account for the lack of a sword:
			<ul>
			<li>Swords have been replaced with four copies of 20 rupees (the green rupee sprite with
				"20" on it).
			<li>The curtains blocking progress in Agahnim's Tower are pre-opened, as are the vines in
				Skull Woods.
			<li>Medallions can only be used to open Misery Mire or Turtle Rock. Normally they require a sword to use at all.
			<li>Ganon now takes damage from the hammer.
			<li>Silver arrows are available in all difficulties.
			<li>Ether and Bombos tablets require the Hammer and Book of Mudora.
			</ul>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Logics</h3>
	</div>
	<div class="panel-body">
		<h4>No Glitches</h4>
		<p>This mode requires no advanced knowledge of the game. It's designed as if you were playing
			the original game for the first time.</p>
		<p>Under this mode, you're prevented from getting stuck anywhere regardless of how you use
			small keys within dungeons.</p>
		<p>You may be required to save and quit in certain situations, like getting back to the light
			world when you're in the dark world without the mirror.</p>
		<h4>Overworld Glitches</h4>
		<p>This mode accounts for some of the easier to execute overworld gitches. Two types of major
			glitches are required:</p>
		<ul>
		<li>Overworld boots clipping
		<li>Mirror clipping (DMD, TR Middle Clip, and Fluteless Mire)
		</ul>
		<p>Most minor gitches are also accounted for:</p>
		<ul>
		<li>Fake Flippers (allows access to Ice Palace, King Zora, Lake Hylia Heart Piece, and Hobo
			without Flippers.)
		<li>Dungeon Bunny Revival (allows access to Ice Palace without the Moon Pearl.)
		<li>Overworld Bunny Revival (allows access to Misery Mire and Misery Mire shed without the
			Moon Pearl and without doing DMD.)
		<li>Super Bunny (allows access to two chests in Dark World Death Mountain without the Moon
			Pearl.)
		<li>Surfing Bunny (allows access to Lake Hylia Heart Piece without the Moon Pearl.)
		<li>Walk on Water (allows access to Zora's Domain Ledge Heart Piece without the Flippers.)
		</ul>
		<p>The following are NOT accounted for by the logic, so you'll never be forced to do any:
		<ul>
		<li>Bootless Clips
		<li>Mirror Screenwraps
		<li>Overworld YBAs
		<li>Underworld Clips
		<li>Dark Room Navigation
		<li>Hovering
		</ul>
		<h4>Major Glitches</h4>
		<p>This mode accounts for everything besides EG and semi-EG. This mode is extremely difficult
			and requires advanced knowledge of major glitches, including:</p>
		<ul>
		<li>Overworld YBA
		<li>Clipping out of bounds
		<li>Screenwraps
		</ul>
		<p>Some additional changes have been made in order to ensure the game functions correctly
			under this logic:</p>
		<ul>
		<li>The fake dark world is no longer patched out. Crystals always drop irrespective of
			pendant conflicts.
		<li>Swamp Palace water levels do not drain when you exit the overworld screen, except for the
			first room.
        <li>You will always save and quit to the Pyramid after defeating Agahnim when in the Dark
			World.
        </ul>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Goals</h3>
	</div>
	<div class="panel-body">
		<h4>Defeat Ganon</h4>
		<p>Just like the vanilla game, your goal will be to collect all seven crystals, fight your
			way through Ganon's Tower, and defeat Ganon.</p>
		<h4>All Dungeons</h4>
		<p>You'll need to defeat all of Hyrule's dungeon bosses, including both incarnations of
			Agahnim. Only once they're defeated will you be able to face Ganon.</p>
		<h4>Master Sword Pedestal</h4>
        <p>Collect the Pendants of Courage, Wisdom, and Power, and pull the Triforce from the
			Pedestal! Beware, you may have to venture all over Hyrule, including into Ganon's Tower,
			in order to complete your quest.</p>
		<h4>Triforce Pieces</h4>
		<p>The Triforce has been shattered and scattered throughout the world. Collect enough pieces
			to win!</p>
		<table class="table table-responsive">
		<thead><tr>
			<th>Difficulty</th>
			<th>Required</th>
			<th>Total</th>
		</tr></thead>
		<tbody><tr class="bg-info">
			<td>Easy</td>
			<td>10</td>
			<td>30</td>
		</tr><tr class="bg-success">
			<td>Normal</td>
			<td>20</td>
			<td>30</td>
		</tr><tr class="bg-warning">
			<td>Hard</td>
			<td>30</td>
			<td>40</td>
		</tr><tr class="bg-danger">
			<td>Expert / [[Insane?]]</td>
			<td>40</td>
			<td>40</td>
		</tr></tbody>
		</table>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Difficulties</h3>
	</div>
	<div class="panel-body">
		<h4>Easy</h4>
		<p>This mode is recommended for newer players. Easy makes travelling through Hyrule a little
			safer. There are twice as many chances to get upgrades on the following items:</p>
		<ul>
		<li>Swords
		<li>Armors
		<li>Shields
		<li>Bottles
		<li>½ Magic
		</ul>
		<p>Finding the second ½ Magic will upgrade you to ¼ Magic!</p>
		<p>Additionally, just like in the base game, you'll have 3x the opportunities to get the
			Lamp!</p>
		<h4>Normal</h4>
		<p>In this mode you'll find all the items from the original game.</p>
		<p>Item Pool:</p>
		<div class="row">
			<div class="col-md-6">
				<ul>
				<li>6x Arrow Upgrade (+5)
				<li>1x Arrow Upgrade (+10)
				<li>1x Single Arrow
				<li>10x Big Key
				<li>1x Blue Mail
				<li>6x Bomb Upgrade (+5)
				<li>1x Bomb Upgrade (+10)
				<li>1x Bombos
				<li>1x Book Of Mudora
				<li>1x Boomerang
				<li>4x Bottle (filled with assorted things)
				<li>1x Bow
				<li>1x Bug Catching Net
				<li>1x Cane Of Byrna
				<li>1x Cane Of Somaria
				<li>11x Compass
				<li>12x Dungeon Map
				<li>1x Ether
				<li>7x Fifty Rupees
				<li>1x Fighters Shield
				<li>1x Fighters Sword
				<li>1x Fire Rod
				<li>1x Fire Shield
				<li>4x Five Rupees
				<li>1x Flippers
				<li>1x Flute
				<li>1x Golden Sword
				<li>1x ½ Magic
				<li>1x Hammer
				</ul>
			</div>
			<div class="col-md-6">
				<ul>
				<li>1x Sanctuary Heart Container
				<li>10x Heart Container
				<li>1x Hookshot
				<li>1x Ice Rod
				<li>28x Small Key
				<li>1x Lamp
				<li>1x Magic Cape
				<li>1x Magic Mirror
				<li>1x Magic Powder
				<li>1x Magical Boomerang
				<li>1x Master Sword
				<li>1x Mirror Shield
				<li>1x Moon Pearl
				<li>1x Mushroom
				<li>1x One Hundred Rupees
				<li>2x One Rupee
				<li>1x Pegasus Boots
				<li>24x Piece Of Heart
				<li>1x Power Glove
				<li>1x Quake
				<li>1x Red Mail
				<li>1x Shovel
				<li>1x Silver Arrows Upgrade
				<li>1x Tempered Sword
				<li>5x Ten Arrows
				<li>10x Three Bombs
				<li>5x Three Hundred Rupees
				<li>1x Titans Mitt
				<li>28x Twenty Rupees
				</ul>
			</div>
		</div>
		<h4>Hard</h4>
		<p>Looking for a challenge? The following items have been removed on hard:</p>
		<ul>
		<li>Arrow Capacity Upgrades
		<li>Bomb Capacity Upgrades
		<li>Boomerangs
		<li>Golden Sword
		<li>½ Magic
		<li>Red Mail
		<li>Mirror Shield
		</ul>
		<p>The following items have had their count reduced:</p>
		<ul>
		<li>Arrows
		<li>Bombs
		<li>Heart Containers
		<li>Rupees
		</ul>
		<p>The following items have had their functionality adjusted:</p>
		<ul>
		<li>Magic Cape uses 2x Magic (except in Spike Cave and Misery Mire Spike Room [[IS THIS TRUE?]])
		<li>Cane of Byrna uses 2x Magic (except in Spike Cave and Misery Mire Spike Room)
		<li>Magic Powder does not turn Bubbles into Fairies
		<li>Bug Net doesn't catch Fairies
		<li>There are only 2 Bottles (4 in Major Glitches)
		<li>Potions heal 5 hearts and restore 1/2 magic
		</ul>
		<h4>Expert</h4>
		<p>Looking for even more of a challenge? The following items have been removed:</p>
		<ul>
		<li>Arrow Capacity Upgrades
		<li>Bomb Capacity Upgrades
		<li>Boomerangs
		<li>Golden Sword
		<li>Heart Containers
		<li>Magic Upgrade
		<li>Mails
		<li>Shields
		<li>Silver Arrow Upgrade (except swordless)
		<li>Tempered Sword
		</ul>
		<p>The following items have had their count reduced:</p>
		<ul>
		<li>Arrows
		<li>Bombs
		<li>Pieces of Heart (only 12 available)
		<li>Rupees
		</ul>
		<p>The following items have had their functionality adjusted:</p>
		<ul>
		<li>Magic Cape uses 4x Magic (except in Spike Cave)
		<li>Cane of Byrna uses 4x Magic (except in Spike Cave)
		<li>Magic Powder does not turn Bubbles into Fairies
		<li>Bug Net doesn't catch Fairies
		<li>There is only 1 Bottle (4 in Major Glitches)
		<li>Potions heal 1 heart and restore 1/4 magic
		<li>Shields in Shops are unpurchasable
		</ul>
		<h4>Insane</h4>
		<p>Expert not cutting it for you? Have you truly lost your mind? The following items have
			been removed:</p>
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
		<p>The following items have had their functionality adjusted:</p>
		<ul>
		<li>Magic Cape uses 4x Magic (except in Spike Cave)</li>
		<li>Cane of Byrna uses 4x Magic (except in Spike Cave)</li>
		<li>Magic Powder does not turn Bubbles into Fairies</li>
		<li>Bug Net doesn't catch Fairies</li>
		<li>There is only 1 Bottle (4 in Major Glitches)</li>
		<li>Potions don't heal or restore magic</li>
		<li>Shields in shops are really unpurchasable</li>
		</ul>

	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Seed</h3>
	</div>
	<div class="panel-body">
		<p>Seed is a number used to randomize the game. Most users will simply leave this option
			blank, and the site will fill it in automatically.</p>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Variations</h3>
	</div>
	<div class="panel-body">
		<h4>None</h4>
		<p>The closest option to the vanilla game.</p>
		<h4>Timed Race</h4>
		<p>The timer counts up from 0, with the goal being to finish the game with the best time on
			the timer. There are items throughout the world that will affect your timer, so finishing
			first doesn't necessarily mean you're the winner.</p>
		<p>Do you spend time looking for a clock to get your timer down? Or do you race to the
			end?</p>
		<p>The following items have been added to the item pool:</p>
		<ul>
		<li>20 Green Clocks that subtract 4 minutes from the timer
		<li>10 Blue Clocks that subtract 2 minutes from the timer
		<li>10 Red Clocks that add 2 minutes to the timer
		</ul>
		<h4>Timed OHKO (One Hit Knockout)</h4>
		<p>In this mode you start with time on the timer, and green clocks found add time to the timer.</p>
		<p>If your timer reaches zero, you'll enter One Hit Knockout mode, where anything will kill you.</p>
		<p>Don't despair though, if you are in OHKO mode and find another clock, you'll exit OHKO
			mode and get time on your clock, no matter how long you've been in OHKO mode.</p>
		<table class="table table-responsive">
		<thead><tr>
			<th>Difficulty</th>
			<th>Starting Time</th>
			<th>Green Clocks (+4 minutes)</th>
			<th>Red Clocks (instant OHKO)</th>
		</th></thead>
		<tbody><tr class="bg-info">
			<td>Easy</td>
			<td>20 minutes</td>
			<td>30</td>
			<td>0</td>
		</tr><tr class="bg-success">
			<td>Normal</td>
			<td>10 minutes</td>
			<td>25</td>
			<td>0</td>
		</tr><tr class="bg-warning">
			<td>Hard</td>
			<td>5 minutes</td>
			<td>20</td>
			<td>0</td>
		</tr><tr class="bg-danger">
			<td>Expert / [[Insane?]]</td>
			<td>5 minutes</td>
			<td>20</td>
			<td>5</td>
		</tr></tbody>
		</table>
		<h4>OHKO (One Hit Knockout)</h4>
		<p>Take any damage and Link is a goner. Not for the faint of heart.</p>
		<h4>Triforce Piece Hunt</h4>
		<p>This option changes your goal to Triforce Pieces. [[wat]]</p>
		<h4>Key-sanity</h4>
		<p>Game not random enough for you? Looking for the real challenge?</p>
		<p>FINE!</p>
		<p>All Maps, Compasses, and Keys found in chests are no longer tied to their dungeons!</p>
		<p>You will have to search high and low to find the keys you need to progress in dungeons.
			Keys found on enemies or under pots will remain the same.</p>
		<p>Also we wanted to make Maps and Compasses worth more, so here it is: Your overworld map
			wont show any dungeon information until you collect the map for that dungeon (and if you
			thought the music would get you by, think again, that's been randomized). Compasses, well
			those will show you how many chests you have checked in a dungeon after you collect
			it.</p>
		<p>You're probably wondering how you know which key / map / compass you found. We've got you
			covered: there will be a text box that lets you know which dungeon it belongs to, but
			also the menu will have a table to help you if you lose track.</p>
	</div>
</div>

</div>

@overwrite
