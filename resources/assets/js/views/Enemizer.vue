<template>
	<div id="enemizer">
		<div class="card border-info mb-3">
			<div class="card-header bg-info card-heading-btn">
				<h3 class="card-title text-white float-left">Enemizer (v{{ version }})</h3>
				<div class="btn-toolbar float-right">
					<button class="btn btn-light border-secondary" @click="onClose">
						Disable Enemizer <img class="icon" src="/i/svg/x.svg" alt="XEnemizer">
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md mb-3">
						<vt-select id="enemizer-enemy_health" :options="settings.enemy_healths" storage-key="en.enemy_health"
							:rom="rom" :selected="defaults.enemy_health">Enemy Health</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-select id="enemizer-enemy_damage" :options="settings.enemy_damages" storage-key="en.enemy_damage"
							:rom="rom" :selected="defaults.enemy_damage">Enemy Damage</vt-select>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-select id="enemizer-boss" :options="settings.bosses" storage-key="en.boss"
							:rom="rom" :selected="defaults.boss">Bosses</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-toggle id="enemizer-pot_shuffle" :selected="defaults.pot_shuffle" storage-key="en.pot_shuffle"
							:rom="rom">Pot Shuffle</vt-toggle>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-toggle id="enemizer-enemy" :selected="defaults.enemy" storage-key="en.enemy"
							:rom="rom">Enemy Shuffle</vt-toggle>
					</div>
					<div class="col-md mb-3">
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: [
		'version',
		'rom',
	],
	data() {
		return {
			defaults: {
				enemy_health: {value: 0, name: 'Off'},
				enemy_damage: {value: 'off', name: 'Off'},
				boss: {value: 'off', name: 'Off'},
				pot_shuffle: false,
				enemy: true,
			},
			settings: {
				enemy_healths: [
					{value: 0, name: 'Off'},
					{value: 1, name: 'Easy (1-4 hp)'},
					{value: 2, name: 'Medium (2-15 hp)'},
					{value: 3, name: 'Hard (2-30 hp)'},
					{value: 4, name: 'Insane (4-50 hp)'},
				],
				enemy_damages: [
					{value: 'off', name: 'Off'},
					{value: 'shuffle', name: 'Shuffled'},
					{value: 'chaos', name: 'Chaos'},
					{value: 'ohko', name: 'OHKO'},
				],
				bosses: [
					{value: 'off', name: 'Off'},
					{value: 'basic', name: 'Basic'},
					{value: 'normal', name: 'Normal'},
					{value: 'chaos', name: 'Chaos'},
				],
			},
		};
	},
	methods: {
		onClose (option) {
			this.$emit('closed');
		},
	},
}
</script>
