@section('drops-pool')
<?php
$drops = [
	'Heart' => [
		'count' => 13,
		'name' => 'Heart',
	],
	'RupeeGreen' => [
		'count' => 9,
		'name' => 'Green Rupee',
	],
	'RupeeBlue' => [
		'count' => 7,
		'name' => 'Blue Rupee',
	],
	'RupeeRed' => [
		'count' => 6,
		'name' => 'Red Rupee',
	],
	'BombRefill1' => [
		'count' => 7,
		'name' => 'Bomb Refill (1)',
	],
	'BombRefill4' => [
		'count' => 1,
		'name' => 'Bomb Refill (4)',
	],
	'BombRefill8' => [
		'count' => 2,
		'name' => 'Bomb Refill (8)',
	],
	'MagicRefillSmall' => [
		'count' => 6,
		'name' => 'Small Magic Refill',
	],
	'MagicRefillFull' => [
		'count' => 3,
		'name' => 'Full Magic Refill',
	],
	'ArrowRefill5' => [
		'count' => 5,
		'name' => 'Arrow Refill (5)',
	],
	'ArrowRefill10' => [
		'count' => 3,
		'name' => 'Arrow Refill (10)',
	],
	'Fairy' => [
		'count' => 1,
		'name' => 'Fairy',
	],
	'BeeGood' => [
		'count' => 0,
		'name' => 'Good bee again?',
	],
];
?>
<div class="panel panel-success custom-drops-pool">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Drops Pool <span id="custom-drops-count">0</span> / <span id="custom-drops-count-total">0</span></h3>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Randomly Place</th>
					<th>Currently Placed</th>
					<th>Item Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($drops as $key => $item)
				<tr>
					<td class="col-md-3">
						<input id="item-drops-count-{{ $key }}" type="number" value="{{ $item['count'] }}"
							min="0" max="218" step="1" name="data[alttp.custom.drop.count.{{ $key }}]" class="input-sm custom-drops">
					</td>
					<td class="col-md-3">
						<input id="item-drops-placed-{{ $key }}" type="number" min="0" max="63" step="1" value="0" readonly
							tabindex="-1" class="custom-drops-placed input-sm">
					</td>
					<td class="col-md-6">
						<label for="item-drops-count-{{ $key }}">{{ $item['name'] }}</label>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script>
$(function() {
	localforage.getItem('vt.custom.drops.pool').then(function(value) {
		if (value !== null) {
			for (id in value) {
				if (!document.getElementById(id)) {
					continue;
				}
				document.getElementById(id).value = value[id];
			}
		}

		$('.custom-drops').on('change', function() {
			var drops = {};
			$('.custom-drops').each(function(){
				drops[this.id] = this.value;
			});
			localforage.setItem('vt.custom.drops.pool', drops);
		});
	});
});
</script>
@overwrite