@section('switches')
<div class="col-md-6 pb-5">
	<input id="cust-prize-crossworld" type="checkbox" name="data[alttp.custom.prize.crossWorld]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-prize-crossworld">Swap Pendants and Crystals Cross World</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-prize-shufflePendants" type="checkbox" name="data[alttp.custom.prize.shufflePendants]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-prize-shufflePendants">Shuffle Pendants</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-prize-shuffleCrystals" type="checkbox" name="data[alttp.custom.prize.shuffleCrystals]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-prize-shuffleCrystals">Shuffle Crystals</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-region-bossNormalLocation" type="checkbox" name="data[alttp.custom.region.bossNormalLocation]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-bossNormalLocation">Boss Hearts can contain Dungeon Items</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-region-bossHaveKey" type="checkbox" name="data[alttp.custom.region.bossHaveKey]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-bossHaveKey">Boss Hearts can contain Keys</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-region-swordShuffle" type="checkbox" name="data[alttp.custom.region.swordShuffle]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-swordShuffle">Shuffle the Swords (within themselves)</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-region-swordsInPool" type="checkbox" name="data[alttp.custom.region.swordsInPool]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-swordsInPool">Shuffle the Swords (into item pool)</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-spoil-boots" type="checkbox" name="data[alttp.custom.spoil.BootsLocation]"
		class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-spoil-boots">Chance (5%) for boots region to be spoiled by Uncle</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-region-CompassesMaps" type="checkbox" name="data[alttp.custom.region.CompassesMaps]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-CompassesMaps">Dungeons Contain Compasses and Maps</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-sprite-shufflePrizePack" type="checkbox" name="data[alttp.custom.sprite.shufflePrizePack]"
		class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-sprite-shufflePrizePack">Shuffle Prize Packs</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-sprite-shuffleOverworldBonkPrizes" type="checkbox" name="data[alttp.custom.sprite.shuffleOverworldBonkPrizes]"
		class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-sprite-shuffleOverworldBonkPrizes">Shuffle Overworld Bonk Prizes</label>
</div>
<div class="col-md-6 pb-5">
	<input id="cust-bees" type="checkbox" name="data[alttp.custom.bees]"
		class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="Not" data-size="small">
	<label id="bees-label" for="cust-bees">the Bees</label>
</div>
<div class="col-md-6 pb-5">
	<div class="input-group" role="group">
		<span class="input-group-addon">Goal Items</span>
		<input type="number" class="form-control" placeholder="pieces" name="data[alttp.custom.item.Goal.Required]" />
	</div>
</div>
<div class="col-md-6 pb-5">
	<div class="input-group" role="group">
		<span class="input-group-addon">Timer</span>
		<select id="timer" class="form-control selectpicker" name="data[alttp.custom.rom.timerMode]">
			<option value="off">Off</option>
			<option value="stopwatch">Stopwatch</option>
			<option value="countdown-ohko">Countdown OHKO</option>
			<option value="countdown-continue">Countdown Continue</option>
			<option value="countdown-stop">Countdown Stop</option>
		</select>
	</div>
</div>
<div class="col-md-6 pb-5">
	<div class="input-group" role="group">
		<span class="input-group-addon">Timer Start</span>
		<input type="number" class="form-control" placeholder="seconds" name="data[alttp.custom.rom.timerStart]" />
	</div>
</div>
<div class="col-md-6 pb-5">
	<div class="input-group" role="group">
		<span class="input-group-addon">Green Clock</span>
		<input type="number" class="form-control" placeholder="seconds" name="data[alttp.custom.item.value.GreenClock]" />
	</div>
</div>
<div class="col-md-6 pb-5">
	<div class="input-group" role="group">
		<span class="input-group-addon">Blue Clock</span>
		<input type="number" class="form-control" placeholder="seconds" name="data[alttp.custom.item.value.BlueClock]" />
	</div>
</div>
<div class="col-md-6 pb-5">
	<div class="input-group" role="group">
		<span class="input-group-addon">Red Clock</span>
		<input type="number" class="form-control" placeholder="seconds" name="data[alttp.custom.item.value.RedClock]" />
	</div>
</div>
<script>
$(function() {
	// Custom switch dependencies
	$('#cust-prize-shuffleCrystals, #cust-prize-shufflePendants').on('change', function() {
		if (!$(this).prop('checked')) {
			$('#cust-prize-crossworld').prop('checked', false).bootstrapToggle('off');
		}
	});
	$('#cust-prize-crossworld').on('change', function() {
		if ($(this).prop('checked')) {
			$('#cust-prize-shuffleCrystals, #cust-prize-shufflePendants').prop('checked', true).bootstrapToggle('on');
		}
	});

	$('#cust-region-bossNormalLocation').on('change', function() {
		if ($(this).prop('checked')) {
			if (!$('#cust-region-bossHeartsInPool').prop('checked')) {
				$('#cust-region-bossHeartsInPool').prop('checked', true).bootstrapToggle('on');
			}
		} else {
			$('#cust-region-bossHaveKey').prop('checked', false).bootstrapToggle('off');
		}
	});
	$('#cust-region-bossHaveKey').on('change', function() {
		if ($(this).prop('checked')) {
			if (!$('#cust-region-bossHeartsInPool').prop('checked')) {
				$('#cust-region-bossHeartsInPool').prop('checked', true).bootstrapToggle('on');
			}
			if (!$('#cust-region-bossNormalLocation').prop('checked')) {
				$('#cust-region-bossNormalLocation').prop('checked', true).bootstrapToggle('on');
			}
		}
	});

	$('#cust-region-swordsInPool').on('change', function() {
		if ($(this).prop('checked')) {
			if (!$('#cust-region-swordShuffle').prop('checked')) {
				$('#cust-region-swordShuffle').prop('checked', true).bootstrapToggle('on');
			}
		}
	});
	$('#cust-region-swordShuffle').on('change', function() {
		if (!$(this).prop('checked')) {
			if ($('#cust-region-swordsInPool').prop('checked')) {
				$('#cust-region-swordsInPool').prop('checked', false).bootstrapToggle('off');
			}
		}
	});
	$('#cust-bees').on('change', function() {
		$('#bees-label').html(($(this).prop('checked')) ? 'More Bees!' : 'The Bees!');
	});
	$('#cust-bees').trigger('change');

	localforage.getItem('vt.custom.switches').then(function(value) {
		if (value !== null) {
			for (id in value) {
				var setting = document.getElementById(id)
				setting.checked = value[id];
				$(setting).change();
			}
		}

		$('.custom-switch').on('change', function() {
			var items = {};
			$('.custom-switch').each(function(){
				items[this.id] = this.checked;
			});

			localforage.setItem('vt.custom.switches', items);
		});
	});
});
</script>
@overwrite
