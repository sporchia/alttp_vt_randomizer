@extends('layouts.default')

@section('content')
<h1>What are the different Variations?</h1>
<div class="well">
<p>Variations are new ways to play the game we already know and love.</p>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Timed Race</h3>
		</div>
		<div class="panel-body">
			<p>In this mode the timer is counting up, and the person with the best time wins the game
				irrelevent of who beats Ganon first.</p>
			<p>Do you spend some time looking for a clock to adjust your timer down? Or just race
				to the end?</p>
			<p>This mode has:</p>
			<ul>
				<li>Start with 0 minutes on the timer</li>
				<li>20 Green clocks that subtract 4 minutes from your timer</li>
				<li>10 Blue clocks that subtract 2 minutes to your timer</li>
				<li>10 Red clocks that add 2 minutes to your timer</li>
			</ul>

		</div>
	</div>
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Timed OHKO (one hit knock out)</h3>
		</div>
		<div class="panel-body">
			<p>In this mode you start with 10 minutes on the timer, every clock you find will add time to
				your total time. But if you let the timer reach 0, then you'll be in OHKO mode.</p>
			<p>Don't dispair though, if you are in OHKO mode and find another clock (no matter how
				long you have been in OHKO), you get the time of the clock added to your timer.</p>
			<p>This mode has:</p>
			<ul>
				<li>Start with 10 minutes on the timer</li>
				<li>25 Green clocks that add 5 minutes to your timer</li>
			</ul>
		</div>
	</div>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">OHKO (one hit knock out)</h3>
		</div>
		<div class="panel-body">
			<p>Same game as normal, but take any damage and Link is a goner.</p>
		</div>
	</div>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Triforce Hunt</h3>
		</div>
		<div class="panel-body">
			<p>Ganon has broken up the triforce into a bunch of pieces, have fun finding them all. The game ends
				when you collect enough of them.</p>
		</div>
	</div>

</div>
@overwrite
