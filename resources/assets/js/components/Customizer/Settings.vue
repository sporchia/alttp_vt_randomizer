<template>
	<div class="card border-success">
		<div class="card-header bg-success">
			<h3 class="card-title text-white">Settings</h3>
		</div>
		<div class="card-body">
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="true" storage-key="vt.custom.prize.crossWorld">
						Swap Pendants and Crystals Cross World
						<template slot="tooltip">If No, pendants are restricted to the light world and crystals to the dark world. If Yes, both can be in either world. Either way both are able to be randomized.</template>
					</vt-toggle>
				</div>
				<div class="col">
					<vt-toggle :selected="true" storage-key="vt.custom.prize.shufflePendants">
						Shuffle Pendants
						<template slot="tooltip">If No, pendants are as they are in the vanilla game. If Yes, pendants are shuffled.</template>
					</vt-toggle>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="true" storage-key="vt.custom.prize.shuffleCrystals">
						Shuffle Crystals
						<template slot="tooltip">If No, crystals are as they are in the vanilla game. If Yes, crystals are shuffled.</template>
					</vt-toggle>
				</div>
				<div class="col">
					<vt-toggle :selected="true" storage-key="vt.custom.region.bossNormalLocation">
						Boss Hearts can contain Dungeon Items
						<template slot="tooltip">If No, all bosses will drop full heart containers. If Yes, bosses may drop any item.</template>
					</vt-toggle>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.spoil.BootsLocation">
						Chance (5%) for boots region to be spoiled by Uncle
						<template slot="tooltip">Only applies to Standard Mode. If No, Uncle will always say something random. If Yes, there is a 5% chance per seed Uncle will give a hint as to the location of the boots.</template>
					</vt-toggle>
				</div>
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.sprite.shuffleOverworldBonkPrizes">
						Shuffle Overworld Bonk Prizes
						<template slot="tooltip">If No, all bonk prizes from dashing into trees will remain as they are in the vanilla game. If Yes, these prizes will be randomized.</template>
					</vt-toggle>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.rom.mapOnPickup">
						Only display Crystals/Pendants on Map Pickup
						<template slot="tooltip">If No, the overworld map will show uncollected crystals and pendants over their respective dungeons. If Yes, the overworld map will only display uncollected crystals and pendants if Link has collected their respective maps.</template>
					</vt-toggle>
				</div>
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.rom.compassOnPickup">
						Display dungeon counts on Compass Pickup
						<template slot="tooltip">If No, compasses will behave as they do in the vanilla game. If Yes, they will additionally show how many uncollected items are left in their respective dungeons while Link is in that dungeon.</template>
					</vt-toggle>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.item.require.Lamp">
						Allow dark room navigation
						<template slot="tooltip">If yes, logic will not check to make sure lamps are available before dark rooms.</template>
					</vt-toggle>
				</div>
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.rom.freeItemText">
						Show text box on dungeon item pickup
						<template slot="tooltip">If No, keys, maps, and compasses picked up outside of dungeons will not indicate which dungeon they belong to on pickup. If Yes, a text box will be displayed on pickup that states their dungeon.</template>
					</vt-toggle>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.rom.freeItemMenu">
						Show dungeon item table in menu
						<template slot="tooltip">If No, the menu will behave as it does in the vanilla game. If Yes, key collection information will be displayed at the bottom of the item menu.</template>
					</vt-toggle>
				</div>
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.region.wildCompasses">
						Compasses shuffled outside dungeon
						<template slot="tooltip">If No, compasses that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed compasses.</template>
					</vt-toggle>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.region.wildMaps">
						Maps shuffled outside dungeon
						<template slot="tooltip">If No, maps that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed maps.</template>
					</vt-toggle>
				</div>
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.region.wildKeys">
						Small Keys shuffled outside dungeon
						<template slot="tooltip">If No, small keys that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed small keys.</template>
					</vt-toggle>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-toggle :selected="false" storage-key="vt.custom.region.wildBigKeys">
						Big Keys shuffled outside dungeon
						<template slot="tooltip">If No, big keys that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed big keys.</template>
					</vt-toggle>
				</div>
				<div class="col">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row mb-3">
				<div class="col">
					<vt-text type="number" placeholder="pieces" maxlength="9" storage-key="vt.custom.item.Goal.Required">
						Goal Items
						<template slot="tooltip">Only applies to Triforce Hunt. The number of triforce pieces required to complete the game.</template>
					</vt-text>
				</div>
				<div class="col">
					<vt-select :options="settings.timers" storage-key="vt.custom.rom.timerMode" v-model="choice.timer">
						Timer
						<template slot="tooltip">Sets the behavior of the in game timer. Stopwatch will count up, while countdown will count down. When the countdown timer hits 0, what happens depends on the option selected. OHKO will send Link into one hit knockout mode, and taking any damage will cause death. Continue will cause the timer to continue counting down past zero. Stop will cause the timer to stop at zero. Outside of OHKO, the value of the timer has no effect on gameplay.</template>
					</vt-select>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-text type="number" placeholder="seconds" maxlength="9" storage-key="vt.custom.rom.timerStart">
						Timer Start
						<template slot="tooltip">The starting value of the timer in seconds.</template>
					</vt-text>
				</div>
				<div class="col">
					<vt-text type="number" placeholder="seconds" maxlength="9" storage-key="vt.custom.item.value.GreenClock">
						Green Clock
						<template slot="tooltip">The amount of time in seconds a Green Clock will add to the timer. This value can be negative.</template>
					</vt-text>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-text type="number" placeholder="seconds" maxlength="9" storage-key="vt.custom.item.value.BlueClock">
						Blue Clock
						<template slot="tooltip">The amount of time in seconds a Blue Clock will add to the timer. The value can be negative.</template>
					</vt-text>
				</div>
				<div class="col">
					<vt-text type="number" placeholder="seconds" maxlength="9" storage-key="vt.custom.item.value.RedClock">
						Red Clock
						<template slot="tooltip">The amount of time in seconds a Red Clock will add to the timer. The value can be negative.</template>
					</vt-text>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<vt-text type="number" placeholder="rupees to take away" maxlength="9" storage-key="vt.custom.item.value.Rupoor">
						Rupoor Value
						<template slot="tooltip">The amount of rupees a Rupoor will subtract from Link's total when collected.</template>
					</vt-text>
				</div>
				<div class="col">
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import EventBus from '../../core/event-bus';

export default {
	props: [
		'rom',
	],
	data() {
		return {
			error: false,
			choice: {
				timer: {value: 'off', name: 'Off'},
			},
			settings: {
				timers: [
					{value: 'off', name: 'Off'},
					{value: 'stopwatch', name: 'Stopwatch'},
					{value: 'countdown-ohko', name: 'Countdown OHKO'},
					{value: 'countdown-continue', name: 'Countdown Continue'},
					{value: 'countdown-stop', name: 'Countdown Stop'},
				],
			},
		};
	},
};
</script>
