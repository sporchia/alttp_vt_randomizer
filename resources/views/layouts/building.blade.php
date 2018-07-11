<!DOCTYPE html>
<html lang="en">
<head>
	<title>ALttP VT Randomizer</title>
	<meta name="keywords" content="ALttP, Randomizer, patcher">
	<meta name="description" content="ALttP Web VT Randomizer">
	<meta charset="utf-8" />

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">

	<script src="{{ mix('js/app.js') }}"></script>
</head>
<body>
<div class="container-fluid h-100">
  <div class="row d-flex d-md-block flex-nowrap wraper h-100">
    <div class="col-md-3 col-lg-2 p-0 bg-dark">
		<nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
			<div class="collapse navbar-collapse">
				<ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
					<li class="nav-item">
						<a class="navbar-brand" style="width:100%" href="/"><img class="center-block" src="/i/logo.png" title="ALttP VT Randomizer" /></a>
					</li>
					<li class="nav-item">
						<a href="/randomizer">Item Randomizer <img class="icon" src="/i/svg/share.svg" alt="Item Randomizer"></a>
					</li>
					<li class="nav-item"><a data-toggle="tab" href="#custom-generate">Generate Custom Game</a></li>
					<li class="nav-item"><a data-toggle="tab" href="#custom-settings">Settings</a></li>
					<li class="nav-item"><a data-toggle="tab" href="#custom-equipment">Starting Equipment</a></li>
					<li class="nav-item"><a data-toggle="tab" href="#custom-item-select">Item Pool</a></li>
					<li class="dropdown drops">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Drops <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a data-toggle="tab" href="#custom-drops-pool">Pool</a></li>
							<li><a data-toggle="tab" href="#custom-drops-prizepacks">Prize Packs</a></li>
						</ul>
					</li>
					<li class="dropdown regions">
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
