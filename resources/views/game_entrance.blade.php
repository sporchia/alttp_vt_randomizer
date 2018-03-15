@extends('layouts.default')

@section('content')
<h1>What is the Entrance Randomizer?</h1>
<div class="well">
<p>The Entrance Randomizer allows you to twist the world upside down and play the game. It should mostly follow
	the standard VT rules for settings on everything, but it introduces a new option "Shuffle".</p>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Simple</h3>
		</div>
		<div class="panel-body">
			<p>Shuffles dungeon entrances between each other and keeps all 4-entrance dungeons
				confined to one location such that dungeons will one to one swap with each other.
			</p>
			<p>Other than on Light World Death Mountain, interiors are shuffled but still connect the
				same points on the overworld. On Death Mountain, entrances are connected more freely.
			</p>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Restricted</h3>
		</div>
		<div class="panel-body">
			<p>Uses dungeon shuffling from Simple but freely connects remaining entrances. Caves and
				dungeons with multiple entrances will be confined to one world.</p>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Full</h3>
		</div>
		<div class="panel-body">
			<p>Mixes cave and dungeon entrances freely. Caves and dungeons with multiple entrances
				will be confined to one world.</p>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Crossed</h3>
		</div>
		<div class="panel-body">
			<p>Mixes cave and dungeon entrances freely, but now connector caves and dungeons can link
				Light World and Dark World.</p>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Insanity</h3>
		</div>
		<div class="panel-body">
			<p>Decouples entrances and exits from each other and shuffles them freely. Caves that
				were single entrance in vanilla still can only exit to the same location from which
				they were entered.</p>
		</div>
	</div>

</div>
@overwrite
