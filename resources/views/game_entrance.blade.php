@extends('layouts.default')

@section('content')
<h1>What is the Entrance Randomizer?</h1>
<div class="well">
<p>The Entrance Randomizer allows you to twist the world upside down and play the game. It should mostly follow
	the standard VT rules for settings on everything, but it introduces a new option "Shuffle"</p>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Full</h3>
		</div>
		<div class="panel-body">
			<p>Mix cave and dungeon entrances freely.</p>
		</div>
	</div>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Simple</h3>
		</div>
		<div class="panel-body">
			<p>Shuffle Dungeon Entrances/Exits between each other and keep all 4-entrance dungeons confined to one
				location. All caves outside of death mountain are shuffled in pairs.</p>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Restricted</h3>
		</div>
		<div class="panel-body">
			<p>Use Dungeons shuffling from Simple but freely connect remaining entrances.</p>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Madness</h3>
		</div>
		<div class="panel-body">
			<p>Decouple entrances and exits from each other and shuffle them freely, only ensuring that no fake
				Light/Dark World happens and all locations are reachable.</p>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Insanity</h3>
		</div>
		<div class="panel-body">
			<p>Madness without the world restrictions. Mirror and Pearl are provided early to ensure Filling algorithm
				works properly. Deal with Fake LW/DW at your discretion.</p>
		</div>
	</div>

</div>
@overwrite
