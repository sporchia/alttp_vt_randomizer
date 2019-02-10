<template>
	<div class="card border-success">
		<div class="card-header bg-success">
			<h3 class="card-title text-white">Equipment</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="cell">
					<div class="row">
						<div class="cell">
							<div @click="incrementItem('ProgressiveArmor')"
								:class="[items.ProgressiveArmor ? 'active-' + items.ProgressiveArmor : '', {active: items.ProgressiveArmor}]"
								class="item ProgressiveArmor active"></div>
							<div @click="incrementItem('ProgressiveSword')"
								:class="[items.ProgressiveSword ? 'active-' + items.ProgressiveSword : '', {active: items.ProgressiveSword}]"
								class="item ProgressiveSword"></div>
							<div @click="incrementItem('ProgressiveShield')"
								:class="[items.ProgressiveShield ? 'active-' + items.ProgressiveShield : '', {active: items.ProgressiveShield}]"
								class="item ProgressiveShield"></div>
							<div @click="toggleItem('MoonPearl')" :class="{active: items.MoonPearl}"
								class="item MoonPearl"></div>
						</div>
					</div>
					<div class="row">
						<div class="cell"><div @click="incrementItem('Bottle1')"
							:class="[items.Bottle1 ? 'active-' + items.Bottle1 : '', {active: items.Bottle1}]"
							class="item Bottle"></div></div>
						<div class="cell"><div @click="incrementItem('Bottle2')"
							:class="[items.Bottle2 ? 'active-' + items.Bottle2 : '', {active: items.Bottle2}]"
							class="item Bottle"></div></div>
					</div>
					<div class="row">
						<div class="cell"><div @click="incrementItem('Bottle3')"
							:class="[items.Bottle3 ? 'active-' + items.Bottle3 : '', {active: items.Bottle3}]"
							class="item Bottle"></div></div>
						<div class="cell"><div @click="incrementItem('Bottle4')"
							:class="[items.Bottle4 ? 'active-' + items.Bottle4 : '', {active: items.Bottle4}]"
							class="item Bottle"></div></div>
					</div>
				</div>
				<div class="cell">
					<div class="row">
						<div class="cell"><div @click="incrementItem('ProgressiveBow')"
							:class="[items.ProgressiveBow ? 'active-' + items.ProgressiveBow : '', {active: items.ProgressiveBow}]"
							class="item ProgressiveBow"></div></div>
						<div class="cell"><div @click="incrementItem('Boomerang')"
							:class="[items.Boomerang ? 'active-' + items.Boomerang : '', {active: items.Boomerang}]"
							class="item Boomerang"></div></div>
						<div class="cell"><div @click="toggleItem('Hookshot')" :class="{active: items.Hookshot}"
							class="item Hookshot"></div></div>
						<div class="cell"><div @click="toggleItem('Mushroom')" :class="{active: items.Mushroom}"
							class="item Mushroom"></div></div>
						<div class="cell"><div @click="toggleItem('Powder')" :class="{active: items.Powder}"
							class="item Powder"></div></div>
					</div>
					<div class="row">
						<div class="cell"><div @click="toggleItem('FireRod')" :class="{active: items.FireRod}"
							class="item FireRod"></div></div>
						<div class="cell"><div @click="toggleItem('IceRod')" :class="{active: items.IceRod}"
							class="item IceRod"></div></div>
						<div class="cell"><div @click="toggleItem('Bombos')" :class="{active: items.Bombos}"
							class="item Bombos"></div></div>
						<div class="cell"><div @click="toggleItem('Ether')" :class="{active: items.Ether}"
							class="item Ether"></div></div>
						<div class="cell"><div @click="toggleItem('Quake')" :class="{active: items.Quake}"
							class="item Quake"></div></div>
					</div>
					<div class="row">
						<div class="cell"><div @click="toggleItem('Lamp')" :class="{active: items.Lamp}"
							class="item Lamp"></div></div>
						<div class="cell"><div @click="toggleItem('Hammer')" :class="{active: items.Hammer}"
							class="item Hammer"></div></div>
						<div class="cell"><div @click="toggleItem('Shovel')" :class="{active: items.Shovel}"
							class="item Shovel"></div></div>
						<div class="cell"><div @click="toggleItem('BugCatchingNet')" :class="{active: items.BugCatchingNet}"
							class="item BugCatchingNet"></div></div>
						<div class="cell"><div @click="toggleItem('BookOfMudora')" :class="{active: items.BookOfMudora}"
							class="item BookOfMudora"></div></div>
					</div>
					<div class="row">
						<div class="cell"><div class="item empty"></div></div>
						<div class="cell"><div @click="toggleItem('CaneOfSomaria')" :class="{active: items.CaneOfSomaria}"
							class="item CaneOfSomaria"></div></div>
						<div class="cell"><div @click="toggleItem('CaneOfByrna')" :class="{active: items.CaneOfByrna}"
							class="item CaneOfByrna"></div></div>
						<div class="cell"><div @click="toggleItem('Cape')" :class="{active: items.Cape}"
							class="item Cape"></div></div>
						<div class="cell"><div @click="toggleItem('MagicMirror')" :class="{active: items.MagicMirror}"
							class="item MagicMirror"></div></div>
					</div>
					<div class="row">
						<div class="cell"><div @click="toggleItem('PegasusBoots')" :class="{active: items.PegasusBoots}"
							class="item PegasusBoots"></div></div>
						<div class="cell"><div @click="incrementItem('ProgressiveGlove')"
							:class="[items.ProgressiveGlove ? 'active-' + items.ProgressiveGlove : '', {active: items.ProgressiveGlove}]"
							class="item ProgressiveGlove"></div></div>
						<div class="cell"><div @click="toggleItem('Flippers')" :class="{active: items.Flippers}"
							class="item Flippers"></div></div>
						<div class="cell"><div @click="incrementItem('Ocarina')"
							:class="[items.Ocarina ? 'active-' + items.Ocarina : '', {active: items.Ocarina}]"
							class="item Ocarina"></div></div>
						<div class="cell"><div class="item empty"></div></div>
					</div>
				</div>
				<div class="cell ml-4">
					<div class="row">
						<div class="cell w-100">
							<vue-slider ref="slider" @drag-end="saveEquipment" :min="3" :max="20" tooltip="hover" v-model="items.BossHeartContainer"></vue-slider>
						</div>
					</div>
					<div class="row">
						<div id="custom-equipment-hearts" class="cell" style="width:321px">
							<div v-for="n in items.BossHeartContainer" class="Heart" style="display:inline-block"></div>
						</div>
					</div>
					<div class="row">
						<text-field v-model="items.Rupees" type="number" style="width:321px" placeholder="amount" maxlength="4" @input="saveEquipment">
							Rupees
							<template slot="tooltip">Minimum: 0, Maximum: 9999</template>
						</text-field>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import TextField from '../TextField.vue';
