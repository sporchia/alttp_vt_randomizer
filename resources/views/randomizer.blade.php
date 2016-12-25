@extends('layouts.default')

@section('content')
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <span class="message">Cannot Read ROM file.</span>
</div>
<label id="rom-select" class="btn btn-default btn-file">
	Select ROM File <input type="file" accept=".sfc" name="f2u" style="display: none;">
</label>
<progress value="0" max="100" class="hidden"></progress>
<div id="seed-generate" style="display:none">
	<label for="seed">Seed </label>
	<input type="text" name="seed" id="seed" />
	<button name="generate" class="btn" disabled>Please Select File.</button>
</div>
<div class="row">
	<div class="info">
		<div>Logic: <span class="logic"></span></div>
		<div>Rules: <span class="rules"></span></div>
		<div>Seed: <span class="seed"></span></div>
	</div>
</div>
<div class="row">
	<div class="spoiler">
		<div class="spoiler-toggle"><span class="glyphicon glyphicon-plus"></span> Spoiler!</div>
		<div id="spoiler" class="spoiler-text">
		</div>
	</div>
</div>
<script>
var rom;
var ROM = ROM || (function(blob, loaded_callback) {
	var u_array;
	var arrayBuffer;

	var fileReader = new FileReader();

	fileReader.onload = function() {
		arrayBuffer = this.result;
	}
	fileReader.onloadend = function() {
		u_array = new Uint8Array(arrayBuffer);
		if (loaded_callback) loaded_callback(this);
	}.bind(this);

	fileReader.readAsArrayBuffer(blob);

	this.checkMD5 = function() {
		return SparkMD5.ArrayBuffer.hash(arrayBuffer);
	}

	this.write = function(seek, bytes) {
		if (!bytes.length) {
			u_array[seek] = bytes;
			return;
		}
		for (var i = 0; i < bytes.length; i++) {
			u_array[seek + i] = bytes[i];
		}
	},

	this.save = function(filename) {
		saveAs(new Blob([u_array]), filename);
	},

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

function applySeed(rom, seed) {
	return new Promise(function(resolve, reject) {
		$prog = $('progress');
		$.getJSON('/seed/' + (seed ? seed : ''), {rules: 'v7'}, function(patch) {
			$('#seed').val(patch.seed);
			rom.parsePatch(patch.patch, function(percentage) {
				$prog.val(percentage * 100);
			}).then(function(rom) {
				resolve({rom: rom, patch: patch});
			});
		});
	});
}

function patchRomFromJSON(rom, uri) {
	return new Promise(function(resolve, reject) {
		$prog = $('progress');
		$.getJSON(uri, function(patch) {
			rom.parsePatch(patch, function(percentage) {
				$prog.val(percentage * 100);
			}).then(function(rom) {
				resolve(rom);
			});
		});
	});
}

function romOk() {
	$('button[name=generate]').html('Generate').prop('disabled', false);
	$('#seed-generate').show();
}

$('button[name=generate]').on('click', function() {
	$('button[name=generate]').html('Generating...').prop('disabled', true);
	applySeed(rom, $('#seed').val()).then(function(data) {
		$('button[name=generate]').html('Generate').prop('disabled', false);
		$('.info').show();
		$('.info .seed').html(data.patch.seed);
		$('.info .logic').html(data.patch.logic);
		$('.info .rules').html(data.patch.rules);
		$('.spoiler').show();
		if ($('.spoiler-text').is(':visible')) {
			$('.spoiler-toggle').trigger('click');
		}
		$('#spoiler').html('<pre>' + JSON.stringify(data.patch.spoiler, null, 4) + '</pre>');
		return data.rom.save('ALttP - VT_' + data.patch.logic + '_' + data.patch.rules + '_' + data.patch.seed + '.sfc');
	});
});

$('input[name=f2u]').on('change', function() {
	$('#rom-select').hide();
	$('.alert').hide();
	rom = new ROM(this.files[0], function(rom) {
		switch (rom.checkMD5()) {
			case 'bb3bf2ef68b983d17f082b8054f111dd':
				$('progress').val(100);
				romOk();
				break;
			case '118597172b984bfffaff1a1b7d06804d':
				patchRomFromJSON(rom, 'js/base2current.json')
					.then(romOk);
				break;
			default:
				// attempt to reset
				patchRomFromJSON(rom, 'js/base2current.json')
				.then(function(rom) {
					patchRomFromJSON(rom, 'js/romreset.json')
					.then(function(rom) {
						if (rom.checkMD5() == 'bb3bf2ef68b983d17f082b8054f111dd') {
							romOk();
						} else {
							rom.save('bad.sfc');
							$('.alert .message').html('ROM not recognized. Please try another.');
							$('.alert').show();
							$('#rom-select').show();
						}
					});
				});
				return;
		}
	});
});

$(function(){
	$('.alert, .info').hide();
	$('.spoiler').hide();
	$('.spoiler-text').hide();
	$('.spoiler-toggle').on('click', function() {
		$(this).next().animate({height: 'toggle'});
		if ($('.spoiler-text').is(':visible')) {
			$(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
		} else {
			$(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		}
	});
});
</script>
@overwrite
