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
		<tabs class="think" nav-type="tabs">
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
				<settings :context="context"></settings>
			</tab>
			<tab name="Starting Equipment">
				<equipment-select v-model="equipment"></equipment-select>
			</tab>
			<tab name="Item Pool">
				<item-pool :items="settings.items" />
			</tab>
			<tab name="Location Pool">
				<location-pool :locations="settings.locations" :items="settings.items" :bottles="settings.bottles"
					:prizes="settings.prizes" :medallions="settings.medallions" />
			</tab>
		</tabs>
	</div>
</template>

<script>
import EventBus from '../core/event-bus';
import Tab from '../components/VTTab.vue';
import Tabs from '../components/VTTabs.vue';
import VTTextarea from '../components/VTTextarea.vue'
import EquipmentSelect from '../components/Customizer/EquipmentSelect.vue';
import ItemPool from '../components/Customizer/ItemPool.vue';
import LocationPool from '../components/Customizer/LocationPool.vue';
import Settings from '../components/Customizer/Settings.vue';

export default {
	components: {
		Tabs: Tabs,
		Tab: Tab,
		EquipmentSelect: EquipmentSelect,
		ItemPool: ItemPool,
		LocationPool: LocationPool,
		VtTextarea: VTTextarea,
		Settings: Settings,
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
				items: [],
				locations: [],
			},
			equipment: [],
			context: {},
			itemArrayLookup: {},
			locationPlacement: {},
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
		axios.get(`/customizer/settings`).then(response => {
			this.settings.items = response.data.items;
			this.settings.items.forEach((item, i) => {
				this.itemArrayLookup[item.value] = i;
			});
			this.settings.locations = response.data.locations;
			this.settings.prizes = response.data.prizes;
			this.settings.bottles = response.data.bottles;
			this.settings.medallions = response.data.medallions;
		});
		localforage.getItem('rom').then(function(blob) {
			if (blob == null) {
				EventBus.$emit('noBlob');
				return;
			}
			EventBus.$emit('loadBlob', {target: {files: [new Blob([blob])]}});
		});
		EventBus.$on('itemAdd', this.incrementItem);
		EventBus.$on('itemRemove', this.decrementItem);
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
					l: this.locationPlacement,
					eq: this.equipment,
					data: {
						alttp: {
							custom: {
								...this.context,
								rom: {
									HardMode: this.choice.difficulty.value,
									logicMode: this.choice.romLogic.value,
								},
								item: {
									count: this.settings.items.reduce((map, obj) => {
										if (obj.value == 'auto_fill') return map;
										map[obj.value] = obj.count;
										return map;
									}, {}),
								}
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
		incrementItem(itemName, sid, pool) {
			if (itemName === 'auto_fill') {
				delete(this.locationPlacement[sid]);
			} else {
				this.locationPlacement[sid] = itemName;
			}
			if (!pool) {
				return;
			}
			var item = this.settings.items[this.itemArrayLookup[itemName]];
			item.placed++;
			if (itemName.indexOf('Bottle') !== -1) {
				item = this.settings.items[this.itemArrayLookup['BottleWithRandom']];
			}
			if (itemName.indexOf('Shield') !== -1) {
				item = this.settings.items[this.itemArrayLookup['ProgressiveShield']];
			}
			if (itemName.indexOf('Sword') !== -1) {
				item = this.settings.items[this.itemArrayLookup['ProgressiveSword']];
			}
			if (itemName.indexOf('Mail') !== -1) {
				item = this.settings.items[this.itemArrayLookup['ProgressiveArmor']];
			}
			if (item.count > 0) {
				item.count--;
			} else {
				item.neg_count = item.neg_count ? item.neg_count - 1 : -1;
			}
		},
		decrementItem(itemName) {
			var item = this.settings.items[this.itemArrayLookup[itemName]];
			item.placed--;
			if (itemName.indexOf('Bottle') !== -1) {
				item = this.settings.items[this.itemArrayLookup['BottleWithRandom']];
			}
			if (itemName.indexOf('Shield') !== -1) {
				item = this.settings.items[this.itemArrayLookup['ProgressiveShield']];
			}
			if (itemName.indexOf('Sword') !== -1) {
				item = this.settings.items[this.itemArrayLookup['ProgressiveSword']];
			}
			if (itemName.indexOf('Mail') !== -1) {
				item = this.settings.items[this.itemArrayLookup['ProgressiveArmor']];
			}
			if (item.neg_count < 0) {
				item.neg_count++;
			} else {
				item.count++;
			}
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
		}
	},
}
</script>

<style scoped>
.think .tabs {
	position: fixed !important;
	top: 0;
}
</style>
