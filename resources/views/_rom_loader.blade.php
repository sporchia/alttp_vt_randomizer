@section('loader')
<div class="alert alert-danger alert-dismissible" role="alert" style="display:none">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
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
				Select A Link to the Past ROM File <input type="file" accept=".sfc,.smc" name="f2ualttp" style="display: none;">
			</label>
		</p>
		<p>
			<label class="btn btn-default btn-file">
				Select Super Metroid ROM File <input type="file" accept=".sfc,.smc" name="f2usm" style="display: none;">
			</label>
		</p>
		<ol>
			<li>Select your roms and load it into the browser
				(Please use <strong>Zelda no Densetsu: Kamigami no Triforce v1.0</strong> and <strong>Super Metroid (JU)</strong> ROMs with .smc or .sfc extensions)</li>
			<li>Select the <a href="/options">options</a> for how you would like your game randomized</li>
			<li>Click Generate</li>
			<li>Then Save your rom and get to playing</li>
		</ol>
	</div>
</div>

<script>
var rom;
var current_rom_hash = '{{ $rom_hash or ALttP\Rom::HASH }}';
var current_base_file = "{{ $rom_patch or mix('js/base2current.json') }}";

function resetRom() {
	return new Promise(function(resolve, reject) {
		localforage.getItem('rom').then(function(blob) {
			rom = new ROM(new Blob([blob]), function(rom) {
				patchRomFromJSON(rom).then(function() {
					resolve(rom);
				});
			});
		});
	});
}

function patchRomFromJSON(rom) {
	return new Promise(function(resolve, reject) {
		if (typeof vt_base_patch !== 'undefined') {
			rom.parsePatch(vt_base_patch).then(function(rom) {
				resolve(rom);
			});
			return;
		}
		localforage.getItem('vt_stored_base').then(function(stored_base_file) {
			if (current_base_file == stored_base_file) {
				localforage.getItem('vt_base_json').then(function(patch) {
					rom.parsePatch(patch).then(function(rom) {
						resolve(rom);
					});
				});
			} else {
				$.getJSON(current_base_file, function(patch) {
					localforage.setItem('vt_stored_base', current_base_file)
						.then(function() {
							localforage.setItem('vt_base_json', patch)
								.then(patchRomFromJSON(rom)
								.then(function() {
									return resolve(rom);
								}));
						});
				});
			}
		});
	});
}

function romOk(rom) {
	$('button[name=generate]').html('Generate ROM').prop('disabled', false);
	$('button[name=generate-save]').prop('disabled', false);
	$('#seed-generate').show();
}

function loadBlob(blob, show_error) {
	if (!blob instanceof Blob) {
		if (show_error) {
			$('.alert .message').html('file not recognized. Please try another.');
			$('.alert').show();
		}
		$('#rom-select').show();
		return;
	}

	rom = new ROM(blob, function(rom) {
		if (show_error) {
			localforage.setItem('rom', rom.getArrayBuffer());
		}
		patchRomFromJSON(rom).then(function(rom) {
			if (rom.checkMD5() == current_rom_hash) {
				romOk(rom);
			} else {
				if (show_error) {
					$('.alert .message').html('ROM not recognized. Please try another.');
					$('.alert').show();
				}
				smUploadedBlob = null;
				alttpUploadedBlob = null;
				$('#rom-select').show();
			}
		});
		return;
	});
}

function loadMergedBlobs(smBlob, alttpBlob)
{
	var smRomBuffer = null;
	var alttpRomBuffer = null;

	var smFileReader = new FileReader();
	smFileReader.onloadend = function() { 
		smRomBuffer = smFileReader.result;
		var alttpFileReader = new FileReader();
		alttpFileReader.onloadend = function() { 
			alttpRomBuffer = alttpFileReader.result;
			loadMergedBuffers(smRomBuffer, alttpRomBuffer);
		};	
		alttpFileReader.readAsArrayBuffer(alttpBlob);
	};
	smFileReader.readAsArrayBuffer(smBlob);
}

function loadMergedBuffers(smRomBuffer, alttpRomBuffer)
{
	var smRom = new Uint8Array(smRomBuffer);
	var alttpRom = new Uint8Array(alttpRomBuffer);

	var data = new Uint8Array(0x600000);
	var pos = 0;
	for(var i = 0; i < 0x40; i++)
	{
		var hi_bank = smRom.slice((i*0x8000), (i*0x8000)+0x8000);
		var lo_bank = smRom.slice(((i+0x40)*0x8000), ((i+0x40)*0x8000)+0x8000);

		data.set(lo_bank, pos);
		data.set(hi_bank, pos + 0x8000);
		pos += 0x10000;
	}
 
	pos = 0x400000;

	for(var i = 0; i < 0x20; i++)
	{
		var hi_bank = alttpRom.slice((i*0x8000), (i*0x8000)+0x8000);
		data.set(hi_bank, pos + 0x8000);
		pos += 0x10000;
	}

	loadBlob(new Blob([data]), true);
}

var smUploadedBlob = null;
var alttpUploadedBlob = null;

$(function() {
	$('.alert, .info').hide();

	$('input[name=f2ualttp]').on('change', function() {
		alttpUploadedBlob = this.files[0];
		if(alttpUploadedBlob != null && smUploadedBlob != null)
		{
			$('#rom-select').hide();
			$('.alert').hide();
			loadMergedBlobs(smUploadedBlob, alttpUploadedBlob);
			//loadBlob(mergedBlob, true);
		}
	});

	$('input[name=f2usm]').on('change', function() {
		smUploadedBlob = this.files[0];
		if(alttpUploadedBlob != null && smUploadedBlob != null)
		{
			$('#rom-select').hide();
			$('.alert').hide();
			loadMergedBlobs(smUploadedBlob, alttpUploadedBlob);
			//loadBlob(mergedBlob, true);
		}
	});

	// Load ROM from local storage if it's there
	localforage.getItem('rom').then(function(blob) {
		loadBlob(new Blob([blob]));
	});
});
</script>
@overwrite
