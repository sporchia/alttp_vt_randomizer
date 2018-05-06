@extends('layouts.default')
@include('_rom_info')
@include('_rom_loader')
@include('_rom_settings')
@include('_rom_spoiler')

@section('content')
@yield('loader')
<div id="seed-generate" class="panel panel-success" style="display:none">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Super Metroid and A Link to the Past Item Randomizer (v{!! ALttP\Randomizer::LOGIC !!})</h3>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		@yield('rom-settings')
		<div class="row">
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">State</span>
					<select id="mode" class="form-control selectpicker">
						@foreach (config('alttp.randomizer.item.modes') as $mode => $name)
							<option value="{{ $mode }}">{{ $name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Logic</span>
					<select id="logic" class="form-control selectpicker">
						@foreach (config('alttp.randomizer.item.logics') as $logic => $name)
							<option value="{{ $logic }}">{{ $name }}</option>
						@endforeach
					</select>
				</div>
				<div class="logic-warning text-danger text-right">This Logic requires knowledge of Major Glitches<sup>**</sup></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Swords</span>
					<select id="weapons" class="form-control selectpicker">
						@foreach (config('alttp.randomizer.item.weapons') as $mode => $name)
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
					<span class="input-group-addon">Difficulty</span>
					<select id="difficulty" class="form-control selectpicker">
						@foreach (config('alttp.randomizer.item.difficulties') as $difficulty => $name)
							<option value="{{ $difficulty }}">{{ $name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Variation</span>
					<select id="variation" class="form-control selectpicker">
						@foreach (config('alttp.randomizer.item.variations') as $variation => $name)
							<option value="{{ $variation }}">{{ $name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Seed</span>
					<input type="text" id="seed" class="seed form-control" maxlength="9" placeholder="random">
					<span class="input-group-btn">
						<button id="seed-clear" class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove"></span></button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-md-6">
				<div class="btn-group btn-flex" role="group">
					<button class="btn btn-info" name="generate-tournament-rom">Generate Race ROM (no spoilers)</button>
				</div>
			</div>
			<div class="col-md-6">
				<div class="btn-group btn-flex" role="group">
					<button name="generate" class="btn btn-success" disabled>Generate ROM</button>
					<button name="generate-save" class="btn btn-success" disabled><span class="glyphicon glyphicon-save"></span></button>
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul id="generate-multi" class="dropdown-menu dropdown-menu-right">
						@for ($i = 1; $i <= 10; $i++)
						<li><a data-value="{{ $i }}">Generate {{ $i }} seeds</a></li>
						@endfor
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="seed-details" class="info panel panel-info" style="display:none">
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
<form id="config" style="display:none">
	<input type="hidden" name="logic" value="NoMajorGlitches" />
	<input type="hidden" name="difficulty" value="normal" />
	<input type="hidden" name="variation" value="none" />
	<input type="hidden" name="mode" value="open" />
	<input type="hidden" name="goal" value="ganon" />
	<input type="hidden" name="weapons" value="randomized" />
	<input type="hidden" name="heart_speed" value="half" />
	<input type="hidden" name="sram_trace" value="false" />
	<input type="hidden" name="menu_speed" value="normal" />
	<input type="hidden" name="debug" value="false" />
	<input type="hidden" name="tournament" value="false" />
</form>

<script>
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
		$.post('/seed' + (seed ? '/' + seed : ''), getFormData($('form#config')), function(patch) {
			if (patch.current_rom_hash && patch.current_rom_hash != current_rom_hash) {
				// The base rom has been updated, refresh browser!
				window.location.reload(true);
			}
			rom.parsePatch(patch.patch).then(getSprite($('#sprite-gfx').val())
			.then(rom.parseSprGfx)
			.then(rom.setMusicVolume($('#generate-music-on').prop('checked')))
			.then(rom.setHeartSpeed($('#heart-speed').val()))
			.then(rom.setMenuSpeed($('#menu-speed').val()))
			.then(rom.setSramTrace($('#generate-sram-trace').prop('checked')))
			.then(rom.setHeartColor($('#heart-color').val()))
			.then(rom.setQuickswap($('#generate-quickswap').prop('checked')))
			.then(function(rom) {
				resolve({rom: rom, patch: patch});
			}));
		}, 'json')
		.fail(reject);
	});
}

function getFormData($form){
	var unindexed_array = $form.serializeArray();
	var indexed_array = {};

	$.map(unindexed_array, function(n, i){
		indexed_array[n['name']] = n['value'];
	});

	return indexed_array;
}

function seedFailed(data) {
	$('button[name=generate]').html('Generate ROM').prop('disabled', false);
	$('button[name=generate-save]').prop('disabled', false);
	switch (data.status) {
		case 429:
			$('.alert .message').html('While we apprecate your want to generate a lot of games, Other people would like'
				+ ' to as well. Please come back later if you would like to generate more.');
			break;
		default:
			$('.alert .message').html('Failed Creating Seed :(');
	}
	$('.alert').show().delay(5000).fadeOut("slow");
}

function seedApplied(data) {
	return new Promise(function(resolve, reject) {
		$('button[name=generate-tournament-rom]').html('Generate Race ROM (no spoilers)').prop('disabled', false);
		$('button[name=generate]').html('Generate').prop('disabled', false);
		$('button[name=generate-save]').prop('disabled', false);
		parseInfoFromPatch(data.patch);
		pasrseSpoilerToTabs(data.patch.spoiler);
		rom.logic = data.patch.logic;
		rom.goal = data.patch.spoiler.meta.goal;
		rom.build = data.patch.spoiler.meta.build;
		rom.mode = data.patch.spoiler.meta.mode;
		rom.weapons = data.patch.spoiler.meta.weapons;
		rom.difficulty = data.patch.difficulty;
		rom.variation = data.patch.spoiler.meta.variation;
		rom.seed = data.patch.seed;
		rom.spoiler = data.patch.spoiler;
		$('button[name=save], button[name=save-spoiler]').show().prop('disabled', false);
		resolve(rom);
	});
}

$(function() {
	$('button[name=save], button[name=save-spoiler]').hide();
	$('.spoiler').hide();
	$('.spoiler-tabed').hide();
	$('.spoiler-toggle').on('click', function() {
		$(this).next().animate({height: 'toggle'});
		if ($(this).find('span').hasClass('glyphicon-plus')) {
			$.get("/spoiler_click/" + rom.seed);
			$(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
		} else {
			$(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		}
	});
	$('#difficulty').on('change', function() {
		$('.info').hide();
		$('input[name=difficulty]').val($(this).val());
		localforage.setItem('rom.difficulty', $(this).val());
	});
	localforage.getItem('rom.difficulty').then(function(value) {
		if (!value) {
			value = 'normal';
		}
		$('#difficulty').val(value);
		$('#difficulty').trigger('change');
	});

	$('#variation').on('change', function() {
		$('.info').hide();
		var variation = $(this).val();
		var goal = $('#goal').val();
		$('input[name=variation]').val(variation);
		localforage.setItem('rom.variation', variation);
	});
	localforage.getItem('rom.variation').then(function(value) {
		if (!value) return;
		$('#variation').val(value);
		$('#variation').trigger('change');
	});

	$('button[name=save]').on('click', function() {
		return rom.save(rom.downloadFilename()+ '.sfc');
	});
	$('button[name=save-spoiler]').on('click', function() {
		$.get("/spoiler_click/" + rom.seed);
		return FileSaver.saveAs(new Blob([$('.spoiler-text pre').html()]), rom.downloadFilename() + '.txt');
	});

	$('button[name=generate-save]').on('click', function() {
		applySeed(rom, $('#seed').val())
			.then(seedApplied, seedFailed)
			.then(function(rom) {
				return rom.save(rom.downloadFilename()+ '.sfc');
			});
	});

	$('button[name=generate]').on('click', function() {
		$('input[name=tournament]').val($('#generate-tournament').prop('checked'));
		$('button[name=generate]').html('Generating...').prop('disabled', true);
		$('button[name=generate-save], button[name=save], button[name=save-spoiler]').prop('disabled', true);
		applySeed(rom, $('#seed').val()).then(seedApplied, seedFailed);
	});

	$('button[name=generate-tournament-rom]').on('click', function() {
		$('input[name=tournament]').val(true);
		$('button[name=generate-tournament-rom]').html('Generating...').prop('disabled', true);
		$('button[name=generate]').html('Generating...').prop('disabled', true);
		$('button[name=generate-save], button[name=save], button[name=save-spoiler]').prop('disabled', true);
		applySeed(rom, $('#seed').val()).then(seedApplied, seedFailed);
	});

	$('#logic').on('change', function() {
		var value = $(this).val();
		$('.info').hide();
		if (value == 'NoMajorGlitches') {
			$('.logic-warning').hide();
		} else {
			$('.logic-warning').show();
		}
		localforage.setItem('rom.logic', value);
		$('input[name=logic]').val(value);
	});

	localforage.getItem('rom.logic').then(function(value) {
		if (value !== null) {
			$('#logic').val(value);
		}
		$('#logic').trigger('change');
	});

	$('#mode').on('change', function() {
		$('.info').hide();
		localforage.setItem('rom.mode', $(this).val());
		$('input[name=mode]').val($(this).val());
	});
	localforage.getItem('rom.mode').then(function(value) {
		if (value === null) return;
		$('#mode').val(value);
		$('#mode').trigger('change');
	});

	$('#weapons').on('change', function() {
		$('.info').hide();
		localforage.setItem('rom.weapons', $(this).val());
		$('input[name=weapons]').val($(this).val());
	});
	localforage.getItem('rom.weapons').then(function(value) {
		if (!value) {
			value = 'uncle';
		}
		$('#weapons').val(value);
		$('#weapons').trigger('change');
	});

	$('#goal').on('change', function() {
		$('.info').hide();
		var goal = $(this).val();
		var variation = $('#variation').val();
		localforage.setItem('rom.goal', goal);
		$('input[name=goal]').val(goal);
	});
	localforage.getItem('rom.goal').then(function(value) {
		if (value === null) return;
		$('#goal').val(value);
		$('#goal').trigger('change');
	});

	$('#seed-clear').on('click', function() {
		$('#seed').val('');
	});

	$('#generate-multi a').on('click', function() {
		var itters = $(this).data('value');
		var zip = new jszip();
		$('button[name=generate]').html('Generating...').prop('disabled', true);
		$('button[name=generate-save], button[name=save], button[name=save-spoiler]').prop('disabled', true);

		genToZip(zip, itters).then(function(zip) {
			zip.generateAsync({type: "blob", compression: "DEFLATE"})
			.then(function(content) {
				FileSaver.saveAs(content, "sm-alttp-roms.zip");
				$('button[name=generate]').html('Generate').prop('disabled', false);
				$('button[name=generate-save]').prop('disabled', false);
			});
		});

	});

	function genToZip(zip, left) {
		return new Promise(function(resolve, reject) {
			applySeed(rom, $('#seed').val()).then(function(data) {
				var buffer = data.rom.getArrayBuffer().slice(0);
				var fname = 'SMALttP - v' + data.patch.logic
					+ '_' + data.patch.difficulty
					+ '-' + data.patch.spoiler.meta.mode
					+ (data.patch.spoiler.meta.weapons ? '-' + data.patch.spoiler.meta.weapons : '')
					+ '-' + data.patch.spoiler.meta.goal
					+ (data.patch.spoiler.meta.variation == 'none' ? '' : '_' + data.patch.spoiler.meta.variation)
					+ '_' + data.patch.seed;
				zip.file(fname + '.sfc', buffer);
				zip.file('spoilers/' + fname + '.txt', new Blob([JSON.stringify(data.patch.spoiler, null, 4)]));
				if (left - 1 > 0) {
					genToZip(zip, left - 1).then(function() {
						resolve(zip);
					});
				} else {
					resolve(zip);
				}
			});
		});
	}
});
</script>
@overwrite
