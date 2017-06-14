@extends('layouts.default')

@section('content')
<div class="alert alert-danger" role="alert" style="display:none">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <span class="message">Cannot Read ROM file.</span>
</div>
<div id="rom-select" class="panel panel-info" style="display:none">
	<div class="panel-heading">
		<h4 class="panel-title">Getting Started</h4>
	</div>
	<div class="panel-body">
		<p>
			<label class="btn btn-default btn-file">
				Select ROM File <input type="file" accept=".sfc" name="f2u" style="display: none;">
			</label>
		</p>
		<p>Please use a Zelda no Densetsu: Kamigami no Triforce v1.0 ROM</p>
	</div>
</div>
<div id="seed-details" class="info panel panel-info" style="display:none">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Seed Details: <span class="seed"></span></h3>
		<button class="btn btn-default pull-right" data-toggle="collapse" href="#rom-settings">ROM <span class="glyphicon glyphicon-cog"></span></button>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<div class="row" style="padding-bottom:5px;">
		<div class="col-md-6">
			<div>Logic: <span class="logic"></span></div>
			<div>ROM build: <span class="build"></span></div>
			<div>Difficulty: <span class="difficulty"></span></div>
			<div>Mode: <span class="mode"></span></div>
			<div>Goal: <span class="goal"></span></div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<button name="save" class="btn btn-success" disabled>Save Rom</button>
			</div>
		</div>
	</div>
		<div class="panel panel-success panel-collapse collapse" id="rom-settings">
			<div class="panel-heading">
				<h4 class="panel-title">ROM Settings</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<div class="row">
						<input id="generate-sram-trace" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
						<label for"generate-sram-trace">SRAM Trace</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
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
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="input-group" role="group">
							<span class="input-group-addon">Play as</span>
							<select id="sprite-gfx" class="form-control selectpicker">
@foreach (config('alttp.sprites') as $sprite => $sprite_name)
								<option value="{{ $sprite }}">{{ $sprite_name }}</option>
@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var rom;
var current_rom_hash = '{{ $md5 }}';
var patch = {!! $patch !!};
var get_hash = "{{ $hash }}";
var ROM = ROM || (function(blob, loaded_callback) {
	var u_array;
	var arrayBuffer;

	var fileReader = new FileReader();

	fileReader.onload = function() {
		arrayBuffer = this.result;
	}
	fileReader.onloadend = function() {
		// fill out rom to 2mb
		if (arrayBuffer.byteLength < 2097152) {
			arrayBuffer = resizeUint8(arrayBuffer, 2097152);
		}

		u_array = new Uint8Array(arrayBuffer);

		if (loaded_callback) loaded_callback(this);
	}.bind(this);

	fileReader.readAsArrayBuffer(blob);

	this.checkMD5 = function() {
		return SparkMD5.ArrayBuffer.hash(arrayBuffer);
	};

	this.getArrayBuffer = function() {
		return arrayBuffer;
	};

	this.write = function(seek, bytes) {
		if (!bytes.length) {
			u_array[seek] = bytes;
			return;
		}
		for (var i = 0; i < bytes.length; i++) {
			u_array[seek + i] = bytes[i];
		}
	};

	this.save = function(filename) {
		saveAs(new Blob([u_array]), filename);
	};

	this.parseSprGfx = function(spr) {
		return new Promise(function(resolve, reject) {
			for (var i = 0; i < 0x7000; i++) {
				u_array[0x80000 + i] = spr[i];
			}
			for (var i = 0; i < 90; i++) {
				u_array[0xDD308 + i] = spr[0x7000 + i];
			}
			resolve(this);
		});
	};

	this.parsePatch = function(patch, progressCallback) {
		return new Promise(function(resolve, reject) {
			patch.forEach(function(value, index, array) {
				if (progressCallback) progressCallback(index / patch.length, this);
				for (address in value) {
					this.write(Number(address), value[address]);
				}
			}.bind(this));
			resolve(this);
		}.bind(this));
	};
});

