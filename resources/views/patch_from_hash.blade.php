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
<div id="seed-details" class="info panel panel-success" style="display:none">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Game Details: <span class="seed"></span></h3>
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
					<label for"generate-sram-trace">SRAM Trace</label>
				</div>
				<div class="col-md-6">
					<input id="generate-music-on" type="checkbox" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for"generate-music-on">Background Music</label>
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
			saveAs(new Blob([u_array]), filename);
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
			resolve(this);
		});
	};

	this.setMusicVolume = function(enable) {
		return new Promise(function(resolve, reject) {
			for (volume in music) {
				for (var i = 0; i < music[volume].length; i++) {
					u_array[music[volume][i]] = enable ? volume : 0;
				}
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
