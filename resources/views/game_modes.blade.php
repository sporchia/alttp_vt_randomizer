@extends('layouts.default')

@section('content')
<h1>What are the different Modes?</h1>
<div class="well">
<p>There are logic rules in place which prevent you from being locked out of progression and guaranteeing that you’ll
	be able to finish the game every time regardless of the distribution of items. The different game modes use
	different logic and assume different levels of game knowledge and ability.</p>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Standard</h3>
		</div>
		<div class="panel-body">
			<p>This mode requires no advanced knowledge about the game. It’s designed as if you were playing the original
				game for the first time.</p>
		</div>
	</div>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Open</h3>
		</div>
		<div class="panel-body">
			<p>This mode may require knowledge of various techniques and minor glitches.</p>
			<ul>
				<li>Bomb jumps (may be required in Ice Palace and Ganon’s Tower)</li>
				<li>Fake flippers (allows access to Ice Palace, King Zora, Lake Hylia HP and the Hobo without Flippers)</li>
				<li>Dungeon bunny revival (allows access to Ice Palace without the Moon Pearl)</li>
				<li>Overworld bunny revival (allows access to Misery Mire and the nearby two chests without the Moon Pearl)</li>
				<li>Super bunny (allows access to two chests in Dark World Death Mountain without the Moon Pearl)</li>
				<li>Surfing bunny (allows access to Lake Hylia HP without the Moon Pearl)</li>
			</ul>
		</div>
	</div>

</div>
@overwrite
