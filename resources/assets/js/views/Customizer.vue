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
		<div v-show="$store.state.loading" class="center">
			<img src="/i/loading.gif" alt="Loading..." />
			<h1>Loading...</h1>
		</div>
		<tabs v-show="!$store.state.loading" class="think" nav-type="tabs" :sticky="true">
			<tab name="Home" :selected="true">
				<div class="card border-success mb-3">
					<div class="card-header bg-success">
						<h3 class="card-title text-white">Welcome to Customizer: Just because you can, doesn't mean you should</h3>
					</div>
					<div class="card-body">
						<h2>What is this?</h2>
						<p>Customizer is an advanced interface where you have total control over item placement. If you're
							just looking to make a randomized game and get playing, head over to the <a href="/start">Start
							Playing section.</a></p>
						<h2>What can be customized?</h2>
						<ul>
							<li>Every item location can be set to a specific item, no item, or a random item.</li>
							<li>Keys, maps, and compasses can be placed outside of their dungeons.</li>
							<li>Every prize can be set to any pendant or crystal.</li>
							<li>The overall item pool for random items.</li>
							<li>Link's starting equipment.</li>
							<li>...and more!</li>
						</ul>
						<h2>How do I use this?</h2>
						<p>Simply click on one of the sections on the left hand panel.</p>
						<p>Beware! You can generate incompletable games using this. If that is your choice please don't report
							item locks generated using this tool.</p>
						<p>Here are the keys to Hyrule. Enjoy!</p>
					</div>
				</div>
			</tab>
			<tab id="seed-generate" name="Generate">
				<vt-rom-loader v-if="!romLoaded" @update="updateRom" @error="onError"></vt-rom-loader>
				<div v-if="romLoaded" class="card border-success mb-3">
					<div class="card-header bg-success card-heading-btn">
						<h3 class="card-title text-white float-left">Customizer (v4): Just because you can, doesn't mean you should</h3>
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
								<vt-select v-model="choice.state" id="mode-state" :options="settings.mode.states"storage-key="vt.custom.state"
									:rom="rom" :selected="choice.state">State</vt-select>
							</div>
							<div class="col-md mb-3">
								<vt-select v-model="choice.logic" id="logic" :options="settings.logics" storage-key="vt.custom.logic"
									:rom="rom" :selected="choice.logic">Logic</vt-select>
								<div v-if="false" class="logic-warning text-danger text-right">This Logic requires knowledge of Major Glitches<sup>**</sup></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md mb-3">
								<vt-select v-model="choice.weapons" id="weapons" :options="settings.weapons" storage-key="vt.custom.weapons"
									:rom="rom" :selected="choice.weapons">Swords</vt-select>
							</div>
							<div class="col-md mb-3">
								<vt-select v-model="choice.goal" id="goal" :options="settings.goals" storage-key="vt.custom.goal"
									:rom="rom" :selected="choice.goal">Goal</vt-select>
							</div>
						</div>
						<div class="row">
							<div class="col-md mb-3">
								<vt-text v-model="choice.name" placeholder="name this" maxlength="100" storage-key="vt.custom.name">Name</vt-text>
							</div>
							<div class="col-md mb-3">
								<vt-select v-model="choice.difficulty" id="difficulty" :options="settings.difficulties" storage-key="vt.custom.HardMode"
									:rom="rom" :selected="choice.difficulty">
									Difficulty "fixes"
								<template slot="tooltip">Will adjust drop rates, and item costs in shops.</template>
							</vt-select>
							</div>
						</div>
						<div class="row">
							<div class="col-md mb-3">
								<vt-textarea v-model="choice.notes" placeholder="game notes" storage-key="vt.custom.notes">Notes</vt-textarea>
							</div>
							<div class="col-md mb-3">
								<vt-select v-model="choice.romLogic" id="logic" :options="settings.logics" storage-key="vt.custom.rom-logic"
									:rom="rom" :selected="choice.logic">Rom "fixes"</vt-select>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md">
								<div class="btn-group btn-flex" role="group">
									<button name="generate" class="btn btn-success" @click="applySpoilerSeed">Generate ROM</button>
								</div>
							</div>
							<div class="col-md">
								<div class="btn-group btn-flex" role="group">
									<button class="btn btn-info" name="generate-tournament-rom" @click="testSpoilerSeed">Test Placements</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="seed-details" class="card border-info" v-if="gameLoaded && romLoaded">
					<div class="card-header text-white bg-success" :class="{'bg-info': choice.tournament}"><h3 class="card-title">Game Details<span v-if="rom.name">: {{rom.name}}</span></h3></div>
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
									<div v-if="this.endpoint == '/seed'" class="col-md mb-3">
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
				<settings v-if="!$store.state.loading"></settings>
			</tab>
			<tab name="Starting Equipment">
				<equipment-select v-model="equipment"></equipment-select>
			</tab>
			<tab name="Item Pool">
				<item-pool v-if="!$store.state.loading" />
			</tab>
			<tab name="Locations">
				<locations v-if="!$store.state.loading" />
			</tab>
			<tab name="Prize Pack Pool">
				<prize-pack-pool v-if="!$store.state.loading" />
			</tab>
			<tab name="Prize Packs">
				<prize-packs v-if="!$store.state.loading" />
			</tab>
			<tab name="Save/Restore">
				<div class="card border-info">
					<div class="card-header text-white bg-success">
						<h3 class="card-title">Save/Restore</h3>
					</div>
					<div class="card-body">
						<button class="btn btn-success" @click="saveSettings">Save</button>
						<label class="btn btn-info btn-file">
							Load <input type="file" accept=".json" @change="loadSettings">
						</label>
						<button class="btn btn-danger" @click="iveDoneMessedUp">Reset Everything</button>
					</div>
				</div>
			</tab>
		</tabs>
	</div>
