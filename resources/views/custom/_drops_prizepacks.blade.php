@section('drops-prizepacks')
<?php
$prizepacks = [
	['items' => ['heart', 'heart', 'heart', 'heart', 'greenRupee', 'heart', 'heart', 'greenRupee'], 'name' => 'Prize Pack 1'],
	['items' => ['blueRupee', 'greenRupee', 'blueRupee', 'redRupee', 'blueRupee', 'greenRupee', 'blueRupee', 'blueRupee'], 'name' => 'Prize Pack 2'],
	['items' => ['largeMagic', 'smallMagic', 'smallMagic', 'blueRupee', 'largeMagic', 'smallMagic', 'heart', 'smallMagic'], 'name' => 'Prize Pack 3'],
	['items' => ['bomb1', 'bomb1', 'bomb1', 'bomb4', 'bomb1', 'bomb1', 'bomb8', 'bomb1'], 'name' => 'Prize Pack 4'],
	['items' => ['arrow5', 'heart', 'arrow5', 'arrow10', 'arrow5', 'heart', 'arrow5', 'arrow10'], 'name' => 'Prize Pack 5'],
	['items' => ['smallMagic', 'greenRupee', 'heart', 'arrow5', 'smallMagic', 'bomb1', 'greenRupee', 'heart'], 'name' => 'Prize Pack 6'],
	['items' => ['heart', 'faerie', 'largeMagic', 'redRupee', 'bomb8', 'heart', 'redRupee', 'arrow10'], 'name' => 'Prize Pack 7'],
	'pull' => ['items' => ['greenRupee', 'blueRupee', 'redRupee'], 'name' => 'Pull Prizes'],
	'crab' => ['items' => ['greenRupee', 'redRupee'], 'name' => 'Bush Crab Prizes'],
	'stun' => ['items' => ['greenRupee'], 'name' => 'Stun Prize'],
	'fish' => ['items' => ['redRupee'], 'name' => 'Fish Prize']
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