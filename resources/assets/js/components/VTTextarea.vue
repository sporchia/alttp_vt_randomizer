<template>
	<div>
		<div class="flex-input">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><slot></slot><sup v-if="noRace"><strong>*</strong></sup></span>
				</div>
				<textarea class="form-control no-resize" v-model="value" @input="onInput" :placeholder="placeholder" :rows="rows" :maxlength="maxlength"></textarea>
			</div>
			<span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span>

		</div>
		<h6 class="float-right mt-2">{{maxlength - value.length}} remaining</h6>
	</div>
</template>

<script>
export default {
	props: {
		noRace: {default: false},
		storageKey: {default: ''},
		placeholder: {default: ''},
		rows: {default: 5},
		maxlength: {default: 300},
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
.icon {
	vertical-align: -.9em;
}
.has-tooltip {
	cursor: help;
}
</style>
