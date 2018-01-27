@section('switches')
<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Settings</h3>
	</div>
	<div class="panel-body">
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
			<input id="cust-spoil-boots" type="checkbox" name="data[alttp.custom.spoil.BootsLocation]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-spoil-boots">Chance (5%) for boots region to be spoiled by Uncle</label>
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
			<input id="cust-rom-mapOnPickup" type="checkbox" name="data[alttp.custom.rom.mapOnPickup]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-mapOnPickup">Only display Crystals/Pendants on Map Pickup</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-compassOnPickup" type="checkbox" name="data[alttp.custom.rom.compassOnPickup]"
				class="custom-switch" value="pickup" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-compassOnPickup">Display dungeon counts on Compass Pickup</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-freeItemText" type="checkbox" name="data[alttp.custom.rom.freeItemText]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-freeItemText">Show text box on dungeon item pickup (outside of dungeon)</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-freeItemMenu" type="checkbox" name="data[alttp.custom.rom.freeItemMenu]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-freeItemMenu">Show dungeon item table in menu</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildCompasses" type="checkbox" name="data[alttp.custom.region.wildCompasses]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildCompasses">Compasses shuffled outside dungeon</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildMaps" type="checkbox" name="data[alttp.custom.region.wildMaps]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildMaps">Maps shuffled outside dungeon</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildKeys" type="checkbox" name="data[alttp.custom.region.wildKeys]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildKeys">Small Keys shuffled outside dungeon</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildBigKeys" type="checkbox" name="data[alttp.custom.region.wildBigKeys]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildBigKeys">Big Keys shuffled outside dungeon</label>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-bees" type="checkbox" name="data[alttp.custom.bees]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="Not" data-size="small">
			<label id="bees-label" for="cust-bees">the Bees</label>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Goal Items</span>
				<input id="custom-goal-items" type="number" class="form-control custom-value" placeholder="pieces" name="data[alttp.custom.item.Goal.Required]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Timer</span>
				<select id="custom-timer" class="form-control custom-value selectpicker" name="data[alttp.custom.rom.timerMode]">
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
				<span class="input-group-addon">Reachability</span>
				<select id="custom-reachability" class="form-control custom-value selectpicker" name="data[alttp.custom.region.reachability]">
					<option value="random">Random</option>
					<option value="full-clear">Full Clear</option>
				</select>
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Timer Start</span>
				<input id="custom-timer-start" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.rom.timerStart]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Green Clock</span>
				<input id="custom-green-clock" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.item.value.GreenClock]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Blue Clock</span>
				<input id="custom-blue-clock" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.item.value.BlueClock]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Red Clock</span>
				<input id="custom-red-clock" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.item.value.RedClock]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<div class="input-group" role="group">
				<span class="input-group-addon">Rupoor Value</span>
				<input id="custom-rupoor-deduct" type="number" class="form-control custom-value" placeholder="rupees" name="data[alttp.custom.item.value.Rupoor]" />
			</div>
		</div>
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

	$('#cust-bees').on('change', function() {
		$('#bees-label').html(($(this).prop('checked')) ? 'More Bees!' : 'The Bees!');
	});
	$('#cust-bees').trigger('change');

	localforage.getItem('vt.custom.switches').then(function(value) {
		if (value !== null) {
			for (id in value) {
				var setting = document.getElementById(id);
				if (!setting) continue;
				setting.checked = value[id];
				$(setting).change();
			}
		}

		$('.custom-switch').on('change', function() {
			var items = {};
			$('.custom-switch').each(function() {
				items[this.id] = this.checked;
			});

			localforage.setItem('vt.custom.switches', items);
		});
	});

	localforage.getItem('vt.custom.settings').then(function(value) {
		if (value !== null) {
			for (id in value) {
				var setting = $('#' + id)
				setting.val(value[id]);
				setting.trigger('change');
			}
		}

		$('.custom-value').on('change', function() {
			var values = {};
			$('.custom-value').each(function() {
				var $this = $(this);
				if (!$this.attr('id')) return;
				values[$this.attr('id')] = $this.val();
			});

			localforage.setItem('vt.custom.settings', values);
		});
	});

});
</script>
@overwrite
