@extends('layouts.default')

@php
$title = 'Start Watching - ';
@endphp

@section('content')
<h1>Join the Adventure!</h1>
<div class="card card-body bg-light">
	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Twitch</h3>
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
			<div class="center"><a
				class="btn btn-primary btn-lg btn-xl"
				href="https://www.twitch.tv/communities/lttprandomizer/"
				rel="noopener noreferrer"
				role="button"
				target="_blank">ALttP:R Twitch Community</a></div>
		</div>
	</div>

	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Tournaments</h3>
		</div>
		<div class="card-body">
			<h4>Upcoming Tournaments</h4>
			<p>Join us for the 2018 Spring Invitational starting this March! Join our <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a> community to stay up to date!</p>
			<h4>2017 Fall Invitational</h4>
			<p>The <span style="font-weight:bold;">2017 Fall Invitational</span> has wrapped up!</p>
			<p><a href="https://www.youtube.com/playlist?list=PLdoWICJMgPKWZKYiZD1uLn529-fdHHqUK" target="_blank" rel="noopener noreferrer">Watch all the matches here!</a></p>
			<div class="center"><iframe
				allow="encrypted-media"
				allowfullscreen
				frameborder="0"
				gesture="media"
				height="315"
				src="https://www.youtube.com/embed/iAmfUsMJONw?rel=0"
				width="560"></iframe></div>
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">Youtube</h3>
		</div>
		<div class="card-body">
			<div class="center"><a
				class="btn btn-secondary btn-lg btn-xl"
				href="https://www.youtube.com/channel/UCBMMk0WJAeldNv4fI9juovA"
				rel="noopener noreferrer"
				role="button"
				target="_blank">ALttP:R Youtube Channel</a></div><br/>
			<p>Subscribe to our Youtube channel for updates, tournament highlights, and more!</p>
		</div>
	</div>
</div>
@overwrite