import vueSlider from 'vue-slider-component';

export default {
	components: {
		TextField: TextField,
		vueSlider: vueSlider,
	},
	props: ['value'],
	data() {
		return {
			items: {
				ProgressiveArmor: 0,
				ProgressiveSword: 0,
				ProgressiveShield: 0,
				MoonPearl: false,

				ProgressiveBow: 0,
				Boomerang: 0,
				Hookshot: false,
				Mushroom: false,
				Powder: false,

				FireRod: false,
				IceRod: false,
				Bombos: false,
				Ether: false,
				Quake: false,

				Lamp: false,
				Hammer: false,
				Shovel: false,
				BugCatchingNet: false,
				BookOfMudora: false,

				Bottle1: 0,
				Bottle2: 0,
				Bottle3: 0,
				Bottle4: 0,
				CaneOfSomaria: false,
				CaneOfByrna: false,
				Cape: false,
				MagicMirror: false,

				PegasusBoots: false,
				ProgressiveGlove: 0,
				Flippers: false,
				Ocarina: 0,

				BossHeartContainer: 3,

				Rupees: 0,

				empty: false,
			}
		};
	},
	mounted () {
		localforage.getItem('vt.custom.equipment').then(value => {
			if (value === null) {
				return;
			}
			this.items = value;
		}).then(() => {
			this.$emit('input', this.selectedEq);
		});
	},
	methods: {
		counter(value, delta, max, min) {
			min = min || 0;
			value += delta;

			if (value > max) value = min;
			if (value < min) value = max;
			return value;
		},
		counters(delta, limits) {
			return function(item) {
				var max = limits[item].max,
					min = limits[item].min;

				return this.items[item] = this.counter(this.items[item], delta, max, min);
			};
		},
		increment(name) {
			var inc = this.counters(1, {
				ProgressiveArmor: { max: 2 },
				ProgressiveSword: { max: 4 },
				ProgressiveShield: { max: 3 },
				Bottle1: { max: 7 },
				Bottle2: { max: 7 },
				Bottle3: { max: 7 },
				Bottle4: { max: 7 },
				ProgressiveBow: { max: 3 },
				Boomerang: { max: 3 },
				ProgressiveGlove: { max: 2 },
				Ocarina: { max: 2 }
			}).bind(this);

			return inc(name);
		},
		incrementItem(name) {
			this.increment(name);
			this.saveEquipment();
		},
		toggleItem(name) {
			this.items[name] = !this.items[name];
			this.saveEquipment();
		},
		saveEquipment() {
			localforage.setItem('vt.custom.equipment', this.items);
			this.$emit('input', this.selectedEq);
		},

	},
	computed: {
		selectedEq () {
			var starting_equipment = [];
			var keys = Object.keys(this.items).filter(item => {
				return this.items[item];
			});
			for (var i = 0; i < keys.length; ++i) {
				if (typeof this.items[keys[i]] === 'boolean') {
					starting_equipment.push(keys[i]);
				} else if (keys[i] == 'ProgressiveBow') {
					starting_equipment.push([
						'nothing',
						'SilverArrowUpgrade',
						'Bow',
						'BowAndSilverArrows',
					][this.items[keys[i]]]);
				} else if (keys[i] == 'Boomerang') {
					switch (this.items[keys[i]]) {
						case 3: starting_equipment.push('RedBoomerang');
						case 1: starting_equipment.push('Boomerang'); break;
						case 2: starting_equipment.push('RedBoomerang'); break;
					}
				} else if (keys[i] == 'Ocarina') {
					switch (this.items[keys[i]]) {
						case 2: starting_equipment.push('OcarinaActive'); break;
						case 1: starting_equipment.push('OcarinaInactive'); break;
					}
				} else if (keys[i] == 'Rupees') {
					starting_equipment = starting_equipment.concat(this.rupees);
				} else if (keys[i].match(/^Bottle/)) {
					switch (this.items[keys[i]]) {
						case 1: starting_equipment.push('Bottle'); break;
						case 2: starting_equipment.push('BottleWithRedPotion'); break;
						case 3: starting_equipment.push('BottleWithGreenPotion'); break;
						case 4: starting_equipment.push('BottleWithBluePotion'); break;
						case 5: starting_equipment.push('BottleWithBee'); break;
						case 6: starting_equipment.push('BottleWithGoldBee'); break;
						case 7: starting_equipment.push('BottleWithFairy'); break;
					}
				} else {
					for (var j = 0; j < this.items[keys[i]]; ++j) {
						starting_equipment.push(keys[i]);
					}
				}
			}
			return starting_equipment;
		},
		rupees() {
			let rupees = [];
			let value = Math.min(Math.floor(Number(this.items.Rupees)), 9999);
			if (value < 1) {
				return rupees;
			}

			rupees = rupees.concat(Array(Math.floor(value / 300)).fill('ThreeHundredRupees'));
			value %= 300;

			rupees = rupees.concat(Array(Math.floor(value / 100)).fill('OneHundredRupees'));
			value %= 100;

			rupees = rupees.concat(Array(Math.floor(value / 50)).fill('FiftyRupees'));
			value %= 50;

			rupees = rupees.concat(Array(Math.floor(value / 20)).fill('TwentyRupees'));
			value %= 20;

			rupees = rupees.concat(Array(Math.floor(value / 5)).fill('FiveRupees'));
			value %= 5;

			rupees = rupees.concat(Array(Math.floor(value)).fill('OneRupee'));

			return rupees;
		},
		active () {
			// This hack has to do with VueSliderComponent's inability to be loaded in a v-show
			return this.$parent.isActive;
		}
	},
	watch: {
		active (val) {
			// This hack has to do with VueSliderComponent's inability to be loaded in a v-show
			if (val) {
				this.$nextTick(() => this.$refs.slider.refresh());
			}
		}
	},
};
</script>

