@section('drops-prizepacks')
<?php
$prizepacks = [
	['items' => ['Heart', 'Heart', 'Heart', 'Heart', 'RupeeGreen', 'Heart', 'Heart', 'RupeeGreen'], 'name' => 'Prize Pack 1'],
	['items' => ['RupeeBlue', 'RupeeGreen', 'RupeeBlue', 'RupeeRed', 'RupeeBlue', 'RupeeGreen', 'RupeeBlue', 'RupeeBlue'], 'name' => 'Prize Pack 2'],
	['items' => ['MagicRefillFull', 'MagicRefillSmall', 'MagicRefillSmall', 'RupeeBlue', 'MagicRefillFull', 'MagicRefillSmall', 'Heart', 'MagicRefillSmall'], 'name' => 'Prize Pack 3'],
	['items' => ['BombRefill1', 'BombRefill1', 'BombRefill1', 'BombRefill4', 'BombRefill1', 'BombRefill1', 'BombRefill8', 'BombRefill1'], 'name' => 'Prize Pack 4'],
	['items' => ['ArrowRefill5', 'Heart', 'ArrowRefill5', 'ArrowRefill10', 'ArrowRefill5', 'Heart', 'ArrowRefill5', 'ArrowRefill10'], 'name' => 'Prize Pack 5'],
	['items' => ['MagicRefillSmall', 'RupeeGreen', 'Heart', 'ArrowRefill5', 'MagicRefillSmall', 'BombRefill1', 'RupeeGreen', 'Heart'], 'name' => 'Prize Pack 6'],
	['items' => ['Heart', 'Fairy', 'MagicRefillFull', 'RupeeRed', 'BombRefill8', 'Heart', 'RupeeRed', 'ArrowRefill10'], 'name' => 'Prize Pack 7'],
	'pull' => ['items' => ['RupeeGreen', 'RupeeBlue', 'RupeeRed'], 'name' => 'Pull Prizes'],
	'crab' => ['items' => ['RupeeGreen', 'RupeeRed'], 'name' => 'Bush Crab Prizes'],
	'stun' => ['items' => ['RupeeGreen'], 'name' => 'Stun Prize'],
	'fish' => ['items' => ['RupeeRed'], 'name' => 'Fish Prize']
];
$alldrops = [
	'Random' => 'Random',
	'Heart' => 'Heart',
	'GreenRupee' => 'Green Rupee',
	'BlueRupee' => 'Blue Rupee',
	'RedRupee' => 'Red Rupee',
	'Bomb1' => '1x Bomb',
	'Bomb4' => '4x Bomb',
	'Bomb8' => '8x Bomb',
	'SmallMagic' => 'Small Magic Container',
	'LargeMagic' => 'Large Magic Container',
	'Arrow5' => '5x Arrow',
	'Arrow10' => '10x Arrow',
	'Faerie' => 'Faerie',
	'Bees' => 'Bees',
]; ?>
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
			@foreach ($prizepacks as $key => $item)
			<li id="n-prizepack-{{ $key }}"<?php if ($key == '0') echo ' class="active"' ?>>
				<a data-toggle="tab" data-section="{{ $item['name'] }}" href="#prizepack-{{ $key }}">
					{{ $item['name'] }}
				</a>
			</li>
			@endforeach
		</ul>
		<div class="tab-content">
			@foreach ($prizepacks as $key => $item)
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

	/*localforage.getItem('vt.custom.prizepacks').then(function(value) {
		if (value !== null) {
			for (pack in value) {
				for (item in value[pack].items) {
					var setting = $('#prize-pack-' + pack + "-" + item);
					setting.val(value[pack].items[item]);
					setting.trigger('change');
				}
			}
			prize_packs = value;
		}

		$('.custom-drop').on('change', function() {
			var $this = $(this);
			if (!$this.attr('id')) return;
			pack = $this.attr('id').split("-")[2];
			item = $this.attr('id').split("-")[3];
			prize_packs[pack].items[item] = $this.val();
			localforage.setItem('vt.custom.prizepacks', prize_packs);
		});
	});*/

});
</script>
@overwrite