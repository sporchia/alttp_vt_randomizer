<template>
	<div id="seed-generate">
		<div v-if="error" class="alert alert-danger" role="alert">
			<button type="button" class="close" aria-label="Close">
				<img class="icon" src="/i/svg/x.svg" alt="clear" @click="error = false">
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">{{ $t('error.title') }}:</span>
			<span class="message">{{ this.error }}</span>
		</div>
		<vt-rom-loader v-if="!romLoaded" @update="updateRom" @error="onError"></vt-rom-loader>
		<div v-if="romLoaded" class="card border-success mb-3">
			<div class="card-header bg-success card-heading-btn">
				<h3 class="card-title text-white float-left">{{ $t('randomizer.title') }} (v{{ version }})</h3>
				<div class="btn-toolbar float-right">
					<a class="btn btn-light border-secondary" role="button" :href="'/' + $i18n.locale + '/entrance/randomizer'">
						{{ $t('randomizer.switch.entrance') }} <img class="icon" src="/i/svg/share.svg" alt="Switch to Entrance Randomizer">
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md mb-3">
						<vt-select v-model="choice.state" id="mode-state" :options="settings.mode.states" storage-key="vt.mode.state"
							:rom="rom" :selected="choice.state">{{ $t('randomizer.mode.title') }}</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-select v-model="choice.logic" id="logic" :options="settings.logics" storage-key="vt.logic"
							:rom="rom" :selected="choice.logic">{{ $t('randomizer.logic.title') }}</vt-select>
						<div v-if="choice.logic.value != 'NoGlitches'" class="logic-warning text-danger text-right" v-html="$t('randomizer.logic.glitch_warning')" />
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-select v-model="choice.weapons" id="weapons" :options="settings.weapons" storage-key="vt.weapons"
							:rom="rom" :selected="choice.weapons">{{ $t('randomizer.weapons.title') }}</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-select v-model="choice.goal" id="goal" :options="settings.goals" storage-key="vt.goal"
							:rom="rom" :selected="choice.goal">{{ $t('randomizer.goal.title') }}</vt-select>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-select v-model="choice.difficulty" id="difficulty" :options="settings.difficulties" storage-key="vt.difficulty"
							:rom="rom" :selected="choice.difficulty">{{ $t('randomizer.difficulty.title') }}</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-select v-model="choice.variation" id="variation" :options="settings.variations" storage-key="vt.variation"
							:rom="rom" :selected="choice.variation">{{ $t('randomizer.variation.title') }}</vt-select>
					</div>
				</div>
				<div v-if="!enemizerEnabled"  class="row">
					<div class="col-md mb-3">
					</div>
					<div class="col-md mb-3">
						<div class="btn-group btn-flex" role="group">
							<button class="btn btn-light border-secondary" @click="enemizerEnabled=true">
								{{ $t('enemizer.enable') }} <img class="icon" src="/i/svg/flash.svg" alt="Enemizer">
							</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<vt-enemizer v-if="enemizerEnabled" v-model="enemizerSettings" :restrictedSettings="enemizerRestricted" :rom="rom" :version="enemizerVersion" @closed="enemizerEnabled=false"></vt-enemizer>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-md">
						<div class="btn-group btn-flex" role="group">
							<button class="btn btn-primary w-50 text-center" v-tooltip="$t('randomizer.generate.race_warning')" name="generate-tournament-rom" @click="applyTournamentSeed">
								{{ $t('randomizer.generate.race') }}
							</button>
							<button class="btn btn-info w-50 text-center" name="generate-tournament-rom" @click="applyTournamentSpoilerSeed">
								{{ $t('randomizer.generate.spoiler_race') }}
							</button>
						</div>
					</div>
					<div class="col-md">
						<div class="btn-group btn-flex" role="group">
							<button name="generate" class="btn btn-success text-center" @click="applySpoilerSeed">
								{{ $t('randomizer.generate.casual') }}
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

		<div id="seed-details" class="card border-info mt-3" v-if="gameLoaded && romLoaded">
			<div class="card-header text-white bg-success" :class="{'bg-info': choice.tournament}"><h3 class="card-title">{{ $t('randomizer.details.title') }}</h3></div>
			<div class="card-body">
				<div class="row">
					<div class="col-md mb-3">
						<vt-rom-info :rom="rom"></vt-rom-info>
					</div>
					<div class="col-md mb-3">
						<div class="row">
							<div class="col-md-6 mb-3">
								<div class="btn-group btn-flex" role="group" v-if="this.rom">
									<button class="btn btn-light border-secondary text-center" @click="saveSpoiler">{{ $t('randomizer.details.save_spoiler') }}</button>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="btn-group btn-flex" role="group" v-if="this.rom">
									<button class="btn btn-success text-center" @click="saveRom">{{ $t('randomizer.details.save_rom') }}</button>
								</div>
							</div>
						</div>
						<div class="row">
							<vt-rom-settings class="col-12" :rom="rom"></vt-rom-settings>
						</div>
					</div>
				</div>
				<vt-spoiler v-model="show_spoiler" :rom="rom"></vt-spoiler>
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
			show_spoiler: false,
			choice: {
				state: {value: 'standard', name: this.$i18n.t('randomizer.mode.options.standard')},
				difficulty: {value: 'normal', name: this.$i18n.t('randomizer.difficulty.options.normal')},
				goal: {value: 'ganon', name: this.$i18n.t('randomizer.goal.options.ganon')},
				weapons: {value: 'uncle', name: this.$i18n.t('randomizer.weapons.options.uncle')},
				logic: {value: 'NoGlitches', name: this.$i18n.t('randomizer.logic.options.NoGlitches')},
				variation: {value: 'none', name: this.$i18n.t('randomizer.variation.options.none')},
				tournament: false,
				spoilers: false,
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
			this.settings.mode.states = Object.keys(response.data.modes).map(key => { return {value: key, name: this.$i18n.t('randomizer.mode.options.' + key)}});
			this.settings.logics = Object.keys(response.data.logics).map(key => { return {value: key, name: this.$i18n.t('randomizer.logic.options.' + key)}});
			this.settings.weapons = Object.keys(response.data.weapons).map(key => { return {value: key, name: this.$i18n.t('randomizer.weapons.options.' + key)}});
			this.settings.goals = Object.keys(response.data.goals).map(key => { return {value: key, name: this.$i18n.t('randomizer.goal.options.' + key)}});
			this.settings.difficulties = Object.keys(response.data.difficulties).map(key => { return {value: key, name: this.$i18n.t('randomizer.difficulty.options.' + key)}});
			this.settings.variations = Object.keys(response.data.variations).map(key => { return {value: key, name: this.$i18n.t('randomizer.variation.options.' + key)}});
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
			this.choice.spoilers = false;
			this.applySeed();
		},
		applyTournamentSeed() {
			this.choice.tournament = true;
			this.choice.spoilers = false;
			this.applySeed();
		},
		applyTournamentSpoilerSeed() {
			this.choice.tournament = true;
			this.choice.spoilers = true;
			this.applySeed();
		},
		applySeed(e, second_attempt) {
			this.error = false;
			if (this.rom.checkMD5() != this.current_rom_hash) {
				if (second_attempt) {
					return new Promise((resolve, reject) => {
						reject(this.rom);
					});
				}
				return this.rom.reset().then(() => {
					return this.applySeed(e, true);
				}).catch(error => {
					console.error(error);
				})
			}
			return new Promise(function(resolve, reject) {
				this.gameLoaded = false;
				axios.post(`/seed`, {
					logic: this.choice.logic.value,
					difficulty: this.choice.difficulty.value,
					variation: this.choice.variation.value,
					mode: this.choice.state.value,
					goal: this.choice.goal.value,
					weapons: this.choice.weapons.value,
					tournament: this.choice.tournament,
					spoilers: this.choice.spoilers,
					enemizer: this.enemizerEnabled ? this.enemizerSettings : false,
					lang: document.documentElement.lang,
				}).then(response => {
					let prom;
					if (this.rom.checkMD5() != this.current_rom_hash) {
						prom = this.rom.reset().then(() => {
							if (this.rom.checkMD5() != this.current_rom_hash) {
								return new Promise((resolve, reject) => {
									reject(this.rom);
								});
							}
							return this.rom.parsePatch(response.data);
						});
					} else {
						prom = this.rom.parsePatch(response.data);
					}
					prom.then(function() {
						if (response.data.current_rom_hash && response.data.current_rom_hash != this.current_rom_hash) {
							// The base rom has been updated.
							window.location.reload(true);
						}
						this.gameLoaded = true;
						EventBus.$emit('gameLoaded', this.rom);
						resolve({rom: this.rom, patch: response.data.patch});
					}.bind(this));
				}).catch((error) => {
					if (error.response) {
						switch (error.response.status) {
							case 429:
								this.error =  this.$i18n.t('error.429');
								break;
							default:
								this.error = this.$i18n.t('error.failed_generation');
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
	computed: {
		enemizerRestricted() {
			return this.choice.state.value !== 'standard';
		},
	},
	watch: {
		enemizerEnabled: function (value) {
			localforage.setItem('en.enabled', value);
		},
	},
}
</script>
