@section('drops-prizepacks')
<?php
$prizepacks = [
	['items' => ['Heart', 'Heart', 'Heart', 'Heart', 'RupeeGreen', 'Heart', 'Heart', 'RupeeGreen'], 'name' => 'Prize Pack 1', 'other' => false],
	['items' => ['RupeeBlue', 'RupeeGreen', 'RupeeBlue', 'RupeeRed', 'RupeeBlue', 'RupeeGreen', 'RupeeBlue', 'RupeeBlue'], 'name' => 'Prize Pack 2', 'other' => false],
	['items' => ['MagicRefillFull', 'MagicRefillSmall', 'MagicRefillSmall', 'RupeeBlue', 'MagicRefillFull', 'MagicRefillSmall', 'Heart', 'MagicRefillSmall'], 'name' => 'Prize Pack 3', 'other' => false],
	['items' => ['BombRefill1', 'BombRefill1', 'BombRefill1', 'BombRefill4', 'BombRefill1', 'BombRefill1', 'BombRefill8', 'BombRefill1'], 'name' => 'Prize Pack 4', 'other' => false],
	['items' => ['ArrowRefill5', 'Heart', 'ArrowRefill5', 'ArrowRefill10', 'ArrowRefill5', 'Heart', 'ArrowRefill5', 'ArrowRefill10'], 'name' => 'Prize Pack 5', 'other' => false],
	['items' => ['MagicRefillSmall', 'RupeeGreen', 'Heart', 'ArrowRefill5', 'MagicRefillSmall', 'BombRefill1', 'RupeeGreen', 'Heart'], 'name' => 'Prize Pack 6', 'other' => false],
	['items' => ['Heart', 'Fairy', 'MagicRefillFull', 'RupeeRed', 'BombRefill8', 'Heart', 'RupeeRed', 'ArrowRefill10'], 'name' => 'Prize Pack 7', 'other' => false],
	'pull' => ['items' => ['RupeeGreen', 'RupeeBlue', 'RupeeRed'], 'name' => 'Pull Prizes', 'other' => true],
	'crab' => ['items' => ['RupeeGreen', 'RupeeRed'], 'name' => 'Bush Crab Prizes', 'other' => true],
	'stun' => ['items' => ['RupeeGreen'], 'name' => 'Stun Prize', 'other' => true],
	'fish' => ['items' => ['RupeeRed'], 'name' => 'Fish Prize', 'other' => true]
];
$enemyDrops = array_filter($prizepacks, function($v) {
	return !$v['other'];
});
$otherDrops = array_filter($prizepacks, function($v) {
	return $v['other'];
});?>
<div class="panel panel-success custom-drops-prizepacks">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Prize Packs</h3>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<div class="pb-5">
			<button id="set-vanilla" class="btn">Set Vanilla Drops</button>
			<button id="set-random" class="btn">Set Random Drops</button>
		</div>
		<ul class="nav nav-pills" role="tablist">
			@foreach ($enemyDrops as $key => $item)
			<li id="n-prizepack-{{ $key }}"<?php if ($key == '0') echo ' class="active"' ?>>
				<a data-toggle="tab" data-section="{{ $item['name'] }}" href="#prizepack-{{ $key }}">
					{{ $item['name'] }}
				</a>
			</li>
			@endforeach
			<li id="n-prizepack-other">
				<a data-toggle="tab" data-section="other" href="#prizepack-other">
					Other
				</a>
			</li>
		</ul>
		<div class="tab-content">
			@foreach ($enemyDrops as $key => $item)
			<div id="prizepack-{{ $key }}" class="tab-pane<?php if ($key == '0') echo ' active' ?>">
				<table class="table table-sm">
					<thead>
						<tr>
							<th>{{ $item['name'] }}</th>
						</tr>
					</thead>
					@foreach ($item['items'] as $innerkey => $inneritem)
					<tr>
						<td class="col-md-3">
							<select name="prize-pack-{{ $key }}-{{ $innerkey }}" class="custom-drop droppables"></select>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
			@endforeach
			<div id="prizepack-other" class="tab-pane">
				@foreach ($otherDrops as $key => $item)
				<table class="table table-sm">
					<thead>
						<tr>
							<th>{{ $item['name'] }}</th>
						</tr>
					</thead>
					@foreach ($item['items'] as $innerkey => $inneritem)
					<tr>
						<td class="col-md-3">
							<select name="prize-pack-{{ $key }}-{{ $innerkey }}" class="custom-drop droppables"></select>
						</td>
					</tr>
					@endforeach
				</table>
				@endforeach
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	var prize_packs = <?php echo json_encode($prizepacks); ?>;

	$('#set-vanilla').on('click', function() {
		for (pack in prize_packs) {
			for (item in prize_packs[pack].items) {
				$('select[name=prize-pack-' + pack + '-' + item).val(prize_packs[pack].items[item]).trigger('change');
			}
		}
	});

	$('#set-random').on('click', function() {
		for (pack in prize_packs) {
			for (item in prize_packs[pack].items) {
				$('select[name=prize-pack-' + pack + '-' + item).val('auto_fill').trigger('change');
			}
		}
	});
});
</script>
@overwrite