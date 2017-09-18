@section('rom-settings-button')
<button class="btn btn-default" data-toggle="collapse" href="#rom-settings">ROM <span class="glyphicon glyphicon-cog pulse"></span></button>
@overwrite

@section('rom-settings')
<div class="panel panel-info panel-collapse collapse" id="rom-settings">
	<div class="panel-heading">
		<h4 class="panel-title">ROM Settings</h4>
	</div>
	<div class="panel-body">
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Heart Beep</span>
				<select id="heart-speed" class="form-control selectpicker">
					<option value="off">Off</option>
					<option value="normal">Normal Speed</option>
					<option value="half" selected>Half Speed</option>
					<option value="quarter">Quarter Speed</option>
				</select>
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Play as</span>
				<select id="sprite-gfx" class="form-control selectpicker" data-live-search="true"
					data-style="sprite-icons" data-dropup-auto="false">
				@foreach(config('alttp.sprites') as $sprite => $sprite_name)
					<option data-icon="icon-custom-{{ str_replace(' ', '', $sprite_name) }}" value="{{ $sprite }}">{{ $sprite_name }}</option>
				@endforeach
					<option data-icon="icon-custom-Random" value="random">Random</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<input id="generate-sram-trace" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="generate-sram-trace">SRAM Trace</label>
		</div>
		<div class="col-md-6">
			<input id="generate-music-on" type="checkbox" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="generate-music-on">Background Music</label>
		</div>
		<div class="secrets" style="display:none">
			<div class="col-md-6">
				<input id="generate-debug" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
				<label for="generate-debug">Debug Mode</label>
			</div>
			<div class="col-md-6">
				<input id="generate-tournament" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
				<label for="generate-tournament">Tournament Mode</label>
			</div>
		</div>
	</div>
</div>

<script>
function getSprite(sprite_name) {
	return new Promise(function(resolve, reject) {
		if (sprite_name == 'random') {
			var options = $('#sprite-gfx option');
			sprite_name = options[Math.floor(Math.random() * (options.length - 1))].value;
		}
		localforage.getItem('vt_sprites.' + sprite_name).then(function(spr) {
			if (spr) {
				resolve(spr);
				return;
			}
			var oReq = new XMLHttpRequest();
			oReq.open("GET", "http://a4482918739889ddcb78-781cc7889ba8761758717cf14b1800b4.r32.cf2.rackcdn.com/" + sprite_name, true);
			oReq.responseType = "arraybuffer";

			oReq.onload = function(oEvent) {
				var spr_array = new Uint8Array(oReq.response);
				localforage.setItem('vt_sprites.' + sprite_name, spr_array).then(function(spr) {
					resolve(spr);
				});
			};

			oReq.send();
		});
	});
}

$(function() {
	$('#heart-speed').on('change', function() {
		if (rom) {
			rom.setHeartSpeed($(this).val());
		}
		localforage.setItem('rom.heart-speed', $(this).val());
		$('input[name=heart_speed]').val($(this).val());
	});
	localforage.getItem('rom.heart-speed').then(function(value) {
		if (value === null) return;
		$('#heart-speed').val(value);
		$('#heart-speed').trigger('change');
	});

	$('#sprite-gfx').on('change', function() {
		if (rom) {
			getSprite($(this).val())
				.then(rom.parseSprGfx)
		}
		localforage.setItem('rom.sprite-gfx', $(this).val());
	});
	localforage.getItem('rom.sprite-gfx').then(function(value) {
		if (value === null) return;
		$('#sprite-gfx').val(value);
		$('#sprite-gfx').trigger('change');
	});

	$('#generate-sram-trace').on('change', function() {
		if (rom) {
			rom.setSramTrace($(this).prop('checked'));
		}
		localforage.setItem('rom.sram-trace', $(this).prop('checked'));
		$('input[name=sram_trace]').val($(this).prop('checked'));
	});
	localforage.getItem('rom.sram-trace').then(function(value) {
		if (value === null) return;
		$('#generate-sram-trace').prop('checked', value);
		$('#generate-sram-trace').trigger('change');
	});

	$('#generate-music-on').on('change', function() {
		if (rom) {
			rom.setMusicVolume($(this).prop('checked'));
		}
		localforage.setItem('rom.music-on', $(this).prop('checked'));
	});
	localforage.getItem('rom.music-on').then(function(value) {
		if (value === null) return;
		$('#generate-music-on').prop('checked', value);
		$('#generate-music-on').trigger('change');
	});

	$('#generate-debug').on('change', function() {
		$('input[name=debug]').val($(this).prop('checked'));
	});
	$('#generate-tournament').on('change', function() {
		$('input[name=tournament]').val($(this).prop('checked'));
	});

	new secrets(function() {
		$('.secrets').show();
	});
});
</script>
@overwrite
