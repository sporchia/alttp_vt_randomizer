@extends('layouts.default')

@section('content')
<h1>What are the different Logics?</h1>
<div class="well">
<p>There are logic rules in place which prevent you from being locked out of progression and guaranteeing that you’ll
	be able to finish the game every time regardless of the distribution of items. The different game modes use
	different logic and assume different levels of game knowledge and ability.</p>

<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">No Glitches</h3>
	</div>
	<div class="panel-body">
		<p>This mode requires no advanced knowledge about the game. It’s designed as if you were playing the original
			game for the first time.</p>
		<p>The logic will prevent you from getting stuck anywhere regardless of how you use small keys within dungeons.
			However you may be required to Save and Quit in certain situations.</p>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Overworld Glitches</h3>
	</div>
	<div class="panel-body">
		<p>This mode is meant for people looking to dip their toes into the wonderful world of Link to the Past Glitches.</p>
		<ul>
			<li>Fake flippers (allows access to Ice Palace, King Zora, Lake Hylia HP and the Hobo without Flippers)</li>
			<li>Dungeon bunny revival (allows access to Ice Palace without the Moon Pearl)</li>
			<li>Overworld bunny revival (allows access to Misery Mire and the nearby two chests without the Moon Pearl)</li>
			<li>Super bunny (allows access to two chests in Dark World Death Mountain without the Moon Pearl)</li>
			<li>Surfing bunny (allows access to Lake Hylia HP without the Moon Pearl)</li>
		</ul>
	</div>
</div>

<div class="panel panel-warning">
	<div class="panel-heading">
		<h3 class="panel-title">Major Glitches</h3>
	</div>
	<div class="panel-body">
		<p>This mode accounts for everything besides EG and semi-EG which are two extremely powerful glitches allowing
			you to walk through floors or under walls… and even reach the Triforce in under 2 minutes! This mode is
			very difficult and may require advanced knowledge of major glitches.</p>
		<ul>
			<li>Overworld YBA</li>
			<li>Clipping out of bounds</li>
			<li>Screenwraps</li>
		</ul>

		<p>These techniques allow you reach a multitude of locations with very few items. To learn more please see
			<a href="https://docs.google.com/document/d/1LRnLCyIIvNAAvIaXnYhiDxblIhIJgTlboMuSOvrp3P4/" target="_blank">this guide</a></p>

		<p>In addition some of the changes listed in the above section have been removed to allow this version to work correctly.</p>
		<ul>
			<li>The fake dark world is no longer patched out and crystals always drop irrespective of pendant conflicts</li>
			<li>Swamp Palace water levels do not drain when you exit the overworld screen (except for the first room)</li>
			<li>You will always s+q to the Pyramid after defeating Agahnim when in the Dark World</li>
		</ul>
	</div>
</div>
</div>
@overwrite
