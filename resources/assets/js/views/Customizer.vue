<template>
	<div id="customizer">
		<div v-if="error" class="alert alert-danger" role="alert">
			<button type="button" class="close" aria-label="Close">
				<img class="icon" src="/i/svg/x.svg" alt="clear" @click="error = false">
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<span class="message">{{ this.error }}</span>
		</div>
		<tabs class="think">
			<tab id="seed-generate" name="Generate">
				<vt-rom-loader v-if="!romLoaded" @update="updateRom" @error="onError"></vt-rom-loader>
				<div v-if="romLoaded" class="card border-success mb-3">
					<div class="card-header bg-success card-heading-btn">
						<h3 class="card-title text-white float-left">Customizer (v4)</h3>
						<div class="btn-toolbar float-right">
							<button class="btn btn-light border-secondary" data-toggle="collapse" href="#rom-settings">
								ROM Options <img class="icon pulse" src="/i/svg/cog.svg" alt="ROM Options">
							</button>
						</div>
					</div>
					<div class="card-body">
						<vt-rom-settings :rom="rom"></vt-rom-settings>
						<div class="row">
							<div class="col-md mb-3">
								<vt-select v-model="choice.state" id="mode-state" :options="settings.mode.states"storage-key="vt.mode.state"
									:rom="rom" :selected="choice.state">State</vt-select>
							</div>
							<div class="col-md mb-3">
								<vt-select v-model="choice.logic" id="logic" :options="settings.logics" storage-key="vt.logic"
									:rom="rom" :selected="choice.logic">Logic</vt-select>
								<div v-if="false" class="logic-warning text-danger text-right">This Logic requires knowledge of Major Glitches<sup>**</sup></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md mb-3">
								<vt-select v-model="choice.weapons" id="weapons" :options="settings.weapons" storage-key="vt.weapons"
									:rom="rom" :selected="choice.weapons">Swords</vt-select>
							</div>
							<div class="col-md mb-3">
								<vt-select v-model="choice.goal" id="goal" :options="settings.goals" storage-key="vt.goal"
									:rom="rom" :selected="choice.goal">Goal</vt-select>
							</div>
						</div>
						<div class="row">
							<div class="col-md mb-3">
								<vt-select v-model="choice.difficulty" id="difficulty" :options="settings.difficulties" storage-key="vt.difficulty"
									:rom="rom" :selected="choice.difficulty">Difficulty</vt-select>
							</div>
							<div class="col-md mb-3">
								<vt-select v-model="choice.variation" id="variation" :options="settings.variations" storage-key="vt.variation"
									:rom="rom" :selected="choice.variation">Variation</vt-select>
							</div>
						</div>
						<div class="row">
							<div class="col-md mb-3">
								<vt-text v-model="choice.seed" id="seed" placeholder="Random" maxlength="9" storage-key="vt.seed">Seed</vt-text>
							</div>
							<div class="col-md mb-3">
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md">
								<div class="btn-group btn-flex" role="group">
									<button class="btn btn-info" name="generate-tournament-rom" @click="applyTournamentSeed">Generate Race ROM (no spoilers)</button>
								</div>
							</div>
							<div class="col-md">
								<div class="btn-group btn-flex" role="group">
									<button name="generate" class="btn btn-success" @click="applySpoilerSeed">Generate ROM</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="seed-details" class="card border-info" v-if="gameLoaded && romLoaded">
					<div class="card-header text-white bg-success" :class="{'bg-info': choice.tournament}"><h3 class="card-title">Game Details</h3></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md mb-3">
								<vt-rom-info :rom="rom"></vt-rom-info>
							</div>
							<div class="col-md mb-3">
								<div class="row">
									<div class="col-md mb-3">
										<button class="btn btn-light border-secondary" @click="saveSpoiler">Save Spoiler</button>
									</div>
									<div class="col-md mb-3">
										<button class="btn btn-success" @click="saveRom">Save Rom</button>
									</div>
								</div>
							</div>
						</div>
						<vt-spoiler :rom="rom"></vt-spoiler>
					</div>
				</div>
			</tab>
			<tab name="Settings">
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
								<vt-text type="number" placeholder="seconds" maxlength="9" storage-key="vt.custom.item.Goal.Required">
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
								<vt-text type="number" placeholder="seconds" maxlength="9" storage-key="vt.custom.item.value.Rupoor">
									Rupoor Value
									<template slot="tooltip">The amount of rupees a Rupoor will subtract from Link's total when collected.</template>
								</vt-text>
							</div>
							<div class="col">
							</div>
						</div>
					</div>
				</div>
			</tab>
			<tab name="Starting Equipment">
			</tab>
		</tabs>
	</div>
