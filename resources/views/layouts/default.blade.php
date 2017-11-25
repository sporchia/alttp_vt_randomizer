<!DOCTYPE html>
<html lang="en">
<head>
	<title>ALttP VT Randomizer</title>
	<meta name="keywords" content="ALttP, Randomizer, patcher">
	<meta name="description" content="ALttP Web VT Randomizer">
	<meta charset="utf-8" />

	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">

	<script src="{{ elixir('js/app.js') }}"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="/i/logo.png" title="ALttP VT Randomizer" /></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					<li{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer'])) ? ' class="active"' : '' !!}><a href="/randomizer">Generate Randomized Game</a></li>
					<li{!! (in_array(request()->path(), ['customizer'])) ? ' class="active"' : '' !!}><a href="/customizer">Generate Customized Game</a></li>
					<li{!! (in_array(request()->path(), ['daily'])) ? ' class="active"' : '' !!}><a href="/daily">Daily Game</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Help <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li{!! (request()->path() == 'game_difficulties') ? ' class="active"' : '' !!}><a href="/game_difficulties">Difficulties</a></li>
							<li{!! (request()->path() == 'game_logics') ? ' class="active"' : '' !!}><a href="/game_logics">Logics</a></li>
							<li{!! (request()->path() == 'game_modes') ? ' class="active"' : '' !!}><a href="/game_modes">Modes</a></li>
							<li{!! (request()->path() == 'game_variations') ? ' class="active"' : '' !!}><a href="/game_variations">Variations</a></li>
							<li{!! (request()->path() == 'game_entrance') ? ' class="active"' : '' !!}><a href="/game_entrance">Entrance Randomizer</a></li>
							<li{!! (request()->path() == 'help') ? ' class="active"' : '' !!}><a href="/help">Help</a></li>
							<li><a href="https://discord.gg/yEvqSRk" target="_blank">Join us on Discord</a></li>
						</ul>
					</li>
					<li{!! (request()->path() == 'updates') ? ' class="active"' : '' !!}><a href="/updates">Updates</a></li>
			  		<li><a href="https://github.com/sporchia/alttp_vt_randomizer/issues/new" target="_blank">Report Issue</a></li>
					@if (Auth::check())
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
					  <ul class="dropdown-menu">
						<li><a href="/auth/logout">Logout</a></li>
					  </ul>
					</li>
					@else
					<!-- <li{!! (request()->path() == 'about') ? ' class="active"' : '' !!}><a href="/auth/login">Login</a></li> -->
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<div class="clearfix" style="padding-top:70px"></div>
	<div class="container">
	@yield('content')
	</div>
	<script>
@if (App::environment() == 'production')
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '{{ env('GA_CODE') }}', 'auto');
		ga('send', 'pageview');
@else
		ga = function() {
		    console.log(arguments);
		};
@endif
	</script>
</body>
</html>
