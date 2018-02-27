@extends('layouts.default')
@include('_rom_info')
@include('_rom_loader')
@include('_rom_settings')

@section('content')
@yield('loader')
<h3>Randomizer Seed of the Day</h3>
<div class="well">
	<p>Can’t wait until the weekend for the next randomizer challenge? Want to see how you stack up
		against your favorite streamer? Introducing the Randomizer Seed of the Day!</p>
	<p>The game type will be random every day! (Would you expect anything else?)  Branch out and
		experience something new! Do you have the patience to persevere through a one-hit knockout
		seed, the cunning to solve the complexities of key-sanity, or the speed to pull the
		triforce from the pedestal? Find out today!</p>
</div>
<div id="seed-details" class="info panel panel-success" style="display:none">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Daily: {{ $daily->toFormattedDateString() }}</h3>
		<div class="btn-toolbar pull-right">
			@yield('rom-settings-button')
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<div class="row" style="padding-bottom:5px;">
			@yield('rom-info')
			<div class="col-md-6">
				<div class="row">
					<button name="save" class="btn btn-success" disabled>Save Rom</button>
				</div>
			</div>
		</div>
		@yield('rom-settings')
	</div>
</div>

<script>
var current_rom_hash = '{{ $md5 }}';
var vt_base_patch = {!! $patch !!};
var get_hash = "{{ $hash }}";

function applyHash(rom, hash, second_attempt) {
	if (rom.checkMD5() != current_rom_hash) {
		if (second_attempt) {
			$('#seed-generate, #seed-details').hide();
			$('.alert .message').html('Could not reset ROM.');
			$('.alert').show();
			$('#rom-select').show();
			return new Promise(function(resolve, reject) {
				reject(rom);
			});
		}
		return rom.parsePatch(patch).then(function(rom) {
				return applyHash(rom, hash, true);
			});
	}
	return new Promise(function(resolve, reject) {
		$.get('/hash/' + hash, function(patch) {
			rom.parsePatch(patch.patch).then(getSprite($('#sprite-gfx').val())
			.then(rom.parseSprGfx)
			.then(function(rom) {
				// the special music get's messed up by this function, so we just disable it
				if (patch.spoiler.meta.special) {
					$('.music-disable-toggle').hide();
					return rom;
				}
				$('.music-disable-toggle').show();
				return rom.setMusicVolume($('#generate-music-on').prop('checked'))
			})
			.then(rom.setHeartSpeed($('#heart-speed').val()))
			.then(rom.setMenuSpeed($('#menu-speed').val()))
			.then(rom.setSramTrace($('#generate-sram-trace').prop('checked')))
			.then(rom.setHeartColor($('#heart-color').val()))
			.then(function(rom) {
				resolve({rom: rom, patch: patch});
			}));
		}, 'json')
		.fail(reject);
	});
}

// Override regular romOk function
function romOk(rom) {
	applyHash(rom, get_hash).then(seedApplied, seedFailed);
}

function seedFailed(data) {
	$('.alert .message').html('Failed Creating Seed :(');
	$('.alert').show().delay(2000).fadeOut("slow");
}

function seedApplied(data) {
	return new Promise(function(resolve, reject) {
		parseInfoFromPatch(data.patch);
		rom.logic = data.patch.spoiler.meta.logic;
		rom.build = data.patch.spoiler.meta.build;
		rom.goal = data.patch.spoiler.meta.goal;
		rom.mode = data.patch.spoiler.meta.mode;
		rom.difficulty = data.patch.difficulty;
		rom.variation = data.patch.spoiler.meta.variation;
		rom.hash = data.patch.hash;
		rom.seed = data.patch.hash;
		rom.special = data.patch.spoiler.meta.special;
		$('button[name=save]').show().prop('disabled', false);
		resolve(rom);
	});
}

$(function() {
	$('.alert, .info').hide();
	$('button[name=save]').hide();

	$('button[name=save]').on('click', function() {
		return rom.save(rom.downloadFilename() + '.sfc')
	});
});
</script>
@overwrite
