<template>
	<div>	
		<div v-if="rom.spoiler.meta.spoilersongenerate==true" class="spoiler-warning">{{ $t('rom.info.spoilerwarning') }}</div>
		<div v-if="rom.logic">{{ $t('rom.info.logic') }}: {{ rom.logic }}</div>
		<div v-if="rom.build">{{ $t('rom.info.build') }}: {{ rom.build }}</div>
		<div v-if="rom.difficulty">
			{{ $t('rom.info.difficulty') }}: {{ rom.difficulty }}
				<span v-if="rom.difficulty_mode && rom.difficulty_mode.toUpperCase() != rom.difficulty.toUpperCase()">({{ rom.difficulty_mode }})</span>
		</div>
		<div v-if="rom.variation">{{ $t('rom.info.variation') }}: {{ rom.variation }}</div>
		<div v-if="rom.shuffle">{{ $t('rom.info.shuffle') }}: {{ rom.shuffle }}</div>
		<div v-if="rom.mode">{{ $t('rom.info.mode') }}: {{ rom.mode }}</div>
		<div v-if="rom.weapons">{{ $t('rom.info.weapons') }}: {{ rom.weapons }}</div>
		<div v-if="rom.goal">{{ $t('rom.info.goal') }}: {{ rom.goal }}</div>
		<div v-if="!noLink && rom.hash">{{ $t('rom.info.permalink') }}: <a :href="permalink">{{ permalink }}</a></div>
		<div v-if="rom.special">{{ $t('rom.info.special') }}: {{ rom.special }}</div>
		<div v-if="rom.notes">{{ $t('rom.info.notes') }}: <span v-html="rom.notes"></span></div>
		<div v-if="rom.generated">{{ $t('rom.info.generated') }}: <timeago :since="rom.generated" :auto-update="60" :locale="$i18n.locale"></timeago></div>
	</div>
</template>

<script>
export default {
	props: [
		'rom',
		'noLink',
	],
	computed: {
		permalink: (vm) => {
			return window.location.origin + '/' + (document.documentElement.lang || 'en') + '/h/' + vm.rom.hash;
		},
	},
}
</script>

<style scoped>
.spoiler-warning {
	color: red;
  	font-weight: bold;
}
</style>