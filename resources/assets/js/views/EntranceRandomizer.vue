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
				<h3 class="card-title text-white float-left">Entrance Randomizer (v{{ version }})</h3>
				<div class="btn-toolbar float-right">
					<a class="btn btn-light border-secondary" role="button" href="/randomizer">
						Switch to Item Randomizer <img class="icon" src="/i/svg/share.svg" alt="Switch to Item Randomizer">
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
						<vt-select v-model="choice.state" id="mode-state" :options="settings.mode.states"storage-key="er.mode.state"
							:rom="rom" :selected="choice.state">State</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-select v-model="choice.logic" id="logic" :options="settings.logics" storage-key="er.logic"
							:rom="rom" :selected="choice.logic">Logic</vt-select>
						<div v-if="false" class="logic-warning text-danger text-right">This Logic requires knowledge of Major Glitches<sup>**</sup></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-select v-model="choice.shuffle" id="weapons" :options="settings.shuffles" storage-key="er.shuffle"
							:rom="rom" :selected="choice.shuffle">Shuffle</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-select v-model="choice.goal" id="goal" :options="settings.goals" storage-key="er.goal"
							:rom="rom" :selected="choice.goal">Goal</vt-select>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-select v-model="choice.difficulty" id="difficulty" :options="settings.difficulties" storage-key="er.difficulty"
							:rom="rom" :selected="choice.difficulty">Difficulty</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-select v-model="choice.variation" id="variation" :options="settings.variations" storage-key="er.variation"
							:rom="rom" :selected="choice.variation">Variation</vt-select>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-text v-model="choice.seed" id="seed" placeholder="Random" maxlength="9" storage-key="er.seed">Seed</vt-text>
					</div>
					<div class="col-md mb-3">
						<div class="btn-group btn-flex" role="group">
							<button v-if="!enemizerEnabled" class="btn btn-light border-secondary" @click="enemizerEnabled=true">
								Enable Enemizer <img class="icon" src="/i/svg/flash.svg" alt="Enemizer">
							</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<vt-enemizer v-if="enemizerEnabled" v-model="enemizerSettings" :rom="rom" :version="enemizerVersion" @closed="enemizerEnabled=false"></vt-enemizer>
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

		<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

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
import FileSaver from 'file-saver';

export default {
	props: [
		'version',
		'enemizerVersion',
	],
	data() {
		return {
			rom: null,
			error: false,
			generating: false,
			romLoaded: false,
			enemizerEnabled: false,
			enemizerSettings: {},
			current_rom_hash: '',
			gameLoaded: false,
			choice: {
				state: {value: 'open', name: 'Open'},
				difficulty: {value: 'normal', name: 'Normal'},
				goal: {value: 'ganon', name: 'Defeat Ganon'},
				shuffle: {value: 'full', name: 'Full'},
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
				shuffles: [],
				goals: [],
				difficulties: [],
				variations: [],
			},
		};
	},
	created () {
		axios.get(`/entrance/randomizer/settings`).then(response => {
			this.settings.mode.states = Object.keys(response.data.modes).map(function(key) { return {value: key, name: response.data.modes[key]}});
			this.settings.logics = Object.keys(response.data.logics).map(function(key) { return {value: key, name: response.data.logics[key]}});
			this.settings.shuffles = Object.keys(response.data.shuffles).map(function(key) { return {value: key, name: response.data.shuffles[key]}});
			this.settings.goals = Object.keys(response.data.goals).map(function(key) { return {value: key, name: response.data.goals[key]}});
			this.settings.difficulties = Object.keys(response.data.difficulties).map(function(key) { return {value: key, name: response.data.difficulties[key]}});
			this.settings.variations = Object.keys(response.data.variations).map(function(key) { return {value: key, name: response.data.variations[key]}});
		});
		localforage.getItem('en.enabled').then(function(value) {
			if (value == null) return;
			this.enemizerEnabled = value;
		}.bind(this));
		localforage.getItem('rom').then(function(blob) {
			if (blob == null) {
				EventBus.$emit('noBlob');
				return;
			}
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
				axios.post(`/entrance/seed` + (this.choice.seed ? '/' + this.choice.seed : ''), {
					logic: this.choice.logic.value,
					difficulty: this.choice.difficulty.value,
					variation: this.choice.variation.value,
					mode: this.choice.state.value,
					goal: this.choice.goal.value,
					shuffle: this.choice.shuffle.value,
					tournament: this.choice.tournament,
					enemizer: this.enemizerEnabled ? this.enemizerSettings : false,
				}).then(response => {
					this.rom.parsePatch(response.data).then(function() {
						if (response.data.patch.current_rom_hash && response.data.patch.current_rom_hash != this.current_rom_hash) {
							// The base rom has been updated.
						}
						this.gameLoaded = true;
						EventBus.$emit('gameLoaded', this.rom);
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
	watch: {
		enemizerEnabled: function (value) {
			localforage.setItem('en.enabled', value);
		},
	},
}
</script>
