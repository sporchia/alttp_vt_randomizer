@extends('layouts.default')

@section('content')
<img src="/i/logo-large.png" style="margin:-11% 0 -10% 0;width:100%" />
<div class="btn-wrapper">
<div class="btn-cta"><a
	class="btn btn-primary btn-lg"
	href="/{{ app()->getLocale() }}/start"
	role="button">{{ __('navigation.start_playing') }}</a></div>
<div class="btn-cta"><a
	class="btn btn-outline-secondary btn-lg"
	href="/{{ app()->getLocale() }}/watch"
	role="button"
	style="margin-left:20px;">{{ __('navigation.start_watching') }}</a></div>
</div>
<div class="card card-body bg-light" style="font-size:22px;margin-top:40px;">
	@foreach (__('about.content') as $block)
		<p>{!! $block !!}</p>
	@endforeach
</div>

<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

<div class="card card-body bg-light">
	<iframe class="mx-auto"
		allow="encrypted-media"
		allowfullscreen
		frameborder="0"
		gesture="media"
		height="315"
		src="https://www.youtube.com/embed/YaEypVa3kx4?rel=0"
		width="560"></iframe>
</div>
@overwrite
