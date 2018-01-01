@extends('layouts.default')

@section('content')
<img src="/i/logo-large.png" style="margin:-11% 0;width:100%" />
<a
	class="btn btn-primary btn-lg btn-cta"
	href="/start"
	role="button">Start Playing</a>
<a
	class="btn btn-outline-secondary btn-lg btn-cta"
	href="https://discord.gg/TCC6Y42"
	role="button"
	target="_blank">Join our Discord</a>
<div class="well">
	<p>ALttP: Randomizer is a new take on the classic game The Legend of Zelda: A Link to the Past.
		Each playthrough of ALttP: Randomizer shuffles the location of all the important items in
		the game. Will you find the Bow atop Death Mountain, the Fire Rod resting silently in the
		library, or even the Master Sword itself waiting in a chicken coup?</p>
	<p>Challenge your friends to get the fastest time on a particular shuffle or take part in the
		<a href="/races">weekly speedrun competition</a>. Hone your skills enough and maybe you'll
		take home the crown in our <a href="/races">twice-yearly invitational tournament</a>. See you
		in Hyrule!</p>
	<p>The VT Randomizer is a web based ROM patcher. Simply provide your ROM of the base game and
		the website does the all the work, giving you back a fully shuffled and guaranteed
		beatable ROM. With the web based ROM patcher, you can always be sure you have the latest
		features as soon as they're released.</p>
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
