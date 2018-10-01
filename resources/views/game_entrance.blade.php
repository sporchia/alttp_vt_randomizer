@extends('layouts.default', ['title' => __('navigation.game_entrance') . ' - '])

@section('content')
<h1>{{ __('entrance_options.header') }}</h1>
<div class="card card-body bg-light">
	<p>{{ __('entrance_options.subheader') }}</p>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('entrance_options.cards.simple.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('entrance_options.cards.simple.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>

	<div class="card border-warning mt-4">
		<div class="card-header bg-warning">
			<h3 class="card-title">{{ __('entrance_options.cards.restricted.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('entrance_options.cards.restricted.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>

	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

	<div class="card border-warning mt-4">
		<div class="card-header bg-warning">
			<h3 class="card-title">{{ __('entrance_options.cards.full.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('entrance_options.cards.full.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>

	<div class="card border-danger mt-4">
		<div class="card-header bg-danger">
			<h3 class="card-title text-white">{{ __('entrance_options.cards.crossed.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('entrance_options.cards.crossed.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>

	<div class="card border-danger mt-4">
		<div class="card-header bg-danger">
			<h3 class="card-title text-white">{{ __('entrance_options.cards.insanity.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('entrance_options.cards.insanity.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>
</div>
@overwrite
