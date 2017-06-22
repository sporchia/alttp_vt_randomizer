@extends('layouts.default')

@section('content')
<h1>What are the different Modes?</h1>
<div class="well">
<p>Game modes are the overarching way the game is set up.</p>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Standard</h3>
		</div>
		<div class="panel-body">
			<p>This mode is closest to the original game. You will start in links bed.</p>
		</div>
	</div>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Open</h3>
		</div>
		<div class="panel-body">
			<p>This mode starts with the option to start in your house or the sanctuary,
				you are free to explore. Special notes:</p>
			<ul>
				<li>Uncle already in sewers and most likely does not have a sword.</li>
				<li>Dark rooms do not get a free light cone.</li>
				<li>It may be a while before you find a sword, think of other ways to do damage to enemies.
					(bombs are a great tool, as well as picking up bushes in over world).</li>
			</ul>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Swordless</h3>
		</div>
		<div class="panel-body">
			<p>Imagine a world without swords, we have! And now you can play it. Find the Hammer and smack
				aruond Ganon, then skewer him with your silver arrows. You're going to have to use unconventional
				methods to beat a lot of enemies, so be prepared for a hard time, and lots of fun.</p>
			<ul>
				<li>No swords are accessible. They have been replaced with 4 copies of 20 rupees (the green ones with a 20 on them).</li>
				<li>The curtains/vines blocking progression in Agahnim's Tower and Skull Woods are pre-opened.</li>
				<li>Hammer can break the barrier blocking entrance to Agahnim's Tower.</li>
				<li>Medallions can only be used directly outside Misery Mire and Turtle Rock (they usually required a sword to use).</li>
				<li>Ganon can be damaged by the Hammer.</li>
				<li>Silver Arrows are available in all difficulties (normal/hard/expert).</li>
				<li>Ether/Bombos tablets are currently not accessible and never required to progress.</li>
			</ul>
		</div>
	</div>
</div>
@overwrite
