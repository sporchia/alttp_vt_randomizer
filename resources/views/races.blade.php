@extends('layouts.default', ['title' => 'Racing - '])

@section('content')
<h1>Organized Play</h1>
<div class="card card-body bg-light">
	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Races</h3>
		</div>
		<div class="card-body">
			<p>Most races are done through
				<a href="https://speedracing.tv/" target="_blank" rel="noopener noreferrer">SpeedRacing.tv</a> or
				<a href="http://speedrunslive.com" target="_blank" rel="noopener noreferrer">SpeedRunsLive.com</a>.
				Be sure to check them out for more info on how to get in on the action!</p>
			<h4>Weekly Standard Mode Race, Saturdays at 3pm US Eastern Time</h4>
			<p>The premier community event, the weekly race consistently reaches over 100 competitors!</p>
			<h4>Weekly Open Mode Race, Saturdays at 5pm US Eastern Time</h4>
			<p>Join us Sundays for another popular weekly community race.</p>
			<h4>Pickup Races</h4>
			<p>Scheduled races not fitting in with your schedule? Looking to race with some more uncommon
				options? Join a pickup race! You'll find willing players at all hours of the day. Join
				the #race-planning channel in our
				<a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>!
			</p>
		</div>
	</div>

	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Watch</h3>
		</div>
		<div class="card-body">
			<p>With so much going on, there's always a race to watch! Follow these networks and never
				miss a match!</p>
			<div class="btn-wrapper">
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal1"
					href="https://twitch.tv/alttprandomizer"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer</a></div>
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal2"
					href="https://twitch.tv/alttprandomizer2"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer2</a></div>
			</div>
			<div class="btn-wrapper">
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal3"
					href="https://twitch.tv/alttprandomizer3"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer3</a></div>
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal4"
					href="https://twitch.tv/alttprandomizer4"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer4</a></div>
			</div>
			<div class="center">
				<a class="btn btn-lg btn-xl btn-cal5">Currently Unscheduled</a>
			</div><br/>
			<p class="center"><iframe src="https://calendar.google.com/calendar/embed?mode=WEEK&height=600&wkst=1&bgcolor=%23FFFFFF&src=alttprandomizer%40gmail.com&color=%23711616&src=619so5cq75d5jnbcv1sbmaaiq4%40group.calendar.google.com&color=%232952A3&src=178t5rnk4uq8u9ge7otmg0goug%40group.calendar.google.com&color=%23875509&src=vqov7jnhlur2pqva0q0fq61qpg%40group.calendar.google.com&color=%23528800&src=3flvk65tefruq3j158ed93hrb8%40group.calendar.google.com&color=%23333333" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe></p>
			<div style="text-align:center;"><a
				class="btn btn-primary btn-lg btn-xl"
				href="https://www.twitch.tv/communities/lttprandomizer/"
				rel="noopener noreferrer"
				role="button"
				target="_blank">ALttP:R Twitch Community</a></div>
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Racing Networks</h3>
		</div>
		<div class="card-body">
			<p>Racing is typically done on a racing network. These sites facilitate in organizing races, adding an official timer, and making it easier for both racers and viewers to find races.</p>
			<p>Be sure to check out both <a href="http://speedrunslive.com" target="_blank" rel="noopener noreferrer">SpeedRunsLive.com</a> and <a href="http://speedracing.tv" target="_blank" rel="noopener noreferrer">SpeedRacing.tv</a> for more info!</p>
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Tournaments</h3>
		</div>
		<div class="card-body">
			<p>Join us for exciting tournament action with expert commentary alongside elite play!</p>
			<h4>Twice-Yearly Invitational Tournament</h4>
			<p>Witness the 100 best racers compete for the trophy! Think you have what it takes to go
				toe-to-toe with the best? Join
				<a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>
				and keep an eye out for qualifying races!</p>
			<p>The Spring Invitational runs from March to June.</p>
			<p>The Fall Invitational runs from September to December.</p>
		</div>
	</div>
</div>
@overwrite
