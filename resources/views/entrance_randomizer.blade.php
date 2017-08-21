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
		<p>Getting started couldn't be easier. VT Randomizer allows you to patch a rom file entirely in your browser.</p>
		<ol>
			<li>Select your rom file and load it into the browser
				(Please use a <strong>Zelda no Densetsu: Kamigami no Triforce v1.0</strong> ROM)</li>
			<li>Select the options for how you would like your game randomized</li>
			<li>Click Generate</li>
			<li>Then Save your rom and get to playing</li>
		</ol>
		<p>You may want to check out the other sections of this site for more information on all the different ways
			one can Randomize their game.</p>
	</div>
</div>
<div id="seed-generate" class="panel panel-info" style="display:none">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Generate Entrance Randomizer Game ({!! ALttP\EntranceRandomizer::VERSION !!})</h3>
		<div class="btn-toolbar pull-right">
			<a class="btn btn-default" href="/randomizer">Switch to Item Randomizer <span class="glyphicon glyphicon-expand"></span></a>
			<button class="btn btn-default" data-toggle="collapse" href="#rom-settings">ROM <span class="glyphicon glyphicon-cog pulse"></span></button>
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
					<input id="generate-music-on" type="checkbox" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for"generate-music-on">Background Music</label>
				</div>
				<div class="secrets" style="display:none">
					<div class="col-md-6">
						<input id="generate-debug" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
						<label for="generate-debug">Debug Mode</label>
					</div>
					<div class="col-md-6">
						<input id="generate-tournament" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
						<label for"generate-tournament">Tournament Mode</label>
					</div>
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
		<div class="col-md-6">
			<div>Logic: <span class="logic"></span></div>
			<div>ROM build: <span class="build"></span></div>
			<div>Difficulty: <span class="difficulty"></span></div>
			<div>Variation: <span class="variation"></span></div>
			<div>Mode: <span class="mode"></span></div>
			<div>Goal: <span class="goal"></span></div>
			<div>Seed: <span class="seed"></span></div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<button name="save-spoiler" class="btn btn-default" disabled>Save Spoiler</button>
				<button name="save" class="btn btn-success" disabled>Save Rom</button>
			</div>
		</div>
		<div class="spoiler col-md-12">
			<div class="spoiler-toggle"><span class="glyphicon glyphicon-plus"></span> Spoiler!</div>
			<div class="spoiler-tabed">
				<div class="col-md-6"></div>
				<div class="col-md-6">
					<select id="spoiler-search" class="form-control selectpicker" data-live-search="true" data-dropup-auto="false" title="Search for Item">
					</select>
				</div>
				<ul class="nav nav-pills" role="tablist">
				</ul>
				<div class="tab-content">
				</div>
			</div>
			<div id="spoiler" class="spoiler-text" style="display:none"></div>
		</div>
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
var rom;
var current_rom_hash = '{{ ALttP\Rom::HASH }}';
var current_base_file = "{{ elixir('js/base2current.json') }}";
var music = {
	0:[866107,866139,889080],
	20:[894736,894884,894907,894930],
	60:[874836,877883,894774,894802,894834,894866],
	80:[875335,875358],
	90:[869126],
	100:[878712,878723,880200,880246,880379,880429,893457,893787,893819,893838,893855,894403,894609,894632,894687],
	120:[861001,868165,869099,870585,870655,873535,874519,874839,875211,875240,875338,894430,894472,894517,894562,894751,894895,894918,894941],
	130:[864000,893909],
	160:[861340,861389,863241,863315,863407,863467,863633,863974,866541,867473,867539,867560,868108,868226,868447,868665,868760,868821,868854,
		868907,868976,869041,869172,869233,869286,869339,869406,869783,871228,871339,871427,871507,871551,871836,873508,878034,878159,878232,
		878335,878981,879708,879727,879758,879796,879997,885373,890380,890920,893491,893858,894110,894763,894789,894821,894853,895990,896013,
		896702,896940],
	170:[891394,891862],
	180:[860621,860793,863846,863856,863915,867223,867244,867304,867341,867385,867432,867487,867516,868382,869008,869438,869743,870355,871747,
		871884,872122,872203,872421,872466,873660,873685,873712,873737,874456,874937,875055,875243,876126,876521,877967,878410,878631,879062,
		879093,879109,879337,880079,880160,880331,881108,881126,881155,881182,886564,886578,890450,890520,892092,892352,892489,895592,895607,
		895624,895641,896772],
	140:[859432,859457,859484,859511,859886,864541,864721,868680,873795,875375,878003,878432,879467,880118,880141,881569,885068,885341,885438,
		885568,885652,885804,886678,887043,887082,889320,889387,889568,889726,889793,895320,895345,895372,895399],
	200:[859538,859581,859627,859997,860063,860093,860124,860138,860362,860603,860873,862036,862284,862310,862343,862368,862394,862427,862452,
		862526,863219,863263,863337,863393,863429,863493,863603,863663,863805,864054,864070,864111,864207,864223,864299,864390,864409,864421,
		864461,864502,864596,864644,865082,865241,865439,865610,865765,865828,865852,865906,865937,865972,865990,866084,866151,866507,867101,
		867119,867157,867184,867201,867263,867636,867669,867694,867782,867844,867896,868197,868262,868431,868487,868730,868768,868956,869145,
		869180,869359,869388,869458,869524,869557,869650,869841,869871,870018,870083,870460,870472,870485,870498,870511,870524,870940,870971,
		871008,871207,871546,871698,871809,872080,872150,872162,872453,872494,872508,872577,872881,872903,872911,872943,872972,872980,873009,
		873047,873069,873077,873135,873149,873165,873179,873628,874497,874660,875112,875135,875538,875889,876048,876186,876427,876452,877850,
		877890,878061,878109,878295,878454,878781,878821,878934,878963,879016,879185,879238,879510,879678,879946,880284,880512,881022,881040,
		881081,885021,885049,885099,885130,885150,885182,885404,885473,885510,885518,885598,885675,885706,885744,885752,885835,885881,885918,
		885963,885995,886003,886090,886131,886173,886196,886222,886314,886401,886755,886783,886907,886982,887011,887108,887163,887959,887972,
		887987,888002,888017,888065,889211,889228,889242,889269,889296,889309,889376,889459,889476,889490,889517,889544,889557,889617,889634,
		889648,889675,889702,889715,889782,890790,890818,890844,890875,890897,891135,891247,891304,891349,891440,891470,891499,891528,891639,
		891677,891715,891772,891817,892036,892045,892076,892136,892147,892157,892230,893790,893822,893841,894072,894147,894167,894198,894229,
		894690,895426,895469,895515,895575,895919,895945,895970,896040,896070,896099,896184,896236,896264,896293,896322,896351,896535,896564,
		896593,896814,896853,896875,896897,897359,897387,897408,897429,897450],
	210:[863112,865866,865951,866119],
	220:[860479,860532,860830,861222,870193,870227,870260,870293,870326,871077,871140,871318,871589,873591,875069,877926,878380,878528,879032,
		879281,879621,880051,881067,888365,888589,890080,890180,890280,891266,891734,894612,894635,896648,896712,896742,897471],
	230:[860426,860892,861255,875085,875996,893521,893548],
	240:[889950,890493,890562,892053,892646,894406],
	250:[860231,861378,861420,861604,867754,872872,872934,873038,873118,876613,885214,885278,890026,891550,891620,893577],
	255:[860293,860613,876328]
};
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

	this.updateChecksum = function() {
		return new Promise(function(resolve, reject) {
			var sum = u_array.reduce(function(sum, mbyte, i) {
				if (i >= 0x7FB0 && i <= 0x7FE0) {
					return sum;
				}
				return sum + mbyte;
			});
			var checksum = sum & 0xFFFF;
			var inverse = checksum ^ 0xFFFF;
			this.write(0x7FDC, [inverse & 0xFF, inverse >> 8, checksum & 0xFF, checksum >> 8]);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.save = function(filename) {
		this.updateChecksum().then(function() {
			FileSaver.saveAs(new Blob([u_array]), filename);
		});
	};

	this.parseSprGfx = function(spr) {
		return new Promise(function(resolve, reject) {
			for (var i = 0; i < 0x7000; i++) {
				u_array[0x80000 + i] = spr[i];
			}
			for (var i = 0; i < 120; i++) {
				u_array[0xDD308 + i] = spr[0x7000 + i];
			}
			// gloves color
			u_array[0xDEDF5] = spr[0x7036];
			u_array[0xDEDF6] = spr[0x7037];
			u_array[0xDEDF7] = spr[0x7054];
			u_array[0xDEDF8] = spr[0x7055];
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setMusicVolume = function(enable) {
		return new Promise(function(resolve, reject) {
			for (volume in music) {
				for (var i = 0; i < music[volume].length; i++) {
					u_array[music[volume][i]] = enable ? volume : 0;
				}
			}
			resolve(this);
		}.bind(this));
	}.bind(this);

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
	$('#config').show();
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
		$('.info').show();
		$('.info .seed').html(data.patch.seed + " [<a href='/h/" + data.patch.hash + "'>permalink</a>]");
		if ($('input[name=tournament]').val() == 'true') {
			$('.info .seed').html("<a href='/h/" + data.patch.seed + "'>" + data.patch.seed + "</a>");
		}
		$('.info .logic').html(data.patch.logic);
		$('.info .build').html(data.patch.spoiler.meta.build);
		$('.info .goal').html(data.patch.spoiler.meta.goal);
		$('.info .mode').html(data.patch.spoiler.meta.mode);
		$('.info .variation').html(data.patch.spoiler.meta.variation);
		$('.info .difficulty').html(data.patch.difficulty);
		$('.spoiler').show();
		$('#spoiler').html('<pre>' + JSON.stringify(data.patch.spoiler, null, 4) + '</pre>');
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

var tabsContent = new Map();
function pasrseSpoilerToTabs(spoiler) {
	var spoilertabs = $('.spoiler-tabed');
	var nav = spoilertabs.find('.nav-pills');
	var active_nav = nav.find('.active a').data('section');
	nav.html('');
	var content = spoilertabs.find('.tab-content').html('');
	var items = {};
	for (section in spoiler) {
		nav.append($('<li id="n-spoiler-' + section.replace(/ /g, '_') + '" ' + ((section == active_nav) ? 'class="active"' : '') + '><a data-toggle="tab" data-section="' + section + '" href="#spoiler-' + section.replace(/ /g, '_') + '">' + section + '<span class="badge badge-pill"></span></a></li>'));
		content.append($('<div id="spoiler-' + section.replace(/ /g, '_') + '" class="tab-pane' + ((section == active_nav) ? ' active' : '') + '"><pre>' + JSON.stringify(spoiler[section], null, 4) + '</pre></div>'));
		if (['meta', 'playthrough', 'Fountains', 'Medallions'].indexOf(section) === -1) {
			tabsContent.set('spoiler-' + section.replace(/ /g, '_'), Object.keys(spoiler[section]).map(function (key) {
				return spoiler[section][key];
			}));
		}
		for (loc in spoiler[section]) {
			if (['meta', 'playthrough', 'Fountains', 'Medallions'].indexOf(section) > -1) continue;
			items[spoiler[section][loc]] = true;
		}
		var sopts = '';
		Object.keys(items).sort().forEach(function(item) {
			sopts += '<option value="' + item + '">' + item + '</option>';
		});
		$('#spoiler-search').html(sopts).selectpicker('refresh');
	}
}

$('#spoiler-search').on('changed.bs.select', function() {
	var string = $(this).val();
	tabsContent.forEach(function(val, nav) {
		var numItems = val.reduce(function(n, item) {
		    return n + (item == string);
		}, 0);
		$('#n-' + nav + ' .badge').html(numItems || null);
	});
});

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
		patchRomFromJSON(rom).then(function(rom) {
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
	$('.alert, .info, #config').hide();
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
		localforage.setItem('rom.er.difficulty', $(this).val());
	});
	localforage.getItem('rom.er.difficulty').then(function(value) {
		if (!value) return;
		$('#difficulty').val(value);
		$('#difficulty').trigger('change');
	});

	$('#variation').on('change', function() {
		$('.info').hide();
		var variation = $(this).val();
		var goal = $('#goal').val();
		$('input[name=variation]').val(variation);
		localforage.setItem('rom.er.variation', variation);
		if (variation === 'triforce-hunt' && goal !== 'triforce-hunt') {
			$('#goal').val('triforce-hunt');
			$('#goal').trigger('change');
		} else if (variation !== 'triforce-hunt' && goal === 'triforce-hunt') {
			$('#goal').val('ganon');
			$('#goal').trigger('change');
		}
	});
	localforage.getItem('rom.er.variation').then(function(value) {
		if (!value) return;
		$('#variation').val(value);
		$('#variation').trigger('change');
	});

	$('#shuffle').on('change', function() {
		$('.info').hide();
		$('input[name=shuffle]').val($(this).val());
		localforage.setItem('rom.er.shuffle', $(this).val());
	});
	localforage.getItem('rom.er.shuffle').then(function(value) {
		if (!value) return;
		$('#shuffle').val(value);
		$('#shuffle').trigger('change');
	});

	$('button[name=save]').on('click', function() {
		return rom.save('ER_' + rom.logic + '_' + rom.difficulty + '-' + rom.mode + '-' + rom.goal + '_' + rom.seed + '.sfc');
	});
	$('button[name=save-spoiler]').on('click', function() {
		return FileSaver.saveAs(new Blob([$('.spoiler-text pre').html()]), 'ER_' + rom.logic + '_' + rom.difficulty + '-' + rom.mode + '-' + rom.goal + '_' + rom.seed + '.txt');
	});

	$('button[name=generate-save]').on('click', function() {
		applySeed(rom, $('#seed').val())
			.then(seedApplied, seedFailed)
			.then(function(rom) {
				return rom.save('ER_' + rom.logic + '_' + rom.difficulty + '-' + rom.mode + '-' + rom.goal + '_' + rom.seed + '.sfc');
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

	$('#logic').on('change', function() {
		$('.info').hide();
		localforage.setItem('rom.er.logic', $(this).val());
		$('input[name=logic]').val($(this).val());
	});
	localforage.getItem('rom.er.logic').then(function(value) {
		if (value === null) return;
		$('#logic').val(value);
		$('#logic').trigger('change');
	});

	$('#mode').on('change', function() {
		$('.info').hide();
		localforage.setItem('rom.er.mode', $(this).val());
		$('input[name=mode]').val($(this).val());
	});
	localforage.getItem('rom.er.mode').then(function(value) {
		if (value === null) return;
		$('#mode').val(value);
		$('#mode').trigger('change');
	});

	$('#goal').on('change', function() {
		$('.info').hide();
		var goal = $(this).val();
		var variation = $('#variation').val();
		localforage.setItem('rom.er.goal', goal);
		$('input[name=goal]').val(goal);
		if (goal === 'triforce-hunt' && variation !== 'triforce-hunt') {
			$('#variation').val('triforce-hunt');
			$('#variation').trigger('change');
		} else if (goal !== 'triforce-hunt' && variation === 'triforce-hunt') {
			$('#variation').val('none');
			$('#variation').trigger('change');
		}
	});
	localforage.getItem('rom.er.goal').then(function(value) {
		if (value === null) return;
		$('#goal').val(value);
		$('#goal').trigger('change');
	});

	$('#generate-debug').on('change', function() {
		$('input[name=debug]').val($(this).prop('checked'));
	});
	$('#generate-tournament').on('change', function() {
		$('input[name=tournament]').val($(this).prop('checked'));
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
				zip.file('ER_' + data.patch.logic + '_' + data.patch.difficulty + '-' + data.patch.spoiler.meta.mode + '-' + data.patch.spoiler.meta.goal + '_' + data.patch.seed + '.sfc', buffer);
				zip.file('spoilers/ER_' + data.patch.logic + '_' + data.patch.difficulty + '-' + data.patch.spoiler.meta.mode + '-' + data.patch.spoiler.meta.goal + '_' + data.patch.seed + '.txt', new Blob([JSON.stringify(data.patch.spoiler, null, 4)]));
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

	// Load ROM from local storage if it's there
	localforage.getItem('rom').then(function(blob) {
		loadBlob(new Blob([blob]));
	});

	new secrets(function() {
		$('.secrets').show();
	});
});
</script>
@overwrite
