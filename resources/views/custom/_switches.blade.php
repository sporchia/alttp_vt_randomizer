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
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, pendants are restricted to the light world and crystals to the dark world. If Yes, both can be in either world. Either way both are able to be randomized."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-prize-shufflePendants" type="checkbox" name="data[alttp.custom.prize.shufflePendants]"
				class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-prize-shufflePendants">Shuffle Pendants</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, pendants are as they are in the vanilla game. If Yes, pendants are shuffled."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-prize-shuffleCrystals" type="checkbox" name="data[alttp.custom.prize.shuffleCrystals]"
				class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-prize-shuffleCrystals">Shuffle Crystals</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, crystals are as they are in the vanilla game. If Yes, crystals are shuffled."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-bossNormalLocation" type="checkbox" name="data[alttp.custom.region.bossNormalLocation]"
				class="custom-switch" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-bossNormalLocation">Boss Hearts can contain Dungeon Items</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, all bosses will drop full heart containers. If Yes, bosses may drop any item."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-spoil-boots" type="checkbox" name="data[alttp.custom.spoil.BootsLocation]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-spoil-boots">Chance (5%) for boots region to be spoiled by Uncle</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="Only applies to Standard Mode. If No, Uncle will always say something random. If Yes, there is a 5% chance per seed Uncle will give a hint as to the location of the boots."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-sprite-shuffleOverworldBonkPrizes" type="checkbox" name="data[alttp.custom.sprite.shuffleOverworldBonkPrizes]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-sprite-shuffleOverworldBonkPrizes">Shuffle Overworld Bonk Prizes</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, all bonk prizes from dashing into trees will remain as they are in the vanilla game. If Yes, these prizes will be randomized."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-mapOnPickup" type="checkbox" name="data[alttp.custom.rom.mapOnPickup]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-mapOnPickup">Only display Crystals/Pendants on Map Pickup</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, the overworld map will show uncollected crystals and pendants over their respective dungeons. If Yes, the overworld map will only display uncollected crystals and pendants if Link has collected their respective maps."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-compassOnPickup" type="checkbox" name="data[alttp.custom.rom.compassOnPickup]"
				class="custom-switch" value="pickup" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-compassOnPickup">Display dungeon counts on Compass Pickup</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, compasses will behave as they do in the vanilla game. If Yes, they will additionally show how many uncollected items are left in their respective dungeons while Link is in that dungeon."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-darkroomNavigation" type="checkbox" name="data[alttp.custom.item.require.Lamp]"
				class="custom-switch" value="0" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-darkroomNavigation">Allow dark room navigation</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If yes, logic will not check to make sure lamps are available before dark rooms."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-freeItemText" type="checkbox" name="data[alttp.custom.rom.freeItemText]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-freeItemText">Show text box on dungeon item pickup (outside of dungeon)</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, keys, maps, and compasses picked up outside of dungeons will not indicate which dungeon they belong to on pickup. If Yes, a text box will be displayed on pickup that states their dungeon."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-rom-freeItemMenu" type="checkbox" name="data[alttp.custom.rom.freeItemMenu]"
				class="custom-switch" value="15" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-rom-freeItemMenu">Show dungeon item table in menu</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, the menu will behave as it does in the vanilla game. If Yes, key collection information will be displayed at the bottom of the item menu."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildCompasses" type="checkbox" name="data[alttp.custom.region.wildCompasses]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildCompasses">Compasses shuffled outside dungeon</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, compasses that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed compasses."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildMaps" type="checkbox" name="data[alttp.custom.region.wildMaps]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildMaps">Maps shuffled outside dungeon</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, maps that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed maps."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildKeys" type="checkbox" name="data[alttp.custom.region.wildKeys]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildKeys">Small Keys shuffled outside dungeon</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, small keys that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed small keys."></span>
		</div>
		<div class="col-md-6 pb-5">
			<input id="cust-region-wildBigKeys" type="checkbox" name="data[alttp.custom.region.wildBigKeys]"
				class="custom-switch" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
			<label for="cust-region-wildBigKeys">Big Keys shuffled outside dungeon</label>
			<span class="glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="If No, big keys that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed big keys."></span>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-6 pb-5">
			<span class="pull-right glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="Only applies to Triforce Hunt. The number of triforce pieces required to complete the game."></span>
			<div class="input-group" role="group">
				<span class="input-group-addon">Goal Items</span>
				<input id="custom-goal-items" type="number" class="form-control custom-value" placeholder="pieces" name="data[alttp.custom.item.Goal.Required]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<span class="pull-right glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="Sets the behavior of the in game timer. Stopwatch will count up, while countdown will count down. When the countdown timer hits 0, what happens depends on the option selected. OHKO will send Link into one hit knockout mode, and taking any damage will cause death. Continue will cause the timer to continue counting down past zero. Stop will cause the timer to stop at zero. Outside of OHKO, the value of the timer has no effect on gameplay."></span>
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
			<span class="pull-right glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="The starting value of the timer in seconds."></span>
			<div class="input-group" role="group">
				<span class="input-group-addon">Timer Start</span>
				<input id="custom-timer-start" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.rom.timerStart]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<span class="pull-right glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="The amount of time in seconds a Green Clock will add to the timer. This value can be negative."></span>
			<div class="input-group" role="group">
				<span class="input-group-addon">Green Clock</span>
				<input id="custom-green-clock" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.item.value.GreenClock]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<span class="pull-right glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="The amount of time in seconds a Blue Clock will add to the timer. The value can be negative."></span>
			<div class="input-group" role="group">
				<span class="input-group-addon">Blue Clock</span>
				<input id="custom-blue-clock" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.item.value.BlueClock]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<span class="pull-right glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="The amount of time in seconds a Red Clock will add to the timer. The value can be negative."></span>
			<div class="input-group" role="group">
				<span class="input-group-addon">Red Clock</span>
				<input id="custom-red-clock" type="number" class="form-control custom-value" placeholder="seconds" name="data[alttp.custom.item.value.RedClock]" />
			</div>
		</div>
		<div class="col-md-6 pb-5">
			<span class="pull-right glyphicon glyphicon-info-sign cust-tooltip" data-toggle="tooltip" title="The amount of rupees a Rupoor will subtract from Link's total when collected."></span>
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

	$('.cust-tooltip').tooltip();
});
</script>
@overwrite
