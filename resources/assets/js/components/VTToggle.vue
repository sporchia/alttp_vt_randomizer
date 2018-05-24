<template>
	<div>
		<toggle-button v-model="value" @change="onInput" :sync="true" :width="70" :height="35"
			:labels="{checked: 'Yes', unchecked: 'No'}" color="blue"></toggle-button>
		<label @click="onClickLabel"><slot></slot><sup v-if="noRace"><strong>*</strong></sup></label>
		<span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span>
	</div>
</template>

<script>
export default {
	props: {
		noRace: {default: false},
		storageKey: {default: ''},
		selected: {default: false},
	},
	mounted () {
		localforage.getItem(this.storageKey).then(function(value) {
			if (value === null) return;
			this.value = value;
		}.bind(this));
	},
	data() {
		return {
			value: this.selected,
		};
	},
	methods: {
		onInput(input) {
			localforage.setItem(this.storageKey, this.value);
			this.$emit('change', input);
		},
		onClickLabel() {
			this.value = !this.value;
		},
	}
}
</script>

<style scoped>
.vue-js-switch {
  margin: 2px;
}
.vue-js-switch {
  font-size: 16px !important;
}
.icon {
	vertical-align: middle;
}
.has-tooltip {
	cursor: help;
}
</style>
