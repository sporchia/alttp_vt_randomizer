@extends('layouts.default', ['title' => __('navigation.options') . ' - '])

@section('content')
<h1>{{ __('options.header') }}</h1>
<div  id="options" class="card card-body bg-light">
	<h2>{!! __('options.subheader') !!}</h2>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('options.cards.mode.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('options.cards.mode.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('options.cards.weapons.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('options.cards.weapons.sections') as $section)
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
			<h3 class="card-title text-white">{{ __('options.cards.logic.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('options.cards.logic.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('options.cards.goal.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('options.cards.goal.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('options.cards.difficulty.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('options.cards.difficulty.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					<p>{!! $block !!}</p>
				@endforeach
			@endforeach
			<h4>{{ __('options.cards.difficulty.comparison.header') }}</h4>
			<table class="table table-sm">
			<thead><tr>
				<th></th>
				<th>{{ __('randomizer.difficulty.options.easy') }}</th>
				<th>{{ __('randomizer.difficulty.options.normal') }}</th>
				<th>{{ __('randomizer.difficulty.options.hard') }}</th>
				<th>{{ __('randomizer.difficulty.options.expert') }}</th>
				<th>{{ __('randomizer.difficulty.options.insane') }}</th>
			</tr></thead>
			<tbody><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.maximum_health') }}</td>
				<td>20</td>
				<td>20</td>
				<td>14</td>
				<td>9</td>
				<td>3</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.heart_containers') }}</td>
				<td>11</td>
				<td>11</td>
				<td>6</td>
				<td>1</td>
				<td>0</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.heart_pieces') }}</td>
				<td>24</td>
				<td>24</td>
				<td>20</td>
				<td>20</td>
				<td>0</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.maximum_mail') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.mail_3') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.mail_3') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.mail_2') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.mail_1') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.mail_1') }}</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.number_in_pool') }}</td>
				<td>4</td>
				<td>2</td>
				<td>1</td>
				<td>0</td>
				<td>0</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.maximum_sword') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.sword_4') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.sword_4') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.sword_3') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.sword_2') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.sword_2') }}</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.number_in_pool') }}</td>
				<td>8</td>
				<td>4</td>
				<td>4</td>
				<td>4</td>
				<td>4</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.maximum_shield') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.shield_3') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.shield_3') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.shield_2') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.shield_1') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.none') }}</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.number_in_pool') }}</td>
				<td>6</td>
				<td>3</td>
				<td>3</td>
				<td>3</td>
				<td>0</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.shields_store') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.maximum_magic') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.quarter') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.half') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.number_in_pool') }}</td>
				<td>2</td>
				<td>1</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.number_silvers') }}</td>
				<td>2</td>
				<td>1</td>
				<td>1<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.silvers') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
				<td>1<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.silvers') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
				<td>0</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.number_silvers_swordless') }}</td>
				<td>2</td>
				<td>1</td>
				<td>1<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.silvers') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
				<td>1<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.silvers') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
				<td>1<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.silvers') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.number_bottles') }}</td>
				<td>8<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.bottles') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
				<td>4</td>
				<td>4</td>
				<td>4</td>
				<td>4</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.number_lamps') }}</td>
				<td>3</td>
				<td>1</td>
				<td>1</td>
				<td>1</td>
				<td>1</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.potion_magic') }}<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.potion_magic') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
				<td>100%</td>
				<td>100%</td>
				<td>50%</td>
				<td>25%</td>
				<td>0%</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.potion_health') }}
					<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.potion_health') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span>
				</td>
				<td>20</td>
				<td>20</td>
				<td>7</td>
				<td>1</td>
				<td>0</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.bug_net_fairy') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.powder_bubble') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.fairy') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.fairy') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.heart') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.heart') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.bee') }}</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.cape_consumption') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
				<td>2x</td>
				<td>3x</td>
				<td>4x</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.byrna_invincible') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.stun_boomerang') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.stun_hookshot') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
				<td>{{ __('options.cards.difficulty.comparison.no') }}</td>
			</tr><tr class="table-primary">
				<td>{{ __('options.cards.difficulty.comparison.capacity_upgrade') }}</td>
				<td>7</td>
				<td>7</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr><tr class="table-secondary">
				<td>{{ __('options.cards.difficulty.comparison.drop_rates') }}</td>
				<td>100%</td>
				<td>50%</td>
				<td>50%</td>
				<td>25%</td>
				<td>25%</td>
			</tr></tbody>
			</table>

		</div>
	</div>

	<div class="card border-info mt-4">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('options.cards.variation.header') }}</h3>
		</div>
		<div class="card-body">
			@foreach (__('options.cards.variation.sections') as $section)
			<h4>{{ $section['header'] }}</h4>
				@foreach ($section['content'] as $block)
					@if (is_array($block))
						<h5>{{ $block['header'] }}</h5>
						@foreach ($block['content'] as $subblock)
							<p>{!! $subblock !!}</p>
						@endforeach
					@else
						<p>{!! $block !!}</p>
					@endif
				@endforeach
				@if (isset($section['ohko_table']))
				<table class="table table-sm">
				<thead>
					<tr>
						<th class="w-25">{{ __('randomizer.difficulty.title') }}</th>
						<th class="w-25">{{ $section['ohko_table']['start_time'] }}</th>
						<th class="w-25">{{ $section['ohko_table']['green_clock'] }}</th>
						<th class="w-25">{{ $section['ohko_table']['red_clock'] }}</th>
					</tr>
				</thead>
				<tbody><tr class="bg-info text-white">
					<td>{{ __('randomizer.difficulty.options.easy') }}</td>
					<td>20 {{ $section['ohko_table']['minutes'] }}</td>
					<td>30</td>
					<td>0</td>
				</tr><tr class="bg-success text-white">
					<td>{{ __('randomizer.difficulty.options.normal') }}</td>
					<td>10 {{ $section['ohko_table']['minutes'] }}</td>
					<td>25</td>
					<td>0</td>
				</tr><tr class="bg-warning">
					<td>{{ __('randomizer.difficulty.options.hard') }}</td>
					<td>7.5 {{ $section['ohko_table']['minutes'] }}</td>
					<td>20</td>
					<td>1</td>
				</tr><tr class="bg-danger text-white">
					<td>{{ __('randomizer.difficulty.options.expert') }}</td>
					<td>5 {{ $section['ohko_table']['minutes'] }}</td>
					<td>15</td>
					<td>3</td>
				</tr><tr class="bg-danger text-white">
					<td>{{ __('randomizer.difficulty.options.insane') }}</td>
					<td>0 {{ $section['ohko_table']['minutes'] }}</td>
					<td>10</td>
					<td>5</td>
				</tr></tbody>
				</table>
				@endif
			@endforeach
		</div>
	</div>

	<div class="card border-info mt-4" id="item-pool">
		<div class="card-header bg-info">
			<h3 class="card-title text-white">{{ __('options.cards.item_pool') }}</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<ul>
						<li>6x Arrow Upgrade (+5)</li>
						<li>1x Arrow Upgrade (+10)</li>
						<li>10x Big Key</li>
						<li>1x Blue Mail</li>
						<li>6x Bomb Upgrade (+5)</li>
						<li>1x Bomb Upgrade (+10)</li>
						<li>1x Bombos</li>
						<li>1x Book Of Mudora</li>
						<li>1x Boomerang</li>
						<li>4x Bottle (filled with assorted things)</li>
						<li>1x Bow</li>
						<li>1x Bug Catching Net</li>
						<li>1x Cane Of Byrna</li>
						<li>1x Cane Of Somaria</li>
						<li>11x Compass</li>
						<li>12x Dungeon Map</li>
						<li>1x Ether</li>
						<li>1x Fighters Shield</li>
						<li>1x Fighters Sword</li>
						<li>1x Fire Rod</li>
						<li>1x Fire Shield</li>
						<li>1x Flippers</li>
						<li>1x Flute</li>
						<li>1x Golden Sword</li>
						<li>1x ½ Magic</li>
						<li>1x Hammer</li>
						<li>11x Heart Container</li>
						<li>1x Hookshot</li>
						<li>1x Ice Rod</li>
					</ul>
				</div>
				<div class="col-md-6">
					<ul>
						<li>28x Small Key</li>
						<li>1x Lamp</li>
						<li>1x Magic Cape</li>
						<li>1x Magic Mirror</li>
						<li>1x Magic Powder</li>
						<li>1x Magical Boomerang</li>
						<li>1x Master Sword</li>
						<li>1x Mirror Shield</li>
						<li>1x Moon Pearl</li>
						<li>1x Mushroom</li>
						<li>1x Pegasus Boots</li>
						<li>24x Piece Of Heart</li>
						<li>1x Power Glove</li>
						<li>1x Quake</li>
						<li>1x Red Mail</li>
						<li>1x Shovel</li>
						<li>1x Silver Arrows Upgrade</li>
						<li>1x Tempered Sword</li>
						<li>1x Titans Mitt</li>
					</ul>
					<ul>
						<li>5x Ten Arrows</li>
						<li>1x Single Arrow</li>
						<li>1x Ten Bombs</li>
						<li>9x Three Bombs</li>
						<li>5x Three Hundred Rupees</li>
						<li>1x One Hundred Rupees</li>
						<li>7x Fifty Rupees</li>
						<li>28x Twenty Rupees</li>
						<li>4x Five Rupees</li>
						<li>2x One Rupee</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
new Vue({
	el: '#options',
});
</script>
@overwrite
