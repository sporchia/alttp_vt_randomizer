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
	<div class="panel-heading"><h3 class="panel-title">Seed Details: <span class="seed"></span></h3></div>
	<div class="panel-body">
		<div class="col-md-6">
			<div>Logic: <span class="logic"></span></div>
			<div>ROM build: <span class="build"></span></div>
			<div>Rules: <span class="rules"></span></div>
			<div>Mode: <span class="mode"></span></div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<button name="save" class="btn btn-success" disabled>Save Rom</button>
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
		return patchRomFromJSON(rom, resetjsonfile)
			.then(function(rom) {
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
	localforage.setItem('rom', rom.getArrayBuffer());
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
		$('.info .logic').html(data.patch.logic);
		$('.info .build').html(data.patch.spoiler.meta.build);
		$('.info .mode').html(data.patch.spoiler.meta.mode);
		$('.info .rules').html(data.patch.rules);
		rom.logic = data.patch.logic;
		rom.build = data.patch.spoiler.meta.build;
		rom.mode = data.patch.spoiler.meta.mode;
		rom.rules = data.patch.rules;
		rom.seed = data.patch.hash;
		$('button[name=save]').show().prop('disabled', false);
		resolve(rom);
	});
}

function loadBlob(blob, show_error) {
	rom = new ROM(blob, function(rom) {
		switch (rom.checkMD5()) {
			case current_rom_hash:
				romOk(rom);
				break;
			default:
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
		}
	});
}

$(function() {
	$('.alert, .info').hide();
	$('button[name=save]').hide();

	$('button[name=save]').on('click', function() {
		return rom.save('ALttP - VT_' + rom.logic + '_' + rom.rules + '-' + rom.mode + '_' + rom.seed + '.sfc');
	});

	$('input[name=f2u]').on('change', function() {
		$('#rom-select').hide();
		$('.alert').hide();
		loadBlob(this.files[0], true);
	});

	// Load ROM from local storage if it's there
	if (localforage.supports(localforage.INDEXEDDB) || localforage.supports(localforage.WEBSQL) || localforage.supports(localforage.LOCALSTORAGE)) {
		$('#rom-select').hide();
		$('.alert').hide();
		localforage.getItem('rom').then(function(blob) {
			loadBlob(new Blob([blob]));
		});
	}
});
</script>
@overwrite
