@extends('layouts.default')

@section('content')
<h1>What’s included in the randomization?</h1>
<div class="well">
	<ul>
		<li>There are many item locations in the game. These include:
			<ul>
				<li>Treasure chests (excluding the minigames in the Lost Woods and by the library)</li>
				<li>NPC’s which ordinarily give you items</li>
				<li>Freestanding items (heart pieces, Mushroom, Book of Mudora and freestanding/bonk small keys)</li>
				<li>Boss heart containers</li>
				<li>Ether and Bombos tablets</li>
				<li>The Potion Shop Witch (which usually gives you Magic Powder in exchange for the Mushroom)</li>
				<li>The Magic Bat Statue (which usually gives you ½ Magic when sprinkled with the Magic Powder)</li>
				<li>The diggable item in the Sacred Grove (where the Flute is usually hidden)</li>
				<li>The Dark World Digging Game (guaranteed to be won on 15th dig)</li>
				<li>The Dark World Chest Game (guaranteed to be won on 2nd chest)</li>
			</ul>
		</li>
		<li>All pendants/crystals are also randomized between themselves. Check your map to see where they are!</li>
		<li>The medallions required to open Misery Mire and Turtle Rock and also randomized.</li>
		<li>The Master Sword, Tempered Sword and Gold Sword are randomized between themselves.</li>
	</ul>
</div>

<h1>What’s not included in the randomization?</h1>
<div class="well">
<ul>
	<li>Link’s Uncle will still always give you the Fighter’s Sword.</li>
	<li>Great Faerie upgrade fountains in Zora’s Domain and Lake Hylia remain unchanged.</li>
	<li>The Great Faerie in the Pyramid will still always upgrade your Bow to Silver Arrows.</li>
	<li>All shops throughout Hyrule remain unchanged.</li>
	<li>The archery minigame remains unchanged.</li>
	<li>Small keys underneath pots or held by enemies remain unchanged.</li>
</ul>
</div>

<h1>What’s hard mode?</h1>
<div class="well">
<p>Hard mode was designed for people who really like a challenge.  It doesn't affect what you need to do but it
	does affect what items you will have available to you. The following items have been removed:</p>
<ul>
	<li>Arrow Capacity Upgrades</li>
	<li>Bomb Capacity Upgrades</li>
	<li>Boomerangs</li>
	<li>Bottles</li>
	<li>Bug Catching Net</li>
	<li>Cane Of Byrna</li>
	<li>Compasses</li>
	<li>Heart Containers</li>
	<li>Magic Cape</li>
	<li>Magic Powder</li>
	<li>Magic Upgrade</li>
	<li>Mails</li>
	<li>Maps</li>
	<li>Shields</li>
</ul>
<p>The following items have had their count reduced:</p>
<ul>
	<li>Arrows</li>
	<li>Bombs</li>
	<li>Pieces of Heart (only 16 available)</li>
	<li>Rupees</li>
</ul>
</div>

<h1>What differences are there from the original game?</h1>
<div class="well">
	<p>There are a few changes from the original game which enhance gameplay and prevent you getting stuck. The Japanese
		1.0 version is used as a base ROM because it allows use of some exclusive glitches in some of the advanced game
		modes. You may see some Japanese text but this will eventually all be removed.</p>
	<ul>
		<li>You no longer need the Lamp to push the bookshelf in the throne room during the prologue. However you now
			have the ability to see in dark rooms within the Light World even without the Lamp! You will never be
			required to navigate through dark rooms within the Dark World so if you find yourself in total darkness
			then it’s guaranteed that you can find the Lamp elsewhere.</li>
		<li>You are able to toggle between items which ordinarily share the same slot in the menu by pressing Y. For
			example you can now simultaneously have both the Shovel and Flute and switch between them! The sub-menu for
			the Bottles no longer automatically opens and you can open it with X or toggle between them with Y. You can
			also toggle between viewing your Pendants or Crystals by pressing Select.</li>
		<li>If you defeat Agahnim but don’t have the Magic Mirror ordinarily you would not be able to return to the
			Light World even if you save and quit. However s+q will now return you to the Light World if you don’t have
			the Magic Mirror to prevent this. If you do have the Magic Mirror you will correctly s+q to the Pyramid of
			Power.</li>
		<li>The water levels within Swamp Palace will always revert to being drained when you exit the overworld screen.
			This prevents you accidentally drowning keys under water and getting stuck!</li>
		<li>The file select screen has a random row of symbols at the top. These are a unique identifier for each seed
			generated and do not have any other relevance.</li>
	</ul>
</div>

<h1>What other minor changes have been made?</h1>
<div class="well">
	<p>There have been many changes as the project has been developed. Below is a list of the relevant ones
		you may notice.</p>
	<ul>
		<li>Most of the text and cutscenes in the game have been removed</li>
		<li>The maximum rupee count is now 9999</li>
		<li>You now have a ⅓ chance to find ¼ Magic instead of ½ Magic</li>
		<li>Bottles are randomly filled upon collection with an equal chance for each bottle prize (including empty)</li>
		<li>Throwing bottles into Faerie Fountains now yields an equal chance for each bottle prize</li>
		<li>The bomb/arrow upgrades from the Great Faerie in Lake Hylia only increase your capacity by 1 (since they’re in the item pool)</li>
		<li>You can now dig up items with the shovel (e.g. bombs, arrows, hearts, rupees)</li>
		<li>The doors to Hyrule Castle remain unlocked after defeating Agahnim</li>
		<li>The Smithy no longer needs to be rescued to spawn the Super Bomb (only crystals 5 and 6 are required)</li>
		<li>Mothula now takes damage from the Gold Sword (Tempered Sword damage values)</li>
		<li>The door to Agahnim's Tower is now locked until Zelda has been rescued</li>
		<li>The purple chest now returns to its initial location if left on the overworld when you enter a dungeon</li>
		<li>You will always respawn on the Pyramid if you die to Ganon (even if Agahnim has not been defeated)</li>
		<li>The light world flute boy has been removed (fixed issues with game crashes)</li>
		<li>If you s+q with a follower they will return to their default position (prevents softlocks)</li>
		<li>Agahnim (both versions) will always attack with projectiles you can reflect back at him</li>
		<li>Ganon will never warp more than once in his third phase</li>
		<li>Link’s Uncle no longer gives you a shield</li>
		<li>The Mirror Shield can now reflect some projectiles</li>
		<li>The Sanctuary priest no longer dies when you upgrade your sword or beat Agahnim</li>
		<li>Link’s Uncle selects text from a pool of phrases and has a 5% chance to tell you where the Pegasus Boots are hidden</li>
		<li>The Pendant of Courage has been flipped horizontally on the map to make it more identifiable</li>
		<li>The credits have been updated to also include statistics of your playthrough (check King Zora’s message!)</li>
	</ul>
</div>

<h1>What non-standard items are in the item pool?</h1>
<div class="well">
	<p>Almost everything you find is something you would ordinarily find in a unique location somewhere
		in the original game. There are however a few exceptions.<p>
	<ul>
		<li>Bomb capacity upgrades (six +5 upgrades and one +10 upgrade)</li>
		<li>Arrow capacity upgrades (six +5 upgrades and one +10 upgrade)</li>
		<li>The Fighter’s Shield and Fire Shield</li>
		<li>Magic upgrade (½ Magic or ¼ Magic)</li>
	</ul>
</div>
@overwrite
