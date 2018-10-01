<template>
	<div id="enemizer">
		<div class="card border-info mb-3">
			<div class="card-header bg-info card-heading-btn">
				<h3 class="card-title text-white float-left">{{ $t('enemizer.title') }} (v{{ version }})</h3>
				<div class="btn-toolbar float-right">
					<button class="btn btn-light border-secondary" @click="onClose">
						{{ $t('enemizer.disable') }} <img class="icon" src="/i/svg/x.svg" alt="XEnemizer">
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md mb-3">
						<vt-select :value="value.bosses" @input="value.bosses = $event.value"
							id="enemizer-boss" :options="settings.bosses" storage-key="en.boss"
							:rom="rom" :selected="defaults.boss">{{ $t('enemizer.bosses.title') }}</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-toggle v-model="value.pot_shuffle" id="enemizer-pot_shuffle" :selected="defaults.pot_shuffle"
							storage-key="en.pot_shuffle" :rom="rom">{{ $t('enemizer.pot_shuffle') }}</vt-toggle>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-select :value="value.enemy_damage" @input="value.enemy_damage = $event.value"
							id="enemizer-enemy_damage" :options="settings.enemy_damages" storage-key="en.enemy_damage"
							:rom="rom" :selected="defaults.enemy_damage">{{ $t('enemizer.enemy_damage.title') }}</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-toggle v-model="value.palette_shuffle" id="enemizer-palette_shuffle" :selected="defaults.palette_shuffle"
							storage-key="en.palette_shuffle" :rom="rom">{{ $t('enemizer.palette_shuffle') }}</vt-toggle>
					</div>
				</div>
				<div class="row">
					<div class="col-md mb-3">
						<vt-select v-if="restrictedSettings" :value="value.enemy_health" @input="value.enemy_health = $event.value"
							id="enemizer-enemy_health" :options="settings.enemy_healths" storage-key="en.enemy_health"
							:rom="rom" :selected="defaults.enemy_health">{{ $t('enemizer.enemy_health.title') }}</vt-select>
					</div>
					<div class="col-md mb-3">
						<vt-toggle v-if="restrictedSettings" v-model="value.enemy" id="enemizer-enemy" :selected="defaults.enemy" storage-key="en.enemy"
							:rom="rom">{{ $t('enemizer.enemy_shuffle') }}</vt-toggle>
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
		'value',
		'restrictedSettings',
	],
	data() {
		return {
			defaults: {
				enemy_health: {value: 0, name: this.$i18n.t('enemizer.enemy_health.options.0')},
				enemy_damage: {value: 'off', name: this.$i18n.t('enemizer.enemy_damage.options.off')},
				boss: {value: 'off', name: this.$i18n.t('enemizer.bosses.options.off')},
				pot_shuffle: false,
				palette_shuffle: false,
				enemy: true,
			},
			settings: {
				enemy_healths: [
					{value: 0, name: this.$i18n.t('enemizer.enemy_health.options.0')},
					{value: 1, name: this.$i18n.t('enemizer.enemy_health.options.1')},
					{value: 2, name: this.$i18n.t('enemizer.enemy_health.options.2')},
					{value: 3, name: this.$i18n.t('enemizer.enemy_health.options.3')},
					{value: 4, name: this.$i18n.t('enemizer.enemy_health.options.4')},
				],
				enemy_damages: [
					{value: 'off', name: this.$i18n.t('enemizer.enemy_damage.options.off')},
					{value: 'shuffle', name: this.$i18n.t('enemizer.enemy_damage.options.shuffle')},
					{value: 'chaos', name: this.$i18n.t('enemizer.enemy_damage.options.chaos')},
				],
				bosses: [
					{value: 'off', name: this.$i18n.t('enemizer.bosses.options.off')},
					{value: 'basic', name: this.$i18n.t('enemizer.bosses.options.basic')},
					{value: 'normal', name: this.$i18n.t('enemizer.bosses.options.normal')},
					{value: 'chaos', name: this.$i18n.t('enemizer.bosses.options.chaos')},
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
