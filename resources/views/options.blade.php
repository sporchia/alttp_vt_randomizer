@extends('layouts.default')

@section('content')
<h1>Options</h1>
<div class="well">
<h2>There are many ways to play ALttP:Randomizer!</h2>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Modes</h3>
	</div>
	<div class="panel-body">
		<h4>Standard</h4>
		<p>This mode is closest to the original game. You will start in Link's bed, get a weapon from
			Uncle (depending on your Swords option, see below), and rescue Zelda before continuing
			with the rest of the game.</p>
		<h4>Open</h4>
		<p>This mode starts with the option to start in your house or the sanctuary, and you are free
			to explore. There are a few point to note in this mode:</p>
			<ul>
			<li>Uncle is already in the sewers and has an item.
			<li>Dark rooms don't get a free light cone, not even the sewers.
			</ul>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Swords</h3>
	</div>
	<div class="panel-body">
		<h4>Randomized</h4>
		<p>All sword upgrades are randomized. You won't start with a sword, and it might be a while
			before you find one. Bombs are a great early weapon, as are bushes and signs! Use
			whatever items you find to defend yourself.
		<p>If this option is combined with Standard Mode (see above), your uncle will graciously
			give you one of the following items to ensure you can complete the escape sequence:</p>
			<ul>
			<li>Sword Upgrade (yes, it's still possible)
			<li>Hammer
			<li>Bow + Full Arrow Refill
			<li>Full Bomb Refill
			<li>Fire Rod + Full Magic Refill
			<li>Cane of Somaria + Full Magic Refill
			<li>Cane of Byrna + Full Magic Refill
			</ul>
		<h4>Uncle Assured</h4>
		<p>Uncle always has a sword. The remaining upgrades are randomized.</p>
		<h4>Swordless</h4>
		<p>All swords are removed from the game. Because the game expects you to have a sword, the
			following changes are present only in swordless mode:</p>
			<ul>
			<li>Swords have been replaced with four copies of 20 rupees (a green rupee sprite with
				"20" on it).
			<li>The curtains blocking progress in Agahnim's Tower are pre-opened, as are the vines in
				Skull Woods.
			<li>Medallions can only be used to open Misery Mire or Turtle Rock, or to progress
				through Ice Palace. Normally, they require a sword to use.
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
		<p>Under this mode, you're prevented from getting stuck anywhere, regardless of how you use
			small keys within dungeons.</p>
		<p>You may be required to save and quit in certain situations, like getting back to the light
			world when you're in the dark world without the mirror.</p>
		<h4>Overworld Glitches</h4>
		<p>This mode <span class="running-now">requires</span> some of the easier-to-execute
			overworld glitches. It's more difficult than simply using fake flippers to visit the
			hobo! The two types of major glitches are required:</p>
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
		<p>Some additional changes have been made in order to ensure that the game functions correctly
			under this logic:</p>
		<ul>
		<li>The fake dark world is no longer patched out. Crystals always drop, irrespective of
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
			Pedestal! Beware, you may have to venture all over Hyrule, including Ganon's Tower,
			in order to complete your quest.</p>
		<h4>Triforce Pieces</h4>
		<p>The Triforce has been shattered and scattered into 30 pieces throughout Hyrule! Collect
			20 pieces to win!</p>
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
		<li>Silver Arrows
		</ul>
		<p>Finding the second ½ Magic will upgrade you to ¼ Magic!</p>
		<p>While in Standard Mode, if Uncle has the Bow, Bombs, Fire Rod, Cane of Somaria, or Cane of
			Byrna, Link will be granted unlimited ammo for that item for the duration of the escape
			sequence.</p>
		<p>Additionally, you'll have 3x the opportunities to get the Lamp!</p>
		<h4>Normal</h4>
		<p>In this mode you'll find all the items from the original game.</p>
		<p>Item Pool:</p>
		<div class="row">
			<div class="col-md-6">
				<ul>
				<li>6x Arrow Upgrade (+5)
				<li>1x Arrow Upgrade (+10)
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
				<li>1x Fighters Shield
				<li>1x Fighters Sword
				<li>1x Fire Rod
				<li>1x Fire Shield
				<li>1x Flippers
				<li>1x Flute
				<li>1x Golden Sword
				<li>1x ½ Magic
				<li>1x Hammer
				<li>11x Heart Container
				<li>1x Hookshot
				<li>1x Ice Rod
				</ul>
			</div>
			<div class="col-md-6">
				<ul>
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
				<li>1x Pegasus Boots
				<li>24x Piece Of Heart
				<li>1x Power Glove
				<li>1x Quake
				<li>1x Red Mail
				<li>1x Shovel
				<li>1x Silver Arrows Upgrade
				<li>1x Tempered Sword
				<li>1x Titans Mitt
				</ul>
				<ul>
				<li>5x Ten Arrows
				<li>1x Single Arrow
				<li>1x Ten Bombs
				<li>9x Three Bombs
				<li>5x Three Hundred Rupees
				<li>1x One Hundred Rupees
				<li>7x Fifty Rupees
				<li>28x Twenty Rupees
				<li>4x Five Rupees
				<li>2x One Rupee
				</ul>
			</div>
		</div>
		<h4>Hard</h4>
		<p>Looking for a challenge? The following items have been removed:</p>
		<ul>
		<li>Arrow Capacity Upgrades
		<li>Bomb Capacity Upgrades
		<li>Boomerangs
		<li>Golden Sword
		<li>½ Magic
		<li>Red Mail
		<li>Mirror Shield
		</ul>
		<p>The following items have had their total count reduced:</p>
		<ul>
		<li>Bombs
		<li>Heart Containers (only 5x)
		<li>Rupees
		</ul>
		<p>The following items have had their functionality adjusted:</p>
		<ul>
		<li>Magic Cape uses 2x Magic as Normal (except in Spike Cave)
		<li>Cane of Byrna doesn't protect you (except in Spike Cave)
		<li>Magic Powder does not turn Bubbles into Fairies
		<li>Bug Net doesn't catch Fairies
		<li>There are only 2 Bottles (4 in Glitched Logic)
        <li>Potions heal 5 hearts and restore 1/2 magic (except in Spike Cave where they behave
			normally)
		</ul>
		<h4>Expert</h4>
		<p>Looking for even more of a challenge? The following items have been removed, in addition to Hard:</p>
		<ul>
		<li>Heart Containers
		<li>Blue Mail
		<li>Fire Shield
		<li>Fighter's Shield
		<li>Silver Arrow Upgrade (except in Swordless Mode)
		<li>Tempered Sword
		</ul>
		<p>The following items have had their total count reduced from Hard:</p>
		<ul>
		<li>Arrows
		<li>Rupees
		</ul>
		<p>The following items have had their functionality further adjusted from Hard:</p>
		<ul>
		<li>Magic Cape uses 4x Magic as Normal (except in Spike Cave)
		<li>Cane of Byrna doesn't protect you (except in Spike Cave)
		<li>There is only 1 Bottle (4 in Major Glitched Logic)
		<li>Potions heal 1 heart and restore 1/4 magic (except in Spike Cave where they behave
			normally)
		<li>Shields in Shops cannot be purchased
		</ul>
		<h4>Insane</h4>
		<p>Expert not cutting it for you? Have you truly lost your mind? The following items have
			been removed, in addition to Expert:</p>
		<ul>
		<li>Pieces of Heart
		</ul>
		<p>The following items have had their total count reduced from Expert:</p>
		<ul>
		<li>Arrows
		<li>Bombs
		</ul>
		<p>The following items have had their functionality further adjusted from Expert:</p>
		<ul>
		<li>Potions don't heal or restore magic (except in Spike Cave where they behave normally)
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
		<p>Do you spend time looking for a clock to get your timer down, or do you race to the
			end?</p>
		<p>The following items have been added to the item pool:</p>
		<ul>
		<li>20 Green Clocks that subtract 4 minutes from the timer
		<li>10 Blue Clocks that subtract 2 minutes from the timer
		<li>10 Red Clocks that add 2 minutes to the timer
		</ul>
		<h4>Timed OHKO (One Hit Knockout)</h4>
		<p>In this mode you start with time on the timer, and found green clocks add time to the timer.</p>
		<p>If your timer reaches zero, you'll enter One Hit Knockout mode, where anything will kill you.</p>
		<p>Don't despair, though. If you are in OHKO mode and find another clock, you'll exit OHKO
			mode and get time on your clock, no matter how long you've been in OHKO mode.</p>
		<table class="table table-responsive">
		<thead><tr>
			<th>Difficulty</th>
			<th>Starting Time</th>
			<th>Green Clocks (+4 minutes)</th>
			<th>Red Clocks (instant OHKO)</th>
		</tr></thead>
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
			<td>Expert / Insane</td>
			<td>5 minutes</td>
			<td>20</td>
			<td>5</td>
		</tr></tbody>
		</table>
		<h4>OHKO (One Hit Knockout)</h4>
		<p>Take any damage, and Link is a goner. Not for the faint of heart.</p>
		<h4>Triforce Piece Hunt</h4>
		<p>Unfortunately, variations are incompatible with Triforce Pieces goal. This option changes
			your goal to Triforce Pieces.</p>
		<h4>Key-sanity</h4>
		<p>Game not random enough for you? Looking for the real challenge?</p>
		<p>FINE!</p>
		<p>All Maps, Compasses, and Keys found in chests are no longer tied to their dungeons!</p>
		<p>You will have to search high and low to find the keys you need to progress in dungeons.
			Keys found on enemies or under pots will remain the same.</p>
		<p>Also, Maps and Compasses worth more: Your overworld map won't show any dungeon information
			until you collect the map for that dungeon (and if you thought the music would get you
			by, think again, that's been randomized). Compasses, well, those will show you how many
			chests you have checked in a dungeon after you collect it.</p>
		<p>You're probably wondering how you know which key / map / compass you found. We've got you
			covered: There will be a text box that lets you know which dungeon it belongs to, but
			the menu will also have a table to help you if you lose track.</p>
		<h4>Retro</h4>
		<p>A callback to the first entry in the Legend of Zelda series, Retro Mode links us even
			to the past.</p>
		<h5>Rupee Bow</h5>
		<ul>
		<li>The Bow no longer uses arrows for ammo. Instead it uses rupees! Each Wooden Arrow costs
			10 rupees to fire while Silver Arrows costs 50 rupees.
		<li>Wooden Arrows are now independent to the Bow, just like Silver Arrows; you must acquire
			both the Bow and either Wooden Arrows or Silver Arrows in order to use the Bow.
		<li>The Wooden Arrows must be bought from a shop. They are NOT available in regular chests
			or anywhere outside of shops.
		<li>If you find Silver Arrows without buying Wooden Arrows, you will only be able to fire
			Silver Arrows.
		</ul>
		<h5>Overworld Shops</h5>
		<p>Five shops out of a possible eleven will be randomly chosen each time to have new stock.
			This does NOT include the Big Bomb Shop or the Witch's Potion Shop. Wooden Arrows will be
			available for 80 rupees and Small Keys will be available for 100 rupees each. Small Keys
			will be able to be purchased multiple times.</p>
		<h5>Small Keys</h5>
		<p>Small Keys are no longer dungeon specific. They are now shuffled into the general item
			pool and will be found outside of dungeons. Keys under pots or dropped by enemies have
			not been changed.</p>
		<p>Ten keys have been removed from the item pool in Easy and Normal modes; fifteen have been
			removed from Hard, Expert, and Insane modes. Think carefully before using keys, and
			remember you can purchase some if you get stuck!</p>
		<p>Big Keys, Maps, and Compasses remain dungeon-specific and have not been randomized outside
			their dungeons.</p>
		<h5>Take-Any Caves</h5>
		<p>Four random single-entrace caves and houses which do not lead to an item location now lead
			to Take-Any Caves where players are given a choice between a Heart Container or Blue
			Potion refill. The Heart Containers have not been moved from the general item pool and
			bonus ones. However, you will not be able to have more than 20 hearts at once.</p>
	</div>
</div>

</div>

@overwrite
