<template>
	<div>
		<div v-if="rom.logic">Logic: {{ rom.logic }}</div>
		<div v-if="rom.build">ROM build: {{ rom.build }}</div>
		<div v-if="rom.difficulty">
			Difficulty: {{ rom.difficulty }}
				<span v-if="rom.difficulty_mode">({{ rom.difficulty_mode }})</span>
		</div>
		<div v-if="rom.variation">Variation: {{ rom.variation }}</div>
		<div v-if="rom.shuffle">Shuffle: {{ rom.shuffle }}</div>
		<div v-if="rom.mode">Mode: {{ rom.mode }}</div>
		<div v-if="rom.weapons">Swords: {{ rom.weapons }}</div>
		<div v-if="rom.goal">Goal: {{ rom.goal }}</div>
		<div v-if="rom.seed">Permalink: <a :href="permalink">{{ permalink }}</a></div>
		<div v-if="rom.special">Special: {{ rom.special }}</div>
		<div v-if="rom.notes">Notes: <span v-html="rom.notes"></span></div>
		<div v-if="rom.generated">Created: <timeago :since="rom.generated" :auto-update="60"></timeago></div>
	</div>
</template>

<script>
export default {
	props: ['rom'],
	computed: {
		permalink: (vm) => {
			return window.location.origin + '/h/' + vm.rom.hash;
		},
	},
}
</script>

