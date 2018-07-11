@extends('layouts.default', ['title' => 'Resources - '])

@section('content')
<h1>Resources</h1>
<div class="card card-body bg-light">
	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Discord</h3>
		</div>
		<div class="card-body">
			<div style="text-align:center;"><a
				class="btn btn-primary btn-lg btn-xl"
				href="https://discord.gg/alttprandomizer"
				rel="noopener noreferrer"
				role="button"
				target="_blank">Join our Discord</a></div><br/>
			<p>Join our Discord community! We've got friendly and helpful people, community event news,
				ALttP: Randomizer updates, helpful guides, tips, and tricks, and more! Come say
				hello, and checkout the #resources channel!</p>
		</div>
	</div>

	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Learn-to-Play Videos</h3>
		</div>
		<div class="card-body">
			<div style="text-align:center;"><a
				class="btn btn-secondary btn-lg btn-xl"
				href="https://www.youtube.com/channel/UCBMMk0WJAeldNv4fI9juovA"
				role="button">ALttP:R Youtube Channel</a></div><br/>
			<p>Check out our routing guides, glitch tutorials, update announcements, tournament
				highlights, and more! Great for both new players looking to learn the ropes, and
				experienced runners looking to hone their skills!</p>
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">External Resources</h3>
		</div>
		<div class="card-body">
			<ul>
			<li><a href="https://goo.gl/tfohG1" target="_blank" rel="noopener noreferrer">Common things that stump newcomers</a>
				(this is a good first read)
			<li><a href="https://goo.gl/gvoyHB" target="_blank" rel="noopener noreferrer">General help glossary</a>
			<li><a href="https://goo.gl/yus4Rq" target="_blank" rel="noopener noreferrer">Glitch Resources</a>
			<li><a href="https://goo.gl/fCsKXQ" target="_blank" rel="noopener noreferrer">Trackers / HUDs</a>
			<li><a href="http://alttp.mymm1.com/srl/" target="_blank" rel="noopener noreferrer">Getting started on SRL</a>
			</ul>
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Common Pitfalls</h3>
		</div>
		<div class="card-body">
			<ul>
			<li>You can use the Y button to swap between Silver Arrows and Normal Arrows, the Red and
				Blue Boomerangs, the Mushroom and the Magic Powder, and the Shovel and the Flute.
			<li>In the dark world, you can hookshot over the river north of the pyramid. Look for the
				arrow made out of grass!
			<li>If you find yourself at bumper cave with the Cape but without the Hookshot, try walking
				over the top left of the gap—no Hookshot needed!
			<li>Agahnim's barrier can be bypassed with the Magic Cape or destroyed with an upgraded sword.
			<li>If you have the Magic Mirror, Desert Palace can be reached from Misery Mire without the Book of Mudora.
			<li>Bombos melts things as well as the Fire Rod, which is useful in Ice Palace.
			<li>You can cross small gaps by rebounding off of walls or objects using the Pegasus Boots.
			<li>Sahasrahla gives you his item when you speak to him with the Pendant of Courage.
			<li>The Super Bomb spawns when you have acquired crystals 5 and 6.
			<li>The Smith and the Purple Chest will stay following you through Save and Quit.
			<li>You are never required to navigate a dark room; the lamp will be available to light your way, so go out and find it!
			<li>Keys might not be accessible if they are not required to finish the game. For instance, the Skull Woods big key might be in the big chest.
			</ul>
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Differences</h3>
		</div>
		<div class="card-body">
			<h4>What has been randomized?</h4>
			<ul>
			<li>Nearly all unique item locations
			<li>Pendants and crystals (check your map!)
			<li>The medallions required to open Misery Mire and Turtle Rock
			<li>Enemy drops and prize pulls (e.g. trees)
			</ul>
			<h4>What has stayed the same?</h4>
			<ul>
			<li>All shops throughout Hyrule
			<li>The archery game and various rupee chest games
			<li>Small keys underneath pots or held by enemies
			</ul>
			<h4>What changed from the original game?</h4>
			<p>There are a few changes from the original game which enhance gameplay and prevent you from
				getting stuck. The Japanese 1.0 version is used as a base ROM because it allows use of
				some exclusive glitches in some of the advanced game modes.</p>
			<ul>
			<li>You no longer need the Lamp to push the bookshelf during the prologue.
			<li>You can now see in dark rooms in the Sewers without the Lamp (except in Open mode).
			<li>You can toggle between items which share the same slot in the menu by pressing Y. For
				example, you can now hold both the Shovel and Flute and switch between them.
			<li>The submenu for the Bottles no longer automatically opens. You can open it with X or
				toggle between bottles with Y.
			<li>The water levels within Swamp Palace will always revert to being drained when you exit
				the overworld screen. This prevents you from accidentally drowning keys underwater and getting
				stuck!
			<li>The file select screen has a random row of symbols at the top. These are a unique
				identifier for each seed generated to ensure that all racers have the correct file loaded.
				They do not have any other relevance.
			<li>The Pyramid and Waterfall of Wishing Faeries no longer upgrade your items. Instead their
				caves contains two chests each which account for the usual upgrades having been shuffled
				into the mix.
			<li>You're guaranteed to get the digging game item by the 30th dig.
			<li>You're guaranteed to get the Village of Outcasts chest game item on the 1st attempt (can
				be 1st or 2nd chest).
			</ul>
		</div>
	</div>
</div>
@overwrite
