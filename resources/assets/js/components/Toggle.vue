<template>
	<div>
		<toggle-button ref="toggle" :value="value" @input="onInput" :sync="true" :width="70" :height="35"
			:labels="{checked: 'Yes', unchecked: 'No'}" color="blue"></toggle-button>
		<label @click="onClickLabel"><slot></slot><sup v-if="noRace"><strong>*</strong></sup></label>
		<span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span>
	</div>
</template>

<script>
export default {
	props: {
		noRace: {default: false},
		value: {default: false},
	},
	methods: {
		onInput(input) {
			console.log(input, this.value);
			this.$emit('input', input);
		},
		onClickLabel() {
			console.log(this.value);
			this.$emit('input', !this.value);
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