<style scoped>
.card-body {
	background-color: #C0C0C0;
}

.row {
	margin: auto;
}
.row:before,
.row:after {
	content: " ";
	display: table;
}
.row:after {
	clear: both;
}
.cell {
	position: relative;
	float: left;
}

.ProgressiveArmor {
	width: 128px;
	height: 128px;
}
.ProgressiveSword {
	position: absolute;
	top: 12px;
	right: -8px;
}
.ProgressiveShield {
	position: absolute;
	bottom: 0;
	left: 0;
}
.MoonPearl {
	width: 48px;
	height: 48px;
	position: absolute;
	bottom: 0;
	right: 0;
}

.item {
	opacity: .25;
}
.item.active, .ProgressiveArmor {
	opacity: 1;
}

.icon {
	width: 16px;
	height: 16px;
	display: inline-block;
	background-size: 100% 100%;
	vertical-align: text-bottom;
}

.ProgressiveBow,
.ProgressiveArmor,
.ProgressiveSword,
.ProgressiveShield,
.MoonPearl,
.Boomerang,
.Hookshot,
.Mushroom,
.Powder,
.FireRod,
.IceRod,
.Bombos,
.Ether,
.Quake,
.Lamp,
.Hammer,
.Shovel,
.BugCatchingNet,
.BookOfMudora,
.Bottle,
.CaneOfSomaria,
.CaneOfByrna,
.Cape,
.MagicMirror,
.PegasusBoots,
.ProgressiveGlove,
.Flippers,
.Ocarina,
.Heart,
.empty {
	background-image: url(data:image/png;base64,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);
	background-repeat: no-repeat;
	display: block;
}
.Bombos {
	width: 64px;
	height: 64px;
	background-position: 0 0;
}

