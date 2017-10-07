@extends('layouts.default')
@include('_rom_info')
@include('_rom_loader')
@include('_rom_settings')
@include('_rom_spoiler')

@section('content')
@yield('loader')
<div id="seed-generate" class="panel panel-info" style="display:none">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Generate Entrance Randomizer Game ({!! ALttP\EntranceRandomizer::VERSION !!})</h3>
		<div class="btn-toolbar pull-right">
			<a class="btn btn-default" href="/randomizer">Switch to Item Randomizer <span class="glyphicon glyphicon-expand"></span></a>
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
						<option value="open">Open</option>
						<option value="swordless">Swordless</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Logic</span>
					<select id="logic" class="form-control selectpicker">
						<option value="NoMajorGlitches">No Glitches</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Goal</span>
					<select id="goal" class="form-control selectpicker">
						<option value="ganon">Defeat Ganon</option>
						<option value="dungeons">All Dungeons</option>
						<option value="pedestal">Master Sword Pedestal</option>
						<option value="triforce-hunt">Triforce Pieces</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Difficulty</span>
					<select id="difficulty" class="form-control selectpicker">
						<option value="normal">Normal</option>
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
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Variation</span>
					<select id="variation" class="form-control selectpicker">
						<option value="none">None</option>
						<option value="timed-race">Timed Race</option>
						<option value="timed-ohko">Timed OHKO</option>
						<option value="triforce-hunt">Triforce Piece Hunt</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 pb-5">
				<div class="input-group" role="group">
					<span class="input-group-addon">Shuffle</span>
					<select id="shuffle" class="form-control selectpicker">
						<option value="simple">Simple</option>
						<option value="restricted">Restricted</option>
						<option value="full">Full</option>
						<option value="madness">Madness</option>
						<option value="insanity">Insanity</option>
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
	<input type="hidden" name="shuffle" value="full" />
	<input type="hidden" name="heart_speed" value="half" />
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
		$.post('/entrance/seed' + (seed ? '/' + seed : ''), getFormData($('form#config')), function(patch) {
			rom.parsePatch(patch.patch).then(getSprite($('#sprite-gfx').val())
			.then(rom.parseSprGfx)
			.then(rom.setMusicVolume($('#generate-music-on').prop('checked')))
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
	$('.alert .message').html('Failed Creating Seed :(');
	$('.alert').show().delay(2000).fadeOut("slow");
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
		rom.variation = data.patch.spoiler.meta.variation;
		rom.difficulty = data.patch.difficulty;
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
			$(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
		} else {
			$(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		}
	});
	$('#difficulty').on('change', function() {
		$('.info').hide();
		$('input[name=difficulty]').val($(this).val());
		localforage.setItem('vt.er.difficulty', $(this).val());
	});
	localforage.getItem('vt.er.difficulty').then(function(value) {
		if (!value) return;
		$('#difficulty').val(value);
		$('#difficulty').trigger('change');
	});

	$('#variation').on('change', function() {
		$('.info').hide();
		var variation = $(this).val();
		var goal = $('#goal').val();
		$('input[name=variation]').val(variation);
		localforage.setItem('vt.er.variation', variation);
		if (variation === 'triforce-hunt' && goal !== 'triforce-hunt') {
			$('#goal').val('triforce-hunt');
			$('#goal').trigger('change');
		} else if (variation !== 'triforce-hunt' && goal === 'triforce-hunt') {
			$('#goal').val('ganon');
			$('#goal').trigger('change');
		}
	});
	localforage.getItem('vt.er.variation').then(function(value) {
		if (!value) return;
		$('#variation').val(value);
		$('#variation').trigger('change');
	});

	$('#shuffle').on('change', function() {
		$('.info').hide();
		$('input[name=shuffle]').val($(this).val());
		localforage.setItem('vt.er.shuffle', $(this).val());
	});
	localforage.getItem('vt.er.shuffle').then(function(value) {
		if (!value) return;
		$('#shuffle').val(value);
		$('#shuffle').trigger('change');
	});

	$('button[name=save]').on('click', function() {
		return rom.save('ER_' + rom.logic
			+ '_' + rom.difficulty
			+ '-' + rom.mode
			+ '-' + rom.goal
			+ (rom.variation == 'none' ? '' : '_' + rom.variation)
			+ '_' + rom.seed + '.sfc');
	});
	$('button[name=save-spoiler]').on('click', function() {
		return FileSaver.saveAs(new Blob([$('.spoiler-text pre').html()]), 'ER_' + rom.logic
			+ '_' + rom.difficulty
			+ '-' + rom.mode
			+ '-' + rom.goal
			+ (rom.variation == 'none' ? '' : '_' + rom.variation)
			+ '_' + rom.seed + '.txt');
	});

	$('button[name=generate-save]').on('click', function() {
		applySeed(rom, $('#seed').val())
			.then(seedApplied, seedFailed)
			.then(function(rom) {
				return rom.save('ER_' + rom.logic
					+ '_' + rom.difficulty
					+ '-' + rom.mode
					+ '-' + rom.goal
					+ (rom.variation == 'none' ? '' : '_' + rom.variation)
					+ '_' + rom.seed + '.sfc');
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
		$('.info').hide();
		localforage.setItem('vt.er.logic', $(this).val());
		$('input[name=logic]').val($(this).val());
	});
	localforage.getItem('vt.er.logic').then(function(value) {
		if (value === null) return;
		$('#logic').val(value);
		$('#logic').trigger('change');
	});

	$('#mode').on('change', function() {
		$('.info').hide();
		localforage.setItem('vt.er.mode', $(this).val());
		$('input[name=mode]').val($(this).val());
	});
	localforage.getItem('vt.er.mode').then(function(value) {
		if (value === null) return;
		$('#mode').val(value);
		$('#mode').trigger('change');
	});

	$('#goal').on('change', function() {
		$('.info').hide();
		var goal = $(this).val();
		var variation = $('#variation').val();
		localforage.setItem('vt.er.goal', goal);
		$('input[name=goal]').val(goal);
		if (goal === 'triforce-hunt' && variation !== 'triforce-hunt') {
			$('#variation').val('triforce-hunt');
			$('#variation').trigger('change');
		} else if (goal !== 'triforce-hunt' && variation === 'triforce-hunt') {
			$('#variation').val('none');
			$('#variation').trigger('change');
		}
	});
	localforage.getItem('vt.er.goal').then(function(value) {
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
				FileSaver.saveAs(content, "VT-alttp-roms.zip");
				$('button[name=generate]').html('Generate').prop('disabled', false);
				$('button[name=generate-save]').prop('disabled', false);
			});
		});

	});

	function genToZip(zip, left) {
		return new Promise(function(resolve, reject) {
			applySeed(rom, $('#seed').val()).then(function(data) {
				var buffer = data.rom.getArrayBuffer().slice(0);
				var fname = 'ER_' + data.patch.logic
					+ '_' + data.patch.difficulty
					+ '-' + data.patch.spoiler.meta.mode
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
