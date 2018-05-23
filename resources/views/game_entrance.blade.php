@extends('layouts.default')

@php
$title = ' - Entrance Options';
@endphp

@section('content')
<h1>What is the Entrance Randomizer?</h1>
<div class="card card-body bg-light">
	<p>The Entrance Randomizer allows you to twist the world upside down and play the game. It should mostly follow
		the standard VT rules for settings on everything, but it introduces a new option "Shuffle".</p>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Simple</h3>
		</div>
		<div class="card-body">
			<p>Shuffles dungeon entrances between each other and keeps all 4-entrance dungeons
				confined to one location such that dungeons will one to one swap with each other.
			</p>
			<p>Other than on Light World Death Mountain, interiors are shuffled but still connect the
				same points on the overworld. On Death Mountain, entrances are connected more freely.
			</p>
		</div>
	</div>

	<div class="card border-warning mt-4">
		<div class="card-header bg-warning">
			<h3 class="card-title">Restricted</h3>
		</div>
		<div class="card-body">
			<p>Uses dungeon shuffling from Simple but freely connects remaining entrances. Caves and
				dungeons with multiple entrances will be confined to one world.</p>
		</div>
	</div>

	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

	<div class="card border-warning mt-4">
		<div class="card-header bg-warning">
			<h3 class="card-title">Full</h3>
		</div>
		<div class="card-body">
			<p>Mixes cave and dungeon entrances freely. Caves and dungeons with multiple entrances
				will be confined to one world.</p>
		</div>
	</div>

	<div class="card border-danger mt-4">
		<div class="card-header bg-danger">
			<h3 class="card-title text-white">Crossed</h3>
		</div>
		<div class="card-body">
			<p>Mixes cave and dungeon entrances freely, but now connector caves and dungeons can link
				Light World and Dark World.</p>
		</div>
	</div>

	<div class="card border-danger mt-4">
		<div class="card-header bg-danger">
			<h3 class="card-title text-white">Insanity</h3>
		</div>
		<div class="card-body">
			<p>Decouples entrances and exits from each other and shuffles them freely. Caves that
				were single entrance in vanilla still can only exit to the same location from which
				they were entered.</p>
		</div>
	</div>
</div>
@overwrite
