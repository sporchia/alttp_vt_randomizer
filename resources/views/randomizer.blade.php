@extends('layouts.default')

@section('content')
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <span class="message">Cannot Read ROM file.</span>
</div>
<div id="rom-select">
	<div>To get started, please:
		<label class="btn btn-default btn-file">
			Select ROM File <input type="file" accept=".sfc" name="f2u" style="display: none;">
		</label>
	</div>
</div>
<div id="seed-generate" style="display:none">
	<div class="col-md-6">
		<div class="input-group">
			<span class="input-group-addon">Seed</span>
			<input type="text" id="seed" class="seed form-control" placeholder="leave blank for random">
			<span class="input-group-btn">
				<button id="seed-clear" class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove"></span></button>
			</span>
		</div>
	</div>
	<button name="generate" class="btn" disabled>Please Select File.</button>
	<button name="save" class="btn" disabled>Save</button>
</div>
<form id="config">
	{{ csrf_field() }}
	<label for="rules">Then pick your Rules:</label>
	<select id="rules" name="rules">
		<option value="v7" selected>v7</option>
		<option value="v7_hard">v7 (hard mode)</option>
		<option value="v8">v8</option>
		<option value="custom">Custom</option>
	</select>
	<div class="custom-rules">
		<div class="col-md-12"><h1>Custom Rules</h1></div>
		<div class="col-md-6">
			<input id="cust-prize-crossworld" type="checkbox" name="data[alttp.custom.prize.crossWorld]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for"cust-prize-crossworld">Swap Pendants and Crystals Cross World</label>
		</div>
		<div class="col-md-6">
			<input id="cust-region-bossnormal" type="checkbox" name="data[alttp.custom.region.bossNormalLocation]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-bossnormal">Boss Hearts can contain Dungeon Items</label>
		</div>
		<div class="col-md-6">
			<input id="cust-region-swordShuffle" type="checkbox" name="data[alttp.custom.region.swordShuffle]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-swordShuffle">Shuffle the Swords (within themselves)</label>
		</div>
		<div class="col-md-6">
			<input id="cust-spoil-boots" type="checkbox" name="data[alttp.custom.spoil.BootsLocation]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-spoil-boots">Chance for boots region to be spoiled by Uncle</label>
		</div>
		<div class="col-md-6">
			<input id="cust-region-CompassesMaps" type="checkbox" name="data[alttp.custom.region.CompassesMaps]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-CompassesMaps">Dungeons Contain Compasses and Maps</label>
		</div>

		<div class="col-md-12"><h2>Items</h2></div>
		<div class="col-md-12">Total Items: <span id="custom-count">132</span> / <span id="custom-count-total">132</span></div>
		<div class="col-md-12"><h3>Advancement</h3></div>
		<div class="col-md-4">
			<input id="item-count-Bow" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Bow]" readonly class="custom-items">
			<label for="item-count-Bow">Bow</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-BookOfMudora" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.BookOfMudora]" readonly class="custom-items">
			<label for="item-count-BookOfMudora">Book Of Mudora</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Hammer" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Hammer]" readonly class="custom-items">
			<label for="item-count-Hammer">Hammer</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Hookshot" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Hookshot]" readonly class="custom-items">
			<label for="item-count-Hookshot">Hookshot</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-MagicMirror" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.MagicMirror]" readonly class="custom-items">
			<label for="item-count-MagicMirror">Magic Mirror</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Ocarina" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Ocarina]" readonly class="custom-items">
			<label for="item-count-Ocarina">Ocarina</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-PegasusBoots" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.PegasusBoots]" readonly class="custom-items">
			<label for="item-count-PegasusBoots">Pegasus Boots</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-PowerGlove" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.PowerGlove]" readonly class="custom-items">
			<label for="item-count-PowerGlove">Power Glove</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Cape" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Cape]" readonly class="custom-items">
			<label for="item-count-Cape">Cape</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Mushroom" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Mushroom]" readonly class="custom-items">
			<label for="item-count-Mushroom">Mushroom</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Shovel" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Shovel]" readonly class="custom-items">
			<label for="item-count-Shovel">Shovel</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Lamp" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Lamp]" readonly class="custom-items">
			<label for="item-count-Lamp">Lamp</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Powder" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Powder]" readonly class="custom-items">
			<label for="item-count-Powder">Powder</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-MoonPearl" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.MoonPearl]" readonly class="custom-items">
			<label for="item-count-MoonPearl">Moon Pearl</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-CaneOfSomaria" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.CaneOfSomaria]" readonly class="custom-items">
			<label for="item-count-CaneOfSomaria">Cane Of Somaria</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-FireRod" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.FireRod]" readonly class="custom-items">
			<label for="item-count-FireRod">Fire Rod</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Flippers" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Flippers]" readonly class="custom-items">
			<label for="item-count-Flippers">Flippers</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-IceRod" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.IceRod]" readonly class="custom-items">
			<label for="item-count-IceRod">Ice Rod</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-TitansMitt" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.TitansMitt]" readonly class="custom-items">
			<label for="item-count-TitansMitt">Titans Mitt</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Ether" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Ether]" readonly class="custom-items">
			<label for="item-count-Ether">Ether</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Bombos" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Bombos]" readonly class="custom-items">
			<label for="item-count-Bombos">Bombos</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Quake" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Quake]" readonly class="custom-items">
			<label for="item-count-Quake">Quake</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Bottle" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Bottle]" readonly class="custom-items">
			<label for="item-count-Bottle">Bottle</label>
		</div>
		<div class="col-md-12"><h3>Extra</h3></div>
		<div class="col-md-4">
			<input id="item-count-Arrow" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.Arrow]" class="custom-items">
			<label for="item-count-Arrow">Single Arrow</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-ArrowUpgrade10" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.ArrowUpgrade10]" class="custom-items">
			<label for="item-count-ArrowUpgrade10">Arrow Upgrade (+10)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-ArrowUpgrade5" type="number" value="6" min="0" max="200" step="1" name="data[alttp.custom.item.count.ArrowUpgrade5]" class="custom-items">
			<label for="item-count-ArrowUpgrade5">Arrow Upgrade (+5)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-ArrowUpgrade70" type="number" value="0" min="0" max="200" step="1" name="data[alttp.custom.item.count.ArrowUpgrade70]" class="custom-items">
			<label for="item-count-ArrowUpgrade70">Arrow Upgrade (+70)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-BlueMail" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.BlueMail]" class="custom-items">
			<label for="item-count-BlueMail">Blue Mail</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Bomb" type="number" value="0" min="0" max="200" step="1" name="data[alttp.custom.item.count.Bomb]" class="custom-items">
			<label for="item-count-Bomb">Single Bomb</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-BombUpgrade10" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.BombUpgrade10]" class="custom-items">
			<label for="item-count-BombUpgrade10">Bomb Upgrade (+10)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-BombUpgrade5" type="number" value="6" min="0" max="200" step="1" name="data[alttp.custom.item.count.BombUpgrade5]" class="custom-items">
			<label for="item-count-BombUpgrade5">Bomb Upgrade (+5)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-BombUpgrade50" type="number" value="0" min="0" max="200" step="1" name="data[alttp.custom.item.count.BombUpgrade50]" class="custom-items">
			<label for="item-count-BombUpgrade50">Bomb Upgrade (+50)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-Boomerang" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.Boomerang]" class="custom-items">
			<label for="item-count-Boomerang">Blue Boomerang</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-BossHeartContainer" type="number" value="10" min="0" max="200" step="1" name="data[alttp.custom.item.count.BossHeartContainer]" class="custom-items">
			<label for="item-count-BossHeartContainer">Boss Heart Container</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-BugCatchingNet" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.BugCatchingNet]" class="custom-items">
			<label for="item-count-BugCatchingNet">Bug Catching Net</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-ExtraBottles" type="number" value="3" min="0" max="200" step="1" name="data[alttp.custom.item.count.ExtraBottles]" class="custom-items">
			<label for="item-count-ExtraBottles">Extra Bottles</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-HeartContainer" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.HeartContainer]" class="custom-items">
			<label for="item-count-HeartContainer">Sancturary Heart Container</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-MirrorShield" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.MirrorShield]" class="custom-items">
			<label for="item-count-MirrorShield">Mirror Shield</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-OneHundredRupees" type="number" value="4" min="0" max="200" step="1" name="data[alttp.custom.item.count.OneHundredRupees]" class="custom-items">
			<label for="item-count-OneHundredRupees">Rupees (100)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-PieceOfHeart" type="number" value="24" min="0" max="200" step="1" name="data[alttp.custom.item.count.PieceOfHeart]" class="custom-items">
			<label for="item-count-PieceOfHeart">Piece Of Heart Container</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-RedBoomerang" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.RedBoomerang]" class="custom-items">
			<label for="item-count-RedBoomerang">Red Boomerang</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-RedMail" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.RedMail]" class="custom-items">
			<label for="item-count-RedMail">Red Mail</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-RedShield" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.RedShield]" class="custom-items">
			<label for="item-count-RedShield">Red Shield</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-StaffOfByrna" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.StaffOfByrna]" class="custom-items">
			<label for="item-count-StaffOfByrna">Staff Of Byrna</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-TenArrows" type="number" value="7" min="0" max="200" step="1" name="data[alttp.custom.item.count.TenArrows]" class="custom-items">
			<label for="item-count-TenArrows">Arrows (10)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-ThreeBombs" type="number" value="12" min="0" max="200" step="1" name="data[alttp.custom.item.count.ThreeBombs]" class="custom-items">
			<label for="item-count-ThreeBombs">Bombs (3)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-ThreeHundredRupees" type="number" value="4" min="0" max="200" step="1" name="data[alttp.custom.item.count.ThreeHundredRupees]" class="custom-items">
			<label for="item-count-ThreeHundredRupees">Rupees (300)</label>
		</div>
		<div class="col-md-4">
			<input id="item-count-TwentyRupees" type="number" value="21" min="0" max="200" step="1" name="data[alttp.custom.item.count.TwentyRupees]" class="custom-items">
			<label for="item-count-TwentyRupees">Rupees (20)</label>
		</div>



	</div>
