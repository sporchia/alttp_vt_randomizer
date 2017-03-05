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
			<p>This mode starts link in his house with Uncle already in sewers, you are free to explore. Special notes:</p>
			<ul>
				<li>Uncle is a normal location, and most likely does not have a sword.</li>
				<li>Dark rooms do not get a free light cone.</li>
			</ul>
		</div>
	</div>

</div>
@overwrite
