@extends('layouts.default')

@section('content')
<h1>Start Your Adventure!</h1>
<div class="well">
<h2>Want to test your skills in a shuffled Hyrule? You've come to the right place!</h2>

{{--<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Walkthrough Video</h3>
	</div>
	<div class="panel-body">
		<p>[[Insert sweet video here that says all the things in this page but in sweet video form (and also flashes the ?rom image from discord on screen because I don't really want to put that here.).]]</p>
	</div>
</div>--}}

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">1. Join our Discord Community</h3>
	</div>
	<div class="panel-body">
		<div style="text-align:center;"><a
			class="btn btn-primary btn-lg btn-xl"
			href="https://discord.gg/alttprandomizer"
			rel="noopener noreferrer"
			role="button"
			target="_blank">Join our Discord</a></div><br/>
		<p>Join our Discord community! We've got friendly and helpful people, community event news,
			aLttP: Randomizer updates, helpful guides, tips, and tricks, and more! Come say
			hello!</p>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">2. Get the ROM</h3>
	</div>
	<div class="panel-body">
		<p>You'll need the base ROM. This should be a <span style="font-weight:bold;">Zelda no
			Densetsu: Kamigami no Triforce v1.0</span> ROM. Don't worry if you can't read Japanese;
			the patching process provides English text while keeping the glitches unique to the
			original version intact.</p>
		<p>If you run into trouble, ask in
			<a href="https://discord.gg/alttprandomizer target="_blank" rel="noopener noreferrer">Discord!</a></p>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">3. Choose Your Game Options</h3>
	</div>
	<div class="panel-body">
				<p>Head on over to <a href="/randomizer" target="_blank" rel="noopener noreferrer">Generate Randomize Game</a> and provide your ROM. The next screen will show a variety of game options. For your first
			few runs, we recommend changing "Difficulty" to "Easy" and leaving the rest of the
			settings as is. Then click "Generate ROM" and you'll be given a newly minted
			randomized game!</p>
		<p>A more in-depth guide to all the available options can be found <a href="/options">here</a>.</p>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">4. Get a Way to Play</h3>
	</div>
	<div class="panel-body">
		<p>First, you'll need something to run your newly minted game on. We recommend using an
			emulator. An emulator is a program that closely replicates SNES hardware, allowing you to
			run SNES games on your computer. You can get the recommended emulator, SNES9x, at their
			website <a href="http://www.snes9x.com/" target="_blank" rel="noopener noreferrer">here.</a></p>
		<p>While you can play using only your keyboard, a controller makes for a better experience.
			While most USB controllers will work, we recommend an
			<a href="https://www.amazon.com/dp/B002B9XB0E" target="_blank" rel="noopener noreferrer">iBuffalo Classic USB
			Gamepad.</a> or <a href="https://www.amazon.com/dp/B00Y0LUQFE" target="_blank" rel="noopener noreferrer">8Bitdo SFC30 Wireless Bluetooth Controller</a></p>
		<p>There are other supported ways to play, including on original SNES hardware. There are
			also certain emulators, such as zsnes, that won't work correctly with the randomizer.
			Join us on Discord to learn more!</p>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">5. Get Playing!</h3>
	</div>
	<div class="panel-body">
		<p>You're finally ready to go! The best way to learn is to load up your new ROM and start
			playing. If you feel like you're stuck, check out this list of common pitfalls, or ask
			on Discord.</p>
		<ul>
			<li>You can use the Y button to swap between Silver Arrows and Normal Arrows, the Red
				and Blue Boomerangs, the Mushroom and the Magic Powder, and the Shovel and the
				Flute.</li>
			<li>You can save and quit with either the Frog or Purple Chest following you to bring
				it back to the light world without the Mirror.</li>
			<li>In the dark world, you can hookshot over the river north of the pyramid. Look for
				the arrow made out of grass!</li>
			<li>You can use the boots to dash into walls, blocks, and pots, knocking you backwards,
				in order to cross a gap.</li>
			<li>If you find yourself at bumper cave with the Cape but without the Hookshot, try
				walking over the top left of the gap. No hookshot needed!</li>
			<li>Keys might not be accessible if they are not required to finish the game. For instance, the Skull Woods big key might be in the big chest.</li>
		</ul>
		<p>Don't forget to check out the comprehensive <a href="/resources">resources section</a>
			with tutorials and more tips!</p>
	</div>
</div>

</div>
@overwrite