</form>

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

function applySeed(rom, seed, second_attempt) {
	if (rom.checkMD5() != 'bb3bf2ef68b983d17f082b8054f111dd') {
		if (second_attempt) {
			$('.alert .message').html('Could not reset ROM.');
			$('.alert').show();
			return;
		}
		return patchRomFromJSON(rom, 'js/romreset.json')
			.then(function(rom) {
				return applySeed(rom, seed, true);
			});
	}
	return new Promise(function(resolve, reject) {
		$.post('/seed' + (seed ? '/' + seed : ''), getFormData($('form#config')), function(patch) {
			rom.parsePatch(patch.patch).then(function(rom) {
				resolve({rom: rom, patch: patch});
			});
		}, 'json');
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

function patchRomFromJSON(rom, uri) {
	return new Promise(function(resolve, reject) {
		$.getJSON(uri, function(patch) {
			rom.parsePatch(patch).then(function(rom) {
				resolve(rom);
			});
		});
	});
}

function romOk() {
	$('button[name=generate]').html('Generate').prop('disabled', false);
	$('#seed-generate').show();
	$('#config').show();
}
$('button[name=save]').on('click', function() {
	return rom.save('ALttP - VT_' + rom.logic + '_' + rom.rules + '_' + rom.seed + '.sfc');
});

$('button[name=generate]').on('click', function() {
	$('button[name=generate]').html('Generating...').prop('disabled', true);
	$('button[name=save]').prop('disabled', true);
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
		rom.logic = data.patch.logic;
		rom.rules = data.patch.rules;
		rom.seed = data.patch.seed;
		$('button[name=save]').show().prop('disabled', false);
	});
});

$('input[name=f2u]').on('change', function() {
	$('#rom-select').hide();
	$('.alert').hide();
	rom = new ROM(this.files[0], function(rom) {
		switch (rom.checkMD5()) {
			case 'bb3bf2ef68b983d17f082b8054f111dd':
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

$(function() {
	$('.alert, .info, #config, .custom-rules').hide();
	$('button[name=save]').hide();
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
	$('#config select[name=rules]').on('change', function() {
		if ($(this).val() == 'custom') {
			$('.custom-rules').show();
		} else {
			$('.custom-rules').hide();
		}
	});
	$('.custom-items').on('change click blur', function(e) {
		e.stopPropagation();
		$('#custom-count').html($('.custom-items').map(function(){return Number(this.value)}).toArray().reduce(function(a,b){return a+b}));
	});
	$('.custom-items').first().trigger('change');

	$('#cust-region-CompassesMaps').on('change', function() {
		if ($(this).prop('checked')) {
			$('#custom-count-total').html('132');
		} else {
			$('#custom-count-total').html('157');
		}
	});

	$('#seed-clear').on('click', function() {
		$('#seed').val('');
	});
});
</script>
@overwrite