.BookOfMudora {
	width: 64px;
	height: 64px;
	background-position: -64px 0;
}

.Boomerang {
	width: 64px;
	height: 64px;
	background-position: -128px 0;
}

.Boomerang.active-2 {
	width: 64px;
	height: 64px;
	background-position: -192px 0;
}

.Boomerang.active-3 {
	width: 64px;
	height: 64px;
	background-position: -256px 0;
}

.PegasusBoots {
	width: 64px;
	height: 64px;
	background-position: -320px 0;
}

.Bottle, .Bottle.active-1 { /* empty */
	width: 64px;
	height: 64px;
	background-position: -384px 0;
}

.Bottle.active-6 { /* gold bee */
	width: 64px;
	height: 64px;
	background-position: -448px 0;
}

.Bottle.active-3 { /* blue potion */
	width: 64px;
	height: 64px;
	background-position: 0 -64px;
}

.Bottle.active-4 { /* green potion */
	width: 64px;
	height: 64px;
	background-position: -64px -64px;
}

.Bottle.active-2 { /* red potion */
	width: 64px;
	height: 64px;
	background-position: -128px -64px;
}

.Bottle.active-5 { /* bee */
	width: 64px;
	height: 64px;
	background-position: -64px -384px;
}

.Bottle.active-7 { /* fairy */
	width: 64px;
	height: 64px;
	background-position: 0 -384px;
}

.ProgressiveBow {
	width: 64px;
	height: 64px;
	background-position: -192px -64px;
}

.ProgressiveBow.active-1 {
	width: 64px;
	height: 64px;
	background-position: -256px -64px;
}

