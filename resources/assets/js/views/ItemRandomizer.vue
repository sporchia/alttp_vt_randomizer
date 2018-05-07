<template>
	<div id="seed-generate">
		<div v-if="error" class="alert alert-danger" role="alert">
			<button type="button" class="close" aria-label="Close">
				<img class="icon" src="/i/svg/x.svg" alt="clear" @click="error = false">
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<span class="message">{{ this.error }}</span>
		</div>
		<vt-rom-loader v-if="!romLoaded" @update="updateRom" @error="onError"></vt-rom-loader>
		<div v-if="romLoaded" class="card border-success mb-3">
			<div class="card-header bg-success card-heading-btn">
				<h3 class="card-title text-white float-left">Item Randomizer (v{{ version }})</h3>
				<div class="btn-toolbar float-right">
					<a class="btn btn-light border-secondary" role="button" href="/entrance/randomizer">
						Switch to Entrance Randomizer <img class="icon" src="/i/svg/share.svg" alt="Switch to Entrance Randomizer">
					</a>
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
	</div>
</template>

<script>
import EventBus from '../core/event-bus';

export default {
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
