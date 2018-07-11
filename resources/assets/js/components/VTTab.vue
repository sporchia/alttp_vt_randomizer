<template>
	<div v-show="isActive"><slot></slot></div>
</template>

<script>
export default {
	props: {
		name: { required: true },
		selected: { default: false },
		count: {default: ''},
	},
	data() {
		return {
			isActive: false
		};
	},
	mounted() {
		this.isActive = this.selected;
	},
	computed: {
		href() {
			return '#' + this.name.toLowerCase().replace(/ /g, '-');
		}
	},
}
</script>
