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
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2">
	<nav class="navbar navbar-default navbar-fixed-side">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="width:100%" href="/"><img class="center-block" src="/i/logo.png" title="ALttP VT Randomizer" /></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					<li{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer'])) ? ' class="active"' : '' !!}>
						<a href="/randomizer">Item Randomizer <span class="glyphicon glyphicon-expand"></span></a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a data-toggle="tab" href="#custom-generate">Generate Custom Game</a></li>
					<li><a data-toggle="tab" href="#custom-settings">Settings</a></li>
					<li><a data-toggle="tab" href="#custom-equipment">Starting Equipment</a></li>
					<li><a data-toggle="tab" href="#custom-item-select">Item Pool</a></li>
					<li class="dropdown hidden regions">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Regions <span class="caret"></span></a>
						<ul class="dropdown-menu">
						@foreach($world->getRegions() as $name => $region)
							<li><a data-toggle="tab" href="#custom-region-{{ str_replace(' ', '_', $name) }}">{{ $name }}</a></li>
						@endforeach
						</ul>
					</li>
					<li><a>VT 2017</a></li>
				</ul>
			</div>
		</div>
	</nav>
    </div>
    <div class="col-md-9 col-lg-10">
	@yield('content')
    </div>
  </div>
</div>
</body>
</html>
