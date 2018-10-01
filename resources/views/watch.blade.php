@extends('layouts.default', ['title' => __('navigation.start_watching') . ' - '])

@section('content')
<h1>{{ __('watch.header') }}</h1>
<div class="card card-body bg-light">
	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('watch.cards.twitch.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('watch.cards.twitch.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
			<div class="btn-wrapper">
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal1"
					href="https://twitch.tv/alttprandomizer"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer</a></div>
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal2"
					href="https://twitch.tv/alttprandomizer2"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer2</a></div>
			</div>
			<div class="btn-wrapper">
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal3"
					href="https://twitch.tv/alttprandomizer3"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer3</a></div>
				<div class="btn-cal"><a
					class="btn btn-lg btn-xl btn-cal4"
					href="https://twitch.tv/alttprandomizer4"
					rel="noopener noreferrer"
					role="button"
					target="_blank">twitch.tv/ALttPRandomizer4</a></div>
			</div>
			<div class="center">
				<a class="btn btn-lg btn-xl btn-cal5">Currently Unscheduled</a>
			</div><br/>
			<p class="center"><iframe src="https://calendar.google.com/calendar/embed?mode=WEEK&height=600&wkst=1&bgcolor=%23FFFFFF&src=alttprandomizer%40gmail.com&color=%23711616&src=619so5cq75d5jnbcv1sbmaaiq4%40group.calendar.google.com&color=%232952A3&src=178t5rnk4uq8u9ge7otmg0goug%40group.calendar.google.com&color=%23875509&src=vqov7jnhlur2pqva0q0fq61qpg%40group.calendar.google.com&color=%23528800&src=3flvk65tefruq3j158ed93hrb8%40group.calendar.google.com&color=%23333333" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe></p>
			<div class="center"><a
				class="btn btn-primary btn-lg btn-xl"
				href="https://www.twitch.tv/communities/lttprandomizer/"
				rel="noopener noreferrer"
				role="button"
				target="_blank">{{ __('watch.cards.twitch.button') }}</a></div>
		</div>
	</div>

	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('watch.cards.tournament.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('watch.cards.tournament.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('watch.cards.youtube.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('watch.cards.youtube.content') as $block)
				<p>{!! $block !!}</p>
			@endforeach
		</div>
	</div>
</div>
@overwrite
