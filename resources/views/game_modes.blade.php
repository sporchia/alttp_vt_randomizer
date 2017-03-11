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

</div>
@overwrite
