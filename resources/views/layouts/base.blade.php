<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ $title or '' }}ALttP VT Randomizer</title>
	<meta name="keywords" content="ALttP, Randomizer, patcher">
	<meta name="description" content="ALttP Web VT Randomizer">
	<meta charset="utf-8" />
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<script src="{{ mix('js/app.js') }}"></script>
</head>
<body>
	@yield('window')

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
	@if (App::environment() == 'production' || env('AD_TEST'))
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	@endif
</body>
</html>
