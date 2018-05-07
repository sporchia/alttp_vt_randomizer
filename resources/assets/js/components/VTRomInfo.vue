<template>
	<div>
		<div v-if="rom.logic">Logic: {{ rom.logic }}</div>
		<div v-if="rom.build">ROM build: {{ rom.build }}</div>
		<div v-if="rom.difficulty">Difficulty: {{ rom.difficulty }}</div>
		<div v-if="rom.variation">Variation: {{ rom.variation }}</div>
		<div v-if="rom.shuffle">Shuffle: {{ rom.shuffle }}</div>
		<div v-if="rom.mode">Mode: {{ rom.mode }}</div>
		<div v-if="rom.weapons">Swords: {{ rom.weapons }}</div>
		<div v-if="rom.goal">Goal: {{ rom.goal }}</div>
		<div v-if="rom.seed">Seed: {{ rom.seed }}</div>
		<div v-if="rom.special">Special: {{ rom.special }}</div>
		<div v-if="rom.notes">Notes: {{ rom.notes }}</div>
	</div>
</template>

<script>
export default {
	props: ['rom'],
}
</script>

