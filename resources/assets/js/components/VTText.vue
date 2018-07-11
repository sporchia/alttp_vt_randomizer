<template>
	<div class="flex-input">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><slot></slot><sup v-if="noRace"><strong>*</strong></sup></span>
			</div>
			<input :type="type" v-model="value" @input="onInput" :maxlength="maxlength" :placeholder="placeholder"
				class="form-control"></input>
			<div class="input-group-append">
				<span class="input-group-text" @click="onClear"><img class="icon" src="/i/svg/x.svg" alt="clear"></span>
			</div>
		</div>
		<span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span>
	</div>
</template>

<script>
export default {
	props: {
		noRace: {default: false},
		storageKey: {default: ''},
		placeholder: {default: ''},
		maxlength: {default: false},
		type: {default: 'text'},
	},
	mounted () {
		localforage.getItem(this.storageKey).then(function(value) {
			if (value === null) return;
			this.value = value;
			this.$emit('input', this.value);
		}.bind(this));
	},
	data() {
		return {
			value: '',
		};
	},
	methods: {
		onInput(input) {
			localforage.setItem(this.storageKey, this.value);
			this.$emit('input', this.value);
		},
		onClear() {
			this.value = '';
			this.onInput();
		}
	}
}
</script>

<style scoped>
.flex-input {
	display: flex;
	flex-direction: row;
}
.input-group {
	height: 42px;
}
.icon {
	vertical-align: -.9em;
}
.has-tooltip {
	cursor: help;
}
</style>
