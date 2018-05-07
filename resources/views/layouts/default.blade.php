@extends('layouts.base')

@section('window')
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<a class="navbar-brand" href="/"><img src="/i/logo.png" title="ALttP VT Randomizer" alt="ALttP Randomizer logo" /></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item{!! (request()->path() == 'start') ? ' active' : '' !!}"><a class="nav-link" href="/start">Start Playing</a></li>
				<li class="nav-item{!! (request()->path() == 'watch') ? ' active' : '' !!}"><a class="nav-link" href="/watch">Start Watching</a></li>
				<li class="nav-item dropdown{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer', 'daily', 'customizer'])) ? ' active' : '' !!}">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generate Game <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer'])) ? ' active' : '' !!}" href="/randomizer">Generate Randomized Game</a>
						<a class="dropdown-item{!! (in_array(request()->path(), ['daily'])) ? ' active' : '' !!}" href="/daily">Daily Challenge</a>
						<a class="dropdown-item{!! (in_array(request()->path(), ['customizer'])) ? ' active' : '' !!}" href="/customizer">Create Customized Game</a>
					</div>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Help <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item{!! (request()->path() == 'resources') ? ' active' : '' !!}" href="/resources">Resources</a>
						<a class="dropdown-item{!! (request()->path() == 'options') ? ' active' : '' !!}" href="/options">Game Options</a>
						<a class="dropdown-item{!! (request()->path() == 'races') ? ' active' : '' !!}" href="/races">Organized Play</a>
						<a class="dropdown-item{!! (request()->path() == 'updates') ? ' active' : '' !!}" href="/updates">Updates</a>
						<a class="dropdown-item{!! (request()->path() == 'game_entrance') ? ' active' : '' !!}" href="/game_entrance">Entrance Randomizer</a>
						<a class="dropdown-item{!! (request()->path() == 'contribute') ? ' active' : '' !!}" href="/contribute">Contribute</a>
						<a class="dropdown-item" href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Join us on Discord</a>
						<a class="dropdown-item" href="https://github.com/sporchia/alttp_vt_randomizer/issues/new" target="_blank" rel="noopener noreferrer">Report Issue</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	<div class="clearfix" style="padding-top:70px"></div>
	<div class="container">
	@yield('content')
	</div>
@overwrite