.ProgressiveBow.active-2 {
	width: 64px;
	height: 64px;
	background-position: -320px -64px;
}

.ProgressiveBow.active-3 {
	width: 64px;
	height: 64px;
	background-position: -384px -64px;
}

.CaneOfByrna {
	width: 64px;
	height: 64px;
	background-position: -448px -64px;
}

.Cape {
	width: 64px;
	height: 64px;
	background-position: 0 -128px;
}

.Ether {
	width: 64px;
	height: 64px;
	background-position: -64px -128px;
}

.FireRod {
	width: 64px;
	height: 64px;
	background-position: -128px -128px;
}

.Flippers {
	width: 64px;
	height: 64px;
	background-position: -192px -128px;
}

.Ocarina {
	width: 64px;
	height: 64px;
	background-position: -256px -128px;
}
.Ocarina.active-2 {
	width: 64px;
	height: 64px;
	background-position: -519px -128px;
}

.ProgressiveGlove {
	width: 64px;
	height: 64px;
	background-position: -320px -128px;
}

.ProgressiveGlove.active-2 {
	width: 64px;
	height: 64px;
	background-position: -384px -128px;
}

.Hammer {
	width: 64px;
	height: 64px;
	background-position: -448px -128px;
}

.Hookshot {
	width: 64px;
	height: 64px;
	background-position: 0 -192px;
}

.IceRod {
	width: 64px;
	height: 64px;
	background-position: -64px -192px;
}

.Lamp {
	width: 64px;
	height: 64px;
	background-position: -128px -192px;
}

.MagicMirror {
	width: 64px;
	height: 64px;
	background-position: -192px -192px;
}

.MoonPearl {
	width: 48px;
	height: 48px;
	background-position: -256px -192px;
}

.Mushroom {
	width: 64px;
	height: 64px;
	background-position: -304px -192px;
}

.BugCatchingNet {
	width: 64px;
	height: 64px;
	background-position: -368px -192px;
}

.Powder {
	width: 64px;
	height: 64px;
	background-position: -432px -192px;
}

.Quake {
	width: 64px;
	height: 64px;
	background-position: 0 -256px;
}

.ProgressiveShield {
	width: 64px;
	height: 64px;
	background-position: 64px 64px;
}

.ProgressiveShield.active-1 {
	width: 64px;
	height: 64px;
	background-position: -64px -256px;
}

.ProgressiveShield.active-2 {
	width: 64px;
	height: 64px;
	background-position: -128px -256px;
}

.ProgressiveShield.active-3 {
	width: 64px;
	height: 64px;
	background-position: -192px -256px;
}

.Shovel {
	width: 64px;
	height: 64px;
	background-position: -256px -256px;
}

.CaneOfSomaria {
	width: 64px;
	height: 64px;
	background-position: -320px -256px;
}

.ProgressiveSword {
	width: 64px;
	height: 64px;
	background-position: 64px 64px;
}

.ProgressiveSword.active-1 {
	width: 64px;
	height: 64px;
	background-position: -384px -256px;
}

.ProgressiveSword.active-2 {
	width: 64px;
	height: 64px;
	background-position: -448px -256px;
}

.ProgressiveSword.active-3 {
	width: 64px;
	height: 64px;
	background-position: 0 -320px;
}

.ProgressiveSword.active-4 {
	width: 64px;
	height: 64px;
	background-position: -64px -320px;
}

.ProgressiveArmor {
	width: 128px;
	height: 128px;
	background-position: -128px -320px;
}

.ProgressiveArmor.active-1 {
	width: 128px;
	height: 128px;
	background-position: -256px -320px;
}

.ProgressiveArmor.active-2 {
	width: 128px;
	height: 128px;
	background-position: -384px -320px;
}

.Heart {
	width: 32px;
	height: 32px;
	background-position: -518px 0px;
}

#health-slider {
	width: 300px;
	margin: 0 10px 10px 10px;
}

.empty {
	width: 64px;
	height: 64px;
	background-position: 64px 64px;
}
</style>
