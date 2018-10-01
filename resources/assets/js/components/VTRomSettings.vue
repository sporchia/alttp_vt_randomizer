<template>
	<div>
		<div class="row mb-3">
			<div class="col-md-12">
				<vt-select id="heart-speed" :options="settings.heartSpeeds" storage-key="rom.heart-speed"
					:rom="rom" :selected="defaults.heartSpeeds" rom-function="setHeartSpeed">{{ $t('rom.settings.heart_speed') }}</vt-select>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-12">
				<vt-sprite-select id="sprite-gfx" :rom="rom" storage-key="rom.sprite-gfx" :title="$t('rom.settings.play_as')"></vt-sprite-select>
			</div>
		</div>
		<div v-if="!rom.tournament" class="row mb-3">
			<div class="col-md-12">
				<vt-select id="menu-speed" :options="settings.menuSpeeds" storage-key="rom.menu-speed"
					:rom="rom" :selected="defaults.menuSpeeds" rom-function="setMenuSpeed">{{ $t('rom.settings.menu_speed') }}</vt-select>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-12">
				<vt-select id="heart-color" :options="settings.heartColors" storage-key="rom.heart-color"
					:rom="rom" :selected="defaults.heartColors" rom-function="setHeartColor">{{ $t('rom.settings.heart_color') }}</vt-select>
			</div>
		</div>
		<div v-if="!rom.music" class="row mb-3">
			<div class="col-md-12">
				<vt-toggle id="music-on" :selected="defaults.music" storage-key="rom.music-on"
					:rom="rom" rom-function="setMusicVolume">{{ $t('rom.settings.music') }}
					<template slot="clickable">{{$t('rom.settings.music_info')}}</template>
				</vt-toggle>
			</div>
		</div>
		<div v-if="!rom.tournament || rom.allowQuickSwap" class="row mb-3">
			<div class="col-md-12">
				<vt-toggle id="quickswap" :selected="defaults.quickswap" storage-key="rom.quickswap"
					:rom="rom" rom-function="setQuickswap">{{ $t('rom.settings.quickswap') }}</vt-toggle>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ['rom'],
	data() {
		return {
			settings: {
				heartSpeeds: [
					{value: 'off', name: this.$i18n.t('rom.settings.heart_speeds.off')},
					{value: 'double', name: this.$i18n.t('rom.settings.heart_speeds.double')},
					{value: 'normal', name: this.$i18n.t('rom.settings.heart_speeds.normal')},
					{value: 'half', name: this.$i18n.t('rom.settings.heart_speeds.half')},
					{value: 'quarter', name: this.$i18n.t('rom.settings.heart_speeds.quarter')},
				],
				menuSpeeds: [
					{value: 'instant', name: this.$i18n.t('rom.settings.menu_speeds.instant')},
					{value: 'fast', name: this.$i18n.t('rom.settings.menu_speeds.fast')},
					{value: 'normal', name: this.$i18n.t('rom.settings.menu_speeds.normal')},
					{value: 'slow', name: this.$i18n.t('rom.settings.menu_speeds.slow')},
				],
				heartColors: [
					{value: 'blue', name: this.$i18n.t('rom.settings.heart_colors.blue')},
					{value: 'green', name: this.$i18n.t('rom.settings.heart_colors.green')},
					{value: 'red', name: this.$i18n.t('rom.settings.heart_colors.red')},
					{value: 'yellow', name: this.$i18n.t('rom.settings.heart_colors.yellow')},
				],
			},
			defaults: {
				heartSpeeds: {value: 'half', name: this.$i18n.t('rom.settings.heart_speeds.half')},
				menuSpeeds: {value: 'normal', name: this.$i18n.t('rom.settings.menu_speeds.normal')},
				heartColors: {value: 'red', name: this.$i18n.t('rom.settings.heart_colors.red')},
				quickswap: false,
				music: true,
			}
		};
	},
};
</script>

