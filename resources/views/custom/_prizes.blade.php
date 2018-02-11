@section('prizepacks')
<?php
$prizepacks = [
	['items' => ['Heart', 'Heart', 'Heart', 'Heart', 'Green Rupee', 'Heart', 'Heart', 'Green Rupee'], 'name' => 'Prize Pack 1'],
	['items' => ['Blue Rupee', 'Green Rupee', 'Blue Rupee', 'Red Rupee', 'Blue Rupee', 'Green Rupee', 'Blue Rupee', 'Blue Rupee'], 'name' => 'Prize Pack 2'],
	['items' => ['Large Magic Container', 'Small Magic Container', 'Small Magic Container', 'Blue Rupee', 'Large Magic Container', 'Small Magic Container', 'Heart', 'Small Magic Container'], 'name' => 'Prize Pack 3'],
	['items' => ['1x Bomb', '1x Bomb', '1x Bomb', '4x Bomb', '1x Bomb', '1x Bomb', '8x Bomb', '1x Bomb'], 'name' => 'Prize Pack 4'],
	['items' => ['5x Arrow', 'Heart', '5x Arrow', '10x Arrow', '5x Arrow', 'Heart', '5x Arrow', '10x Arrow'], 'name' => 'Prize Pack 5'],
	['items' => ['Small Magic Container', 'Green Rupee', 'Heart', '5x Arrow', 'Small Magic Container', '1x Bomb', 'Green Rupee', 'Heart'], 'name' => 'Prize Pack 6'],
	['items' => ['Heart', 'Faerie', 'Large Magic Container', 'Red Rupee', '8x Bomb', 'Heart', 'Red Rupee', '10x Arrow'], 'name' => 'Prize Pack 7'],
	'pull' => ['items' => ['Green Rupee', 'Blue Rupee', 'Red Rupee'], 'name' => 'Pull Prizes'],
	'crab' => ['items' => ['Green Rupee', 'Red Rupee'], 'name' => 'Bush Crab Prizes'],
	'stun' => ['items' => ['Green Rupee'], 'name' => 'Stun Prize'],
	'fish' => ['items' => ['Red Rupee'], 'name' => 'Fish Prize']
];
$allprizes = ['Heart', 'Green Rupee', 'Blue Rupee', 'Red Rupee', '1x Bomb', '4x Bomb', '8x Bomb', 'Small Magic Container', 'Large Magic Container', '5x Arrow', '10x Arrow', 'Faerie'] ?>
<div class="panel panel-success custom-prizes">
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
							<select id="prize-pack-{{ $key }}-{{ $innerkey }}" class="form-control selectpicker">
								@foreach ($allprizes as $prize)
								<option value="{{ $prize }}" <?php if ($inneritem == $prize) echo 'selected="selected"'; ?>>{{ $prize }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
			@endforeach
		</div>
	</div>
@overwrite