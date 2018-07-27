<!DOCTYPE html>
<html lang="en">
<head>
	<title>Super Metroid and A Link to the Past Combo Randomizer</title>
	<meta name="keywords" content="ALttP, SM, Combo, Randomizer, patcher">
	<meta name="description" content="Super Metroid and A Link to the Past Combo Randomizer">
	<meta charset="utf-8" />

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">

	<script src="{{ mix('js/app.js') }}"></script>
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
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					<li class="dropdown{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer', 'daily', 'customizer'])) ? ' active' : '' !!}">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generate Game <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer'])) ? ' class="active"' : '' !!}><a href="/randomizer">Generate Randomized Game</a></li>
							<!-- <li{!! (in_array(request()->path(), ['customizer'])) ? ' class="active"' : '' !!}><a href="/customizer">Create Customized Game</a></li> -->
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Help <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<!--
							<li{!! (request()->path() == 'resources') ? ' class="active"' : '' !!}><a href="/resources">Resources</a></li>						
							<li{!! (request()->path() == 'options') ? ' class="active"' : '' !!}><a href="/options">Game Options</a></li>
							<li{!! (request()->path() == 'races') ? ' class="active"' : '' !!}><a href="/races">Organized Play</a></li>
							<li{!! (request()->path() == 'updates') ? ' class="active"' : '' !!}><a href="/updates">Updates</a></li>
							<li{!! (request()->path() == 'game_entrance') ? ' class="active"' : '' !!}><a href="/game_entrance">Entrance Randomizer</a></li>
							<li{!! (request()->path() == 'contribute') ? ' class="active"' : '' !!}><a href="/contribute">Contribute</a></li>
							<li><a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Join us on Discord</a></li> -->
							<li><a href="https://github.com/tewtal/alttp_sm_combo_randomizer/issues/" target="_blank" rel="noopener noreferrer">Report Issue</a></li>
						</ul>
					</li>
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
</body>
</html>