function resizeUint8(baseArrayBuffer, newByteSize) {
	var resizedArrayBuffer = new ArrayBuffer(newByteSize),
		len = baseArrayBuffer.byteLength,
		resizeLen = (len > newByteSize)? newByteSize : len;

	(new Uint8Array(resizedArrayBuffer, 0, resizeLen)).set(new Uint8Array(baseArrayBuffer, 0, resizeLen));

	return resizedArrayBuffer;
}

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
			rom.parsePatch(patch.patch).then(function(rom) {
				resolve({rom: rom, patch: patch});
			});
		}, 'json')
		.fail(reject);
	});
}

function romOk(rom) {
	applyHash(rom, get_hash).then(seedApplied, seedFailed);
}

function seedFailed(data) {
	$('.alert .message').html('Failed Creating Seed :(');
	$('.alert').show().delay(2000).fadeOut("slow");
}

function seedApplied(data) {
	return new Promise(function(resolve, reject) {
		$('.info').show();
		$('.info .seed').html(data.patch.hash);
		$('.info .logic').html(data.patch.spoiler.meta.logic);
		$('.info .build').html(data.patch.spoiler.meta.build);
		$('.info .goal').html(data.patch.spoiler.meta.goal);
		$('.info .mode').html(data.patch.spoiler.meta.mode);
		$('.info .difficulty').html(data.patch.difficulty);
		rom.logic = data.patch.spoiler.meta.logic;
		rom.build = data.patch.spoiler.meta.build;
		rom.goal = data.patch.spoiler.meta.goal;
		rom.mode = data.patch.spoiler.meta.mode;
		rom.difficulty = data.patch.difficulty;
		rom.seed = data.patch.hash;
		$('button[name=save]').show().prop('disabled', false);
		$('#heart-speed').trigger('change');
		$('#sprite-gfx').trigger('change');
		resolve(rom);
	});
}

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

function loadBlob(blob, show_error) {
	rom = new ROM(blob, function(rom) {
		if (show_error) {
			localforage.setItem('rom', rom.getArrayBuffer());
		}
		rom.parsePatch(patch).then(function(rom) {
			if (rom.checkMD5() == current_rom_hash) {
				romOk(rom);
			} else {
				if (show_error) {
					$('.alert .message').html('ROM not recognized. Please try another.');
					$('.alert').show();
				}
				$('#rom-select').show();
			}
		});
		return;
	});
}

$(function() {
	$('.alert, .info').hide();
	$('button[name=save]').hide();

	$('button[name=save]').on('click', function() {
		return rom.save('ALttP - VT_' + rom.logic + '_' + rom.difficulty + '-' + rom.mode + '-' + rom.goal + '_' + rom.seed + '.sfc');
	});

	$('input[name=f2u]').on('change', function() {
		$('#rom-select').hide();
		$('.alert').hide();
		loadBlob(this.files[0], true);
	});

	$('#heart-speed').on('change', function() {
		if (rom) {
			var sbyte = 0x20;
			switch ($(this).val()) {
				case 'off': sbyte = 0x00; break;
				case 'half': sbyte = 0x40; break;
				case 'quarter': sbyte = 0x80; break;
			}
			rom.write(0x180033, sbyte);
		}
		localforage.setItem('rom.heart-speed', $(this).val());
	});
	localforage.getItem('rom.heart-speed').then(function(value) {
		if (!value) return;
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
		if (!value) return;
		$('#sprite-gfx').val(value);
		$('#sprite-gfx').trigger('change');
	});

	$('#generate-sram-trace').on('change', function() {
		if (rom) {
			rom.write(0x180030, $(this).prop('checked') ? 0x01 : 0x00);
		}
	});

	// Load ROM from local storage if it's there
	localforage.getItem('rom').then(function(blob) {
		loadBlob(new Blob([blob]));
	});

});
</script>
@overwrite
