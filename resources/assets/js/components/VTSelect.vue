<template>
	<div class="input-group" role="group">
		<div v-if="$slots.default" class="input-group-prepend">
			<span class="input-group-text"><slot></slot><sup v-if="noRace"><strong>*</strong></sup></span>
		</div>
		<multiselect class="form-control" v-model="value" :options="options" :show-labels="false" :allow-empty="false"
			:custom-label="customLabel" :placeholder="placeholder" @select="onSelect"></multiselect>
		<span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text"><img class="icon" src="/i/svg/info.svg" alt="tooltip"></span>
	</div>
</template>

<script>
export default {
	components: {
		Multiselect: Multiselect.default
	},
	props: {
		options: {default: () => []},
		selected: {default: null},
		noRace: {default: false},
		storageKey: {default: ''},
		romFunction: {default: null},
		placeholder: {default: 'Select option'},
		rom: {default : null},
	},
	mounted () {
		if (!this.storageKey) return;
		localforage.getItem(this.storageKey).then(function(value) {
			if (value === null) return;
			for (var i in this.options) {
				if (this.options[i].value == value) {
					this.value = this.options[i];
					break;
				}
			}
		}.bind(this)).then(function() {
			this.onSelect(this.value);
		}.bind(this));
	},
	data() {
		return {
			value: this.selected,
		};
	},
	methods: {
		customLabel (option) {
			return `${option.name}`;
		},
		onSelect (option) {
			if (this.storageKey) {
				localforage.setItem(this.storageKey, option.value);
			}
			if (this.rom && this.romFunction) {
				this.rom[this.romFunction](option.value);
			}
			this.$emit('select', option);
			this.$emit('input', option);
		}
	}
}
</script>

<style>
.multiselect__option--highlight.multiselect__option--selected {
	background: #41b883;
	color: #fff;
}
</style>
