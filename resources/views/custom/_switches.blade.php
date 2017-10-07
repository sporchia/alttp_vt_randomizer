@section('switches')
<div class="col-md-6">
	<input id="cust-prize-crossworld" type="checkbox" name="data[alttp.custom.prize.crossWorld]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-prize-crossworld">Swap Pendants and Crystals Cross World</label>
</div>
<div class="col-md-6">
	<input id="cust-prize-shufflePendants" type="checkbox" name="data[alttp.custom.prize.shufflePendants]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-prize-shufflePendants">Shuffle Pendants</label>
</div>
<div class="col-md-6">
	<input id="cust-prize-shuffleCrystals" type="checkbox" name="data[alttp.custom.prize.shuffleCrystals]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-prize-shuffleCrystals">Shuffle Crystals</label>
</div>
<div class="col-md-6">
	<input id="cust-region-bossNormalLocation" type="checkbox" name="data[alttp.custom.region.bossNormalLocation]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-bossNormalLocation">Boss Hearts can contain Dungeon Items</label>
</div>
<div class="col-md-6">
	<input id="cust-region-bossHaveKey" type="checkbox" name="data[alttp.custom.region.bossHaveKey]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-bossHaveKey">Boss Hearts can contain Keys</label>
</div>
<div class="col-md-6">
	<input id="cust-region-swordShuffle" type="checkbox" name="data[alttp.custom.region.swordShuffle]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-swordShuffle">Shuffle the Swords (within themselves)</label>
</div>
<div class="col-md-6">
	<input id="cust-region-swordsInPool" type="checkbox" name="data[alttp.custom.region.swordsInPool]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-swordsInPool">Shuffle the Swords (into item pool)</label>
</div>
<div class="col-md-6">
	<input id="cust-spoil-boots" type="checkbox" name="data[alttp.custom.spoil.BootsLocation]" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-spoil-boots">Chance (5%) for boots region to be spoiled by Uncle</label>
</div>
<div class="col-md-6">
	<input id="cust-region-CompassesMaps" type="checkbox" name="data[alttp.custom.region.CompassesMaps]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-region-CompassesMaps">Dungeons Contain Compasses and Maps</label>
</div>
<div class="col-md-6">
	<input id="cust-sprite-shufflePrizePack" type="checkbox" name="data[alttp.custom.sprite.shufflePrizePack]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-sprite-shufflePrizePack">Shuffle Prize Packs</label>
</div>
<div class="col-md-6">
	<input id="cust-sprite-shuffleOverworldBonkPrizes" type="checkbox" name="data[alttp.custom.sprite.shuffleOverworldBonkPrizes]" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
	<label for="cust-sprite-shuffleOverworldBonkPrizes">Shuffle Overworld Bonk Prizes</label>
</div>
<div class="col-md-6">
	<input id="cust-bees" type="checkbox" name="data[alttp.custom.bees]" value="true" data-toggle="toggle" data-on="Yes" data-off="Not" data-size="small">
	<label id="bees-label" for="cust-bees">the Bees</label>
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
});
</script>
@overwrite
