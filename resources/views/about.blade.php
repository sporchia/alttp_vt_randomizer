@extends('layouts.default')

@section('content')
<img src="/i/logo-large.png" style="margin:-11% 0 -10% 0;width:100%" />
<div class="btn-wrapper">
<div class="btn-cta"><a
	class="btn btn-primary btn-lg"
	href="/start"
	role="button">Start Playing</a></div>
<div class="btn-cta"><a
	class="btn btn-outline-secondary btn-lg"
	href="/watch"
	role="button"
	style="margin-left:20px;">Start Watching</a></div>
</div>
<div class="well" style="font-size:22px;margin-top:40px;">
	<p><span style="font-weight:bold;">ALttP: Randomizer</span> is a new take on the classic game The Legend of Zelda: A Link to the Past.
		Each playthrough shuffles the location of all the important items in
		the game. Will you find the Bow atop Death Mountain, the Fire Rod resting silently in the
		library, or even the Master Sword itself waiting in a chicken coup?</p>
	<p>Challenge your friends to get the fastest time on a particular shuffle or take part in the
		<a href="/races">weekly speedrun competition</a>. Hone your skills enough and maybe you'll
		take home the crown in our <a href="/races">twice-yearly invitational tournament</a>. See you
		in Hyrule!</p>
</div>
<div class="well" style="text-align:center;">
	<iframe
		allow="encrypted-media"
		allowfullscreen
		frameborder="0"
		gesture="media"
		height="315"
		src="https://www.youtube.com/embed/YaEypVa3kx4?rel=0"
		width="560"></iframe>
</div>
@overwrite