</template>

<script>
import EquipmentSelect from '../components/Customizer/EquipmentSelect.vue';
import EventBus from '../core/event-bus';
import FileSaver from 'file-saver';
import ItemPool from '../components/Customizer/ItemPool.vue';
import Locations from '../components/Customizer/Locations.vue';
import PrizePackPool from '../components/Customizer/PrizePackPool.vue';
import PrizePacks from '../components/Customizer/PrizePacks.vue';
import Settings from '../components/Customizer/Settings.vue';
import Tab from '../components/VTTab.vue';
import Tabs from '../components/VTTabs.vue';
import VTTextarea from '../components/VTTextarea.vue';

export default {
	components: {
		EquipmentSelect: EquipmentSelect,
		ItemPool: ItemPool,
		Locations: Locations,
		PrizePackPool: PrizePackPool,
		PrizePacks: PrizePacks,
		Settings: Settings,
		Tab: Tab,
		Tabs: Tabs,
		VtTextarea: VTTextarea,
	},
	data() {
		return {
			rom: null,
			error: false,
			generating: false,
			romLoaded: false,
			current_rom_hash: '',
			gameLoaded: false,
			endpoint: '/seed',
			choice: {
				state: {value: 'standard', name: 'Standard'},
				difficulty: {value: 0, name: 'Normal'},
				goal: {value: 'ganon', name: 'Defeat Ganon'},
				weapons: {value: 'uncle', name: 'Uncle Assured'},
				logic: {value: 'NoMajorGlitches', name: 'No Glitches'},
				romLogic: {value: 'NoMajorGlitches', name: 'No Glitches'},
				variation: {value: 'none', name: 'None'},
				name: '',
				notes: '',
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
			equipment: [],
			save_restore_settings: [
				'vt.custom.drops',
				'vt.custom.equipment',
				'vt.custom.HardMode',
				'vt.custom.items',
				'vt.custom.locations',
				'vt.custom.name',
				'vt.custom.notes',
				'vt.custom.prizepacks',
				'vt.custom.settings',
				'vt.custom.rom-logic',
				'vt.custom.weapons',
				'vt.custom.goal',
				'vt.custom.logic',
				'vt.custom.state',
			],
		};
	},
	created () {
		axios.get(`/randomizer/settings`).then(response => {
			this.settings.mode.states = Object.keys(response.data.modes).map(function(key) { return {value: key, name: response.data.modes[key]}});
			this.settings.logics = Object.keys(response.data.logics).map(function(key) { return {value: key, name: response.data.logics[key]}});
			this.settings.weapons = Object.keys(response.data.weapons).map(function(key) { return {value: key, name: response.data.weapons[key]}});
			this.settings.goals = Object.keys(response.data.goals).map(function(key) { return {value: key, name: response.data.goals[key]}});
			this.settings.difficulties = Object.keys(response.data.difficulty_adjustments).map(function(key) { return {value: key, name: response.data.difficulty_adjustments[key]}});
			this.settings.variations = Object.keys(response.data.variations).map(function(key) { return {value: key, name: response.data.variations[key]}});
		});
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
			this.endpoint = '/seed';
			this.applySeed();
		},
		testSpoilerSeed() {
			this.endpoint = '/test';
			this.applySeed();
		},
		applySeed(e, second_attempt) {
			if (this.rom.checkMD5() != this.current_rom_hash) {
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
				axios.post(this.endpoint, {
					logic: this.choice.logic.value,
					difficulty: 'custom',
					variation: this.choice.variation.value,
					mode: this.choice.state.value,
					goal: this.choice.goal.value,
					weapons: this.choice.weapons.value,
					tournament: this.choice.tournament,
					name: this.choice.name,
					notes: this.choice.notes,
					l: this.locations,
					eq: this.equipment,
					drops: this.packs,
					data: {
						alttp: {
							custom: {
								...this.context,
								rom: {
									HardMode: this.choice.difficulty.value,
									logicMode: this.choice.romLogic.value,
								},
								item: {
									count: this.itemPool,
								},
								drop: {
									count: this.dropPool,
								},
							},
						},
					},
				}).then(response => {
					this.rom.parsePatch(response.data).then(function() {
						if (response.data.patch && response.data.patch.current_rom_hash && response.data.patch.current_rom_hash != this.current_rom_hash) {
							// The base rom has been updated. or test call
						}
						this.gameLoaded = true;
						EventBus.$emit('gameLoaded', this.rom);
						this.error = null;
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
			return this.rom.save(this.rom.downloadFilename() + '.sfc');
		},
		saveSpoiler() {
			return FileSaver.saveAs(new Blob([JSON.stringify(this.rom.spoiler, null, 4)]), this.rom.downloadFilename() + '.txt');
		},
		updateRom(rom, current_rom_hash) {
			if (!rom) {
				return;
			}
			this.rom = rom;
			this.current_rom_hash = current_rom_hash;
			this.error = false;
			this.romLoaded = true;
		},
		onError(error) {
			this.error = error;
		},
		saveSettings() {
			var promises = [];
			for (var i = 0; i < this.save_restore_settings.length; ++i) {
				promises.push(localforage.getItem(this.save_restore_settings[i]));
			}
			Promise.all(promises).then(values => {
				var save = {};
				for (var i = 0; i < this.save_restore_settings.length; ++i) {
					save[this.save_restore_settings[i]] = values[i];
				}
				return FileSaver.saveAs(new Blob([JSON.stringify(save)]), (this.choice.name ? this.choice.name : 'customizer') + '-settings.json');
			});
		},
		loadSettings(change) {
			var file = change.target.files[0];
			var fileReader = new FileReader();

			fileReader.onload = e => {
				try {
					var settings = JSON.parse(fileReader.result);
				} catch (e) {
					this.error = e;
					return;
				}
				var promises = [];
				for (var i = 0; i < this.save_restore_settings.length; ++i) {
					if (!settings[this.save_restore_settings[i]]) continue;
					promises.push(localforage.setItem(this.save_restore_settings[i], settings[this.save_restore_settings[i]] || null));
				}
				if (!promises.length) return onSettingsParseError();
				Promise.all(promises).then(function(values) {
					window.location.hash = '';
					window.location.reload();
				});
			}

			fileReader.readAsText(file);
		},
		iveDoneMessedUp() {
			this.$store.dispatch('nukeStore').then(() => {
				window.location.hash = '';
				window.location.reload();
			});
		},
	},
	computed: {
		itemPool () {
			return this.$store.getters['itemLocations/flatItemPool'];
		},
		dropPool () {
			return this.$store.getters['prizePacks/flatPool'];
		},
		locations () {
			return this.$store.getters['itemLocations/flatLocations'];
		},
		packs () {
			return this.$store.state.prizePacks.flatpacks;
		},
		context () {
			return this.$store.state.context.settings;
		},
	},
}
</script>

<style scoped>
.btn-file {
	margin: 0;
}
.think .tabs {
	position: fixed !important;
	top: 0;
}
</style>
