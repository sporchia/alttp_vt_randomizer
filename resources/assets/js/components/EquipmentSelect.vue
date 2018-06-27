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
						<div @click="toggleItem" class="equipment item ProgressiveArmor active" data-item="ProgressiveArmor"></div>
						<div @click="toggleItem" class="equipment item ProgressiveSword" data-item="ProgressiveSword"></div>
						<div @click="toggleItem" class="equipment item ProgressiveShield" data-item="ProgressiveShield"></div>
						<div @click="toggleItem" class="equipment item MoonPearl" data-item="MoonPearl"></div>
					</div>
				</div>
				<div class="row">
					<div class="cell"><div @click="toggleItem" class="equipment item Bottle1 Bottle" data-item="Bottle1"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Bottle2 Bottle" data-item="Bottle2"></div></div>
				</div>
				<div class="row">
					<div class="cell"><div @click="toggleItem" class="equipment item Bottle3 Bottle" data-item="Bottle3"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Bottle4 Bottle" data-item="Bottle4"></div></div>
				</div>
			</div>
			<div class="cell">
				<div class="row">
					<div class="cell"><div @click="toggleItem" class="equipment item ProgressiveBow" data-item="ProgressiveBow"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Boomerang" data-item="Boomerang"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Hookshot" data-item="Hookshot"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Mushroom" data-item="Mushroom"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Powder" data-item="Powder"></div></div>
				</div>
				<div class="row">
					<div class="cell"><div @click="toggleItem" class="equipment item FireRod" data-item="FireRod"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item IceRod" data-item="IceRod"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Bombos" data-item="Bombos"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Ether" data-item="Ether"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Quake" data-item="Quake"></div></div>
				</div>
				<div class="row">
					<div class="cell"><div @click="toggleItem" class="equipment item Lamp" data-item="Lamp"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Hammer" data-item="Hammer"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Shovel" data-item="Shovel"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item BugCatchingNet" data-item="BugCatchingNet"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item BookOfMudora" data-item="BookOfMudora"></div></div>
				</div>
				<div class="row">
					<div class="cell"><div @click="toggleItem" class="equipment item empty"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item CaneOfSomaria" data-item="CaneOfSomaria"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item CaneOfByrna" data-item="CaneOfByrna"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Cape" data-item="Cape"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item MagicMirror" data-item="MagicMirror"></div></div>
				</div>
				<div class="row">
					<div class="cell"><div @click="toggleItem" class="equipment item PegasusBoots" data-item="PegasusBoots"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item ProgressiveGlove" data-item="ProgressiveGlove"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item Flippers" data-item="Flippers"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item OcarinaInactive" data-item="OcarinaInactive"></div></div>
					<div class="cell"><div @click="toggleItem" class="equipment item empty"></div></div>
				</div>
			</div>
			<div class="cell">
				<div class="row">
					<div class="cell">
						<input id="equipped-health" type="text" value="3" />
					</div>
				</div>
				<div class="row">
					<div id="custom-equipment-hearts" class="cell" style="width:321px"></div>
				</div>
			</div>
		</div>
		</div>
	</div>
</template>

<script>
export default {
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
				OcarinaInactive: false,

				BossHeartContainer: 3,

				empty: false,
			}
		};
	},
	mounted () {
		/*
		localforage.getItem('vt.custom.equipment').then(function(value) {
			if (value !== null) {
				for (id in value) {
					var inc = value[id];

					if (id == 'BossHeartContainer') {
						this.updateHealth(inc);
						continue;
					}
					if (typeof inc === 'boolean') {
						inc = inc ? 1 : 0;
					}
					for (var i = 0; i < inc; ++i) {
						this.toggleItem($('#equipment-selector .' + id)[0]);
					}
				}
			}

			var starting_hearts = (value !== null) ? value.BossHeartContainer : 3
			$("#equipped-health").slider({id: 'health-slider', step: 1, min: 1, max: 20, value: starting_hearts});
			$("#equipped-health").on("slide", function(slideEvt) {
				this.updateHealth(slideEvt.value);
				items.BossHeartContainer = slideEvt.value;
				localforage.setItem('vt.custom.equipment', items);
			});
			this.updateHealth(starting_hearts);
		});
*/
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

				return items[item] = counter(items[item], delta, max, min);
			};
		},
		increment(name) {
			var inc = counters(1, {
				ProgressiveArmor: { max: 2 },
				ProgressiveSword: { max: 4 },
				ProgressiveShield: { max: 3 },
				Bottle1: { max: 7 },
				Bottle2: { max: 7 },
				Bottle3: { max: 7 },
				Bottle4: { max: 7 },
				ProgressiveBow: { max: 3 },
				Boomerang: { max: 3 },
				ProgressiveGlove: { max: 2 }
			});

			return inc(name);
		},
		toggleItem(target) {
			var name = this.itemName(target.classList);
			if ((typeof items[name]) === 'boolean') {
				items[name] = !items[name];
				target.classList[items[name] ? 'add' : 'remove']('active');
			} else {
				var value = this.increment(name);
				target.className = target.className.replace(/ ?active-\w+/, '');
				if (value) {
					target.classList.add('active');
					target.classList.add('active-' + value);
				} else {
					target.classList.remove('active');
				}
			}
		},
		itemName(class_list) {
			var terms = ['item', 'active', 'equipment'];
			return Array.from(class_list).filter(function(x) { return !(terms.includes(x) || x.match(/^active-/)); })[0];
		},
		updateHealth(hearts) {
			$('#custom-equipment-hearts').html('');
			for (var i = 0; i < hearts; ++i) {
				$('#custom-equipment-hearts').append($('<div class="Heart" style="display:inline-block"></div>'));
			}
		},
	}
};
</script>

<style scoped>
#equipment-selector {
	background-color: #C0C0C0;
}

#tracker .row {
	margin: auto;
}
#tracker .row:before,
#tracker .row:after {
	content: " ";
	display: table;
}
#tracker .row:after {
	clear: both;
}
#tracker .cell {
	position: relative;
	float: left;
}

#tracker .ProgressiveArmor {
	width: 128px;
	height: 128px;
}
#tracker .ProgressiveSword {
	position: absolute;
	top: 12px;
	right: -8px;
}
#tracker .ProgressiveShield {
	position: absolute;
	bottom: 0;
	left: 0;
}
#tracker .MoonPearl {
	width: 48px;
	height: 48px;
	position: absolute;
	bottom: 0;
	right: 0;
}

#tracker {
	.item {
		opacity: .25;
	}
	.item.active, .ProgressiveArmor {
		opacity: 1;
	}
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
.OcarinaInactive,
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

.Bottle, .Bottle.active-1 { // empty
	width: 64px;
	height: 64px;
	background-position: -384px 0;
}

.Bottle.active-6 { // gold bee
	width: 64px;
	height: 64px;
	background-position: -448px 0;
}

.Bottle.active-3 { // blue potion
	width: 64px;
	height: 64px;
	background-position: 0 -64px;
}

.Bottle.active-4 { // green potion
	width: 64px;
	height: 64px;
	background-position: -64px -64px;
}

.Bottle.active-2 { // red potion
	width: 64px;
	height: 64px;
	background-position: -128px -64px;
}

.Bottle.active-5 { // bee
	width: 64px;
	height: 64px;
	background-position: -64px -384px;
}

.Bottle.active-7 { // fairy
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

.OcarinaInactive {
	width: 64px;
	height: 64px;
	background-position: -256px -128px;
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
