<!DOCTYPE html>
<html lang="en">
<head>
	<title>ALttP VT Randomizer</title>
	<meta name="keywords" content="ALttP, Randomizer, patcher">
	<meta name="description" content="ALttP Web VT Randomizer">
	<meta charset="utf-8" />

	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">

	<script src="{{ elixir('js/app.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
				<a class="navbar-brand" href="/">ALttP VT Randomizer</a>
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