</template>

<script>
import EventBus from '../core/event-bus';
import Tab from '../components/VTTab.vue';
import Tabs from '../components/VTTabs.vue';

export default {
	components: {
		Tabs: Tabs,
		Tab: Tab,
	},
	props: [
		'version',
	],
	data() {
		return {
			rom: null,
			error: false,
			generating: false,
			romLoaded: false,
			current_rom_hash: '',
			gameLoaded: false,
			choice: {
				state: {value: 'standard', name: 'Standard'},
				difficulty: {value: 'normal', name: 'Normal'},
				goal: {value: 'ganon', name: 'Defeat Ganon'},
				weapons: {value: 'uncle', name: 'Uncle Assured'},
				logic: {value: 'NoMajorGlitches', name: 'No Glitches'},
				variation: {value: 'none', name: 'None'},
				timer: {value: 'off', name: 'Off'},
				seed: null,
				tournament: false,
			},
			settings: {
				mode: {
					states: [],
				},
				logics: [],
				weapons: [],
				goals: [],
				difficulties: [],
				variations: [],
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
	created () {
		axios.get(`/randomizer/settings`).then(response => {
			this.settings.mode.states = Object.keys(response.data.modes).map(function(key) { return {value: key, name: response.data.modes[key]}});
			this.settings.logics = Object.keys(response.data.logics).map(function(key) { return {value: key, name: response.data.logics[key]}});
			this.settings.weapons = Object.keys(response.data.weapons).map(function(key) { return {value: key, name: response.data.weapons[key]}});
			this.settings.goals = Object.keys(response.data.goals).map(function(key) { return {value: key, name: response.data.goals[key]}});
			this.settings.difficulties = Object.keys(response.data.difficulties).map(function(key) { return {value: key, name: response.data.difficulties[key]}});
			this.settings.variations = Object.keys(response.data.variations).map(function(key) { return {value: key, name: response.data.variations[key]}});
		});
		axios.get(`/customizer/settings`).then(response => {
			console.log(response.data);
		});
		localforage.getItem('rom').then(function(blob) {
			EventBus.$emit('loadBlob', {target: {files: [new Blob([blob])]}});
		});
	},
	methods: {
		applySpoilerSeed() {
			this.choice.tournament = false;
			this.applySeed();
		},
		applyTournamentSeed() {
			this.choice.tournament = true;
			this.applySeed();
		},
		applySeed(e, second_attempt) {
			if (this.rom.checkMD5() != this.current_rom_hash) {
				console.log(this.rom.checkMD5(), this.current_rom_hash)
				if (second_attempt) {
					return new Promise(function(resolve, reject) {
						reject(this.rom);
					});
				}
				return this.rom.reset().then(function() {
					return this.applySeed(e, true);
				}.bind(this)).catch((error) => {
					console.log(error);
				})
			}
			return new Promise(function(resolve, reject) {
				this.gameLoaded = false;
				axios.post(`/seed` + (this.choice.seed ? '/' + this.choice.seed : ''), {
					logic: this.choice.logic.value,
					difficulty: this.choice.difficulty.value,
					variation: this.choice.variation.value,
					mode: this.choice.state.value,
					goal: this.choice.goal.value,
					weapons: this.choice.weapons.value,
					tournament: this.choice.tournament,
				}).then(response => {
					this.rom.parsePatch(response.data).then(function() {
						if (response.data.patch.current_rom_hash && response.data.patch.current_rom_hash != this.current_rom_hash) {
							// The base rom has been updated.
						}
						this.gameLoaded = true;
						resolve({rom: this.rom, patch: response.data.patch});
					}.bind(this));
				}).catch((error) => {
					if (error.response) {
						switch (error.response.status) {
							case 429:
								this.error = 'While we apprecate your want to generate a lot of games, Other people would like'
									+ ' to as well. Please come back later if you would like to generate more.';
								break;
							default:
								this.error = 'Failed Creating Seed :(';
						}
					}
				});
			}.bind(this));
		},
		saveRom() {
			return this.rom.save(this.rom.downloadFilename()+ '.sfc');
		},
		saveSpoiler() {
			return FileSaver.saveAs(new Blob([JSON.stringify(this.rom.spoiler, null, 4)]), this.rom.downloadFilename() + '.txt');
		},
		updateRom(rom, current_rom_hash) {
			if (!rom) {
				console.log(rom);
				return;
			}
			this.rom = rom;
			this.current_rom_hash = current_rom_hash;
			this.error = false;
			this.romLoaded = true;
		},
		onError(error) {
			this.error = error;
		}
	},
}
</script>
