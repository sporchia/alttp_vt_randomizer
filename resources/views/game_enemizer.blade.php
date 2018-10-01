@extends('layouts.default', ['title' => __('navigation.game_enemizer') . ' - '])

@section('content')
<h1>{{ __('enemizer_options.header') }}</h1>
<div class="card card-body bg-light">
	<p>{{ __('enemizer_options.subheader') }}</p>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('enemizer_options.cards.enemy_health.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('enemizer_options.cards.enemy_health.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('enemizer_options.cards.enemy_damage.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('enemizer_options.cards.enemy_damage.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
		</div>
	</div>

	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('enemizer_options.cards.bosses.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('enemizer_options.cards.bosses.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('enemizer_options.cards.enemy_shuffle.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('enemizer_options.cards.enemy_shuffle.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('enemizer_options.cards.pot_shuffle.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('enemizer_options.cards.pot_shuffle.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('enemizer_options.cards.palette_shuffle.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('enemizer_options.cards.palette_shuffle.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>
</div>
@overwrite
