@extends('layouts.building')
@include('_rom_info')
@include('_rom_loader')
@include('_rom_settings')
@include('_rom_spoiler')
@include('custom/_equipment')
@include('custom/_items')
@include('custom/_switches')

@section('content')
@yield('loader')
<form id="customizer">
	<input type="hidden" name="logic" value="NoMajorGlitches" />
	<input type="hidden" name="difficulty" value="custom" />
	<input type="hidden" name="variation" value="none" />
	<input type="hidden" name="mode" value="standard" />
	<input type="hidden" name="goal" value="ganon" />
	<input type="hidden" name="heart_speed" value="half" />
	<input type="hidden" name="sram_trace" value="false" />
	<input type="hidden" name="menu_speed" value="normal" />
	<input type="hidden" name="debug" value="false" />
	<div class="panel panel-warning">
		<div class="panel-heading panel-heading-btn">
			<div class="btn-toolbar pull-right" role="group">
				<button name="reset" class="btn btn-danger">Reset Everything</button>
			</div>
			<h3 class="panel-title pull-right pd-4">I've done messed up! &nbsp; </h3>
			<div class="btn-toolbar pull-left" role="group">
				<label class="btn btn-primary btn-file">
					Load saved settings <input type="file" accept=".json" name="customizer-restore" style="display: none;">
				</label>
				<button name="save-customizer" class="btn btn-primary">Save settings</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="tab-content">
		<div class="tab-pane active">
			<h1>Welcome to Customizer</h1>
			<p>Here is where you can create the game you always wanted (or never wanted). If you are just looking to
				make a randomized game and get playing, I suggest the "Item Randomizer" on the left.</p>
			<p>To use this, you'll set the Item Pool, place items anywhere you like, and adjust the core settings of
				Randomizer.</p>
			<p>Be aware! You can generate incompletable games using this. If that is your choice please don't report
				item locks generated using this tool.</p>
			<p>Here are the keys to the kingdom, enjoy!</p>
		</div>
		<div class="tab-pane" id="custom-generate">
			<div id="seed-generate" class="panel panel-success" style="display:none">
				<div class="panel-heading panel-heading-btn">
					<h3 class="panel-title pull-left">Customizer: Just because you can, doesn't mean you should</h3>
					<div class="btn-toolbar pull-right">
						@yield('rom-settings-button')
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6 pb-5">
							<div class="input-group" role="group">
								<span class="input-group-addon">Mode</span>
								<select id="mode" class="form-control selectpicker">
									@foreach (config('alttp.randomizer.item.modes') as $mode => $name)
										<option value="{{ $mode }}">{{ $name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6 pb-5">
							<div class="input-group" role="group">
								<span class="input-group-addon">Goal</span>
								<select id="goal" class="form-control selectpicker">
									@foreach (config('alttp.randomizer.item.goals') as $goal => $name)
										<option value="{{ $goal }}">{{ $name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 pb-5">
							<div class="input-group" role="group">
								<span class="input-group-addon">Name</span>
								<input type="text" id="name" name="name" class="name form-control" placeholder="name this">
							</div>
						</div>
						<div class="col-md-6 pb-5">
							<div class="input-group" role="group">
								<span class="input-group-addon">Logic</span>
								<select id="logic" class="form-control selectpicker">
									@foreach (config('alttp.randomizer.item.logics') as $logic => $name)
										<option value="{{ $logic }}">{{ $name }}</option>
									@endforeach
									<option value="None">None (I know what I'm doing)</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 pb-5">
							<div class="input-group" role="group">
								<span class="input-group-addon">RNG Seed</span>
								<input type="text" id="seed" class="seed form-control" maxlength="9" placeholder="random">
								<span class="input-group-btn">
									<button id="seed-clear" class="btn btn-default" type="button">
										<span class="glyphicon glyphicon-remove"></span>
									</button>
								</span>
							</div>
						</div>
						<div class="col-md-6 pb-5">
							<div class="input-group" role="group">
								<span class="input-group-addon">Rom "Fixes"</span>
								<select id="rom-logic" class="form-control selectpicker" name="data[alttp.custom.rom.logicMode]">
									@foreach (config('alttp.randomizer.item.logics') as $logic => $name)
										<option value="{{ $logic }}">{{ $name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					@yield('rom-settings')
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group btn-flex" role="group">
								<button name="generate" class="btn btn-success">Generate ROM</button>
							</div>
						</div>
						<div class="col-md-6">
							<div class="btn-group btn-flex" role="group">
								<button name="test" class="btn btn-primary">Test Generate</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="seed-details" class="info panel panel-info">
				<div class="panel-heading"><h3 class="panel-title">Game Details</h3></div>
				<div class="panel-body">
					@yield('rom-info')
					<div class="col-md-6">
						<div class="row">
							<button name="save-spoiler" class="btn btn-default" disabled>Save Spoiler</button>
							<button name="save" class="btn btn-success" disabled>Save Rom</button>
						</div>
					</div>
					@yield('rom-spoiler')
				</div>
			</div>
		</div>
		<div class="tab-pane" id="custom-equipment">
			@yield('equipment')
		</div>
		<div class="tab-pane" id="custom-item-select">
			@yield('itemselect')
		</div>
		<div class="tab-pane" id="custom-settings">
			@yield('switches')
		</div>
	@foreach($world->getRegions() as $name => $region)
		<div class="tab-pane" id="custom-region-{{ str_replace(' ', '_', $name) }}">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 class="panel-title">{{ $name }}</h4>
				</div>
				<table class="table table-striped">
				@foreach($region->getLocations() as $location)
					<?php if ($location instanceof ALttP\Location\Prize\Event || $location instanceof ALttP\Location\Trade) continue; ?>
					<tr>
						<td class="col-md-7">{{ $location->getName() }}</td>
						<td class="col-md-5">
							<select class="item-location {{ $location_class[get_class($location)] ?? 'items' }}"
								name="l[{{ base64_encode($location->getName()) }}]"></select>
						</td>
					</tr>
				@endforeach
				</table>
			</div>
		</div>
	@endforeach
	</div>
</form>

<script>
var test = false;
function getFormData($form){
	var unindexed_array = $form.serializeArray();
	var indexed_array = {};

	$.map(unindexed_array, function(n, i){
		if (n['value'] == 'auto_fill') return;
		indexed_array[n['name']] = n['value'];
	});

	return indexed_array;
}
function seedApplied(data) {
	return new Promise(function(resolve, reject) {
		$('button[name=generate]').html('Generate ROM').prop('disabled', false);
		$('button[name=test]').html('Test Generate').prop('disabled', false);
		parseInfoFromPatch(data.patch);
		pasrseSpoilerToTabs(data.patch.spoiler);
		rom.logic = data.patch.logic;
		rom.goal = data.patch.spoiler.meta.goal;
		rom.build = data.patch.spoiler.meta.build;
		rom.mode = data.patch.spoiler.meta.mode;
		rom.difficulty = data.patch.difficulty;
		rom.variation = data.patch.spoiler.meta.variation;
		rom.seed = data.patch.seed;
		rom.spoiler = data.patch.spoiler;
		$('button[name=save-spoiler]').show().prop('disabled', false);
		if (!test) {
			$('button[name=save]').show().prop('disabled', false);
		} else {
			$('button[name=save]').hide();
		}
		resolve(rom);
	});
}
function seedFailed(data) {
	return new Promise(function(resolve, reject) {
		$('.alert .message').html('Unable to generate, please check your options.<br />' + data.responseText);
		$('.alert').show();
		$('button[name=generate]').html('Generate ROM').prop('disabled', false);
		$('button[name=test]').html('Test Generate').prop('disabled', false);
		return resolve('no');
	});
}
function applySeed(rom, seed, second_attempt) {
	if (rom.checkMD5() != current_rom_hash) {
		if (second_attempt) {
			$('#seed-generate, #seed-details, #config').hide();
			$('.alert .message').html('Could not reset ROM.');
			$('.alert').show();
			$('#rom-select').show();
			return new Promise(function(resolve, reject) {
				reject(rom);
			});
		}
		return resetRom()
			.then(function(rom) {
				return applySeed(rom, seed, true);
			});
	}
	return new Promise(function(resolve, reject) {
		var formData = getFormData($('form'));
		var starting_equipment = [];
		localforage.getItem('vt.custom.equipment').then(function(equipment) {
			for (eq in equipment) {
				if (typeof equipment[eq] === 'boolean' && equipment[eq]) {
					starting_equipment.push(eq);
				} else if (eq == 'ProgressiveBow') {
					if (equipment[eq] == 0) {
						continue;
					}
					starting_equipment.push([
						'nothing',
						'SilverArrowUpgrade',
						'Bow',
						'BowAndSilverArrows',
					][equipment[eq]]);
				} else if (eq == 'Boomerang') {
					switch (equipment[eq]) {
						case 3: starting_equipment.push('RedBoomerang');
						case 1: starting_equipment.push('Boomerang'); break;
						case 2: starting_equipment.push('RedBoomerang'); break;
					}
				} else if (eq.match(/^Bottle/)) {
					switch (equipment[eq]) {
						case 1: starting_equipment.push('Bottle'); break;
						case 2: starting_equipment.push('BottleWithRedPotion'); break;
						case 3: starting_equipment.push('BottleWithBluePotion'); break;
						case 4: starting_equipment.push('BottleWithGreenPotion'); break;
						case 5: starting_equipment.push('BottleWithBee'); break;
						case 6: starting_equipment.push('BottleWithGoldBee'); break;
						case 7: starting_equipment.push('BottleWithFairy'); break;
					}
				} else {
					for (var i = 0; i < equipment[eq]; ++i) {
						starting_equipment.push(eq);
					}
				}
			}
			formData.eq = starting_equipment;
			if (test) {
				$.post('/test' + (seed ? '/' + seed : ''), formData, function(patch) {
					$('.info').show();
					$('button[name=save-spoiler]').prop('disabled', false);
					resolve({rom: rom, patch: patch});
				}).fail(reject);
			} else {
				$.post('/seed' + (seed ? '/' + seed : ''), formData, function(patch) {
					rom.parsePatch(patch.patch).then(getSprite($('#sprite-gfx').val())
					.then(rom.parseSprGfx)
					.then(rom.setMusicVolume($('#generate-music-on').prop('checked')))
					.then(rom.setHeartSpeed($('#heart-speed').val()))
					.then(rom.setMenuSpeed($('#menu-speed').val()))
					.then(rom.setSramTrace($('#generate-sram-trace').prop('checked')))
					.then(function(rom) {
						$('.info').show();
						$('button[name=save], button[name=save-spoiler]').prop('disabled', false);
						resolve({rom: rom, patch: patch});
					}));
				}, 'json')
				.fail(reject);
			}
		});
	});
}

$(function() {
	var config = {};
	$('.items').append($('#items').html());
	$('.prizes').append($('#prizes').html());
	$('.bottles').append($('#bottles').html());
	$('.medallions').append($('#medallions').html());

	$('form').on('submit', function() {
		return false;
	});

	localforage.getItem('vt.customizer').then(function(customizer) {
		config = customizer || {};
		for (var name in config) {
			if (!config.hasOwnProperty(name)) continue;
			$('select[name="' + name + '"]').data('previous-item', config[name]);
			$('select[name="' + name + '"]').val(config[name]);
		}
		// don't show the menu until we have finished loading things
		$('.regions').removeClass('hidden');
	});

	$('select.item-location').change(function() {
		config[this.name] = $(this).val();
		localforage.setItem('vt.customizer', config);
	});

	$('.item-location.items').change(function() {
		var $this = $(this);
		var value = $this.find('option:selected').hasClass('item-bottle') ? 'Bottles' : $this.val();
		var previous = $this.data('previous-item');
		if (previous) {
			$('#item-count-' + previous).val(Number($('#item-count-' + previous).val()) + 1);
			$('#item-count-' + previous).trigger('change');
		}
		$this.data('previous-item', value);
		if (Number($('#item-count-' + value).val()) > 0) {
			$('#item-count-' + value).val(Number($('#item-count-' + value).val()) - 1);
			$('#item-count-' + value).trigger('change');
		}
	});

	var save_restore_settings = [
		'vt.customizer',
		'vt.customizer.profiles',
		'vt.customizer.lastTab',
		'vt.custom.items',
		'vt.custom.equipment',
		'vt.custom.switches',
		'vt.custom.settings',
		'vt.custom.name',
		'vt.custom.logic',
		'vt.custom.mode',
		'vt.custom.goal',
		'vt.custom.seed',
	];
	// dirty cleanup function for now
	$('button[name=reset]').on('click', function(e) {
		e.preventDefault();
		var promises = [];
		for (var i = 0; i < save_restore_settings.length; ++i) {
			promises.push(localforage.removeItem(save_restore_settings[i]));
		}
		Promise.all(promises).then(function(values) {
			window.location = window.location;
		});
	});

	// Dirty Save to match dirty cleanup
	$('button[name=save-customizer]').on('click', function(e) {
		e.preventDefault();
		var promises = [];
		for (var i = 0; i < save_restore_settings.length; ++i) {
			promises.push(localforage.getItem(save_restore_settings[i]));
		}
		Promise.all(promises).then(function(values) {
			var save = {};
			for (var i = 0; i < save_restore_settings.length; ++i) {
				save[save_restore_settings[i]] = values[i];
			}
			return FileSaver.saveAs(new Blob([JSON.stringify(save)]), (values[7]) ? values[7] + '-settings.json' : 'customizer-settings.json');
		});
	});

	// Dirty restore to match dirty save to match dirty cleanup
	$('input[name=customizer-restore]').on('change', function() {
		var file = this.files[0];
		if (file.type !== "application/json") {
			return;
		}

		var fileReader = new FileReader();

		fileReader.onload = function(e) {
			var settings = JSON.parse(fileReader.result);
			var promises = [];
			for (var i = 0; i < save_restore_settings.length; ++i) {
				promises.push(localforage.setItem(save_restore_settings[i], settings[save_restore_settings[i]] || null));
			}
			Promise.all(promises).then(function(values) {
				window.location = window.location;
			});
		}

		fileReader.readAsText(file);
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var target = $(e.target).attr("href") // activated tab
		localforage.setItem('vt.customizer.lastTab', target);
		if (!$(target).data('init')) {
			// this is 3x faster than bs-select, consider switching everything to it if it looks right
			$(target + " select.item-location").select2({
				theme: "bootstrap",
				width: "100%"
			});
			$(target).data('init', true);
		}
		if (target == '#custom-item-select') {
			$('#custom-count-total').html($('.items option[value="auto_fill"]:selected').length);
			$('.custom-placed').val(0);
			$('.items option[value!="auto_fill"]:selected').each(function() {
				$('#item-placed-' + this.value).val(Number($('#item-placed-' + this.value).val()) + 1);
			});
			// bottles
			$('#item-placed-Bottles').val($('option.item-bottle:selected').length)
			$('.custom-items').first().trigger('change');
		}
	});

	$('.custom-items').on('change click blur', function(e) {
		e.stopPropagation();
		$('#custom-count').html($('.custom-items').map(function(){return Number(this.value)}).toArray().reduce(function(a,b){return a+b}));
		if ($('#custom-count').html() != $('#custom-count-total').html()) {
			$('.custom-item-pool').removeClass('panel-success').addClass('panel-danger');
		} else {
			$('.custom-item-pool').removeClass('panel-danger').addClass('panel-success');
		}
	});
	$('.custom-items').first().trigger('change');

	$('button[name=generate]').on('click', function() {
		test = false;
		$('button[name=generate]').html('Generating...').prop('disabled', true);
		$('.alert').hide();
		applySeed(rom, $('#seed').val()).then(seedApplied, seedFailed);
	});

	$('button[name=test]').on('click', function() {
		test = true;
		$('button[name=test]').html('Testing...').prop('disabled', true);
		$('.alert').hide();
		applySeed(rom, $('#seed').val()).then(seedApplied, seedFailed);
	});

	$('#name').on('change', function() {
		localforage.setItem('vt.custom.name', $(this).val());
	});
	localforage.getItem('vt.custom.name').then(function(value) {
		if (value === null) return;
		$('#name').val(value);
		$('#name').trigger('change');
	});

	$('#logic').on('change', function() {
		var $this = $(this);
		localforage.setItem('vt.custom.logic', $this.val());
		if ($this.val() != 'None') {
			$('#rom-logic').val($this.val());
			$('#rom-logic').trigger('change');
		}
		$('input[name=logic]').val($this.val());
	});
	localforage.getItem('vt.custom.logic').then(function(value) {
		if (value === null) return;
		$('#logic').val(value);
		$('#logic').trigger('change');
	});

	$('#rom-logic').on('change', function() {
		localforage.setItem('vt.custom.rom-logic', $(this).val());
	});
	localforage.getItem('vt.custom.rom-logic').then(function(value) {
		if (value === null) return;
		$('#rom-logic').val(value);
		$('#rom-logic').trigger('change');
	});

	$('#mode').on('change', function() {
		$('.info').hide();
		localforage.setItem('vt.custom.mode', $(this).val());
		$('input[name=mode]').val($(this).val());
	});
	localforage.getItem('vt.custom.mode').then(function(value) {
		if (value === null) return;
		$('#mode').val(value);
		$('#mode').trigger('change');
	});

	$('#goal').on('change', function() {
		$('.info').hide();
		var goal = $(this).val();
		localforage.setItem('vt.custom.goal', goal);
		$('input[name=goal]').val(goal);
	});
	localforage.getItem('vt.custom.goal').then(function(value) {
		if (value === null) return;
		$('#goal').val(value);
		$('#goal').trigger('change');
	});

	$('#seed-clear').on('click', function() {
		$('#seed').val('');
	});

	$('#seed').on('change', function() {
		localforage.setItem('vt.custom.seed', $(this).val());
	});
	localforage.getItem('vt.custom.seed').then(function(value) {
		if (value === null) return;
		$('#seed').val(value);
		$('#seed').trigger('change');
	});

	$('button[name=save]').on('click', function() {
		return rom.save('ALttP - VT_' + rom.logic
			+ '_' + rom.difficulty
			+ '-' + rom.mode
			+ '-' + rom.goal
			+ (rom.variation == 'none' ? '' : '_' + rom.variation)
			+ '_' + rom.seed + '.sfc');
	});
	$('button[name=save-spoiler]').on('click', function() {
		$.get("/spoiler_click/" + rom.seed);
		return FileSaver.saveAs(new Blob([$('.spoiler-text pre').html()]), 'ALttP - VT_' + rom.logic
			+ '_' + rom.difficulty
			+ '-' + rom.mode
			+ '-' + rom.goal
			+ (rom.variation == 'none' ? '' : '_' + rom.variation)
			+ '_' + rom.seed + '.txt');
	});

	localforage.getItem('vt.customizer.lastTab').then(function(href) {
		if (href === null) return;
		$('a[href="' + href + '"]').tab('show');
	});
});
</script>
<script id="medallions" type="text/template">
	<option value="auto_fill">Random</option>
	@foreach($medallions as $item)
	<option class="placable placable-medallion" value="{{ $item->getName() }}">{{ $item->getNiceName() }}</option>
	@endforeach
</script>
<script id="bottles" type="text/template">
	<option value="auto_fill">Random</option>
	@foreach($bottles as $item)
	<option class="placable placable-bottle" value="{{ $item->getName() }}">{{ $item->getNiceName() }}</option>
	@endforeach
</script>
<script id="prizes" type="text/template">
	<option value="auto_fill">Random</option>
	@foreach($prizes as $item)
	<option class="placable placable-prize" value="{{ $item->getName() }}">{{ $item->getNiceName() }}</option>
	@endforeach
</script>
<script id="items" type="text/template">
	<option value="auto_fill">Random</option>
	@foreach($items as $item)
	<option class="placable placable-item{{ $item instanceof ALttP\Item\Bottle ? ' item-bottle' : '' }}"
		value="{{ $item->getName() }}">{{ $item->getNiceName() }}</option>
	@endforeach
</script>
@overwrite
