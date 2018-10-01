<template>
	<div class="flex-input">
		<div class="input-group" role="group">
			<div v-if="$slots.default" class="input-group-prepend">
				<span class="input-group-text"><slot></slot><sup v-if="noRace"><strong>*</strong></sup></span>
			</div>
			<multiselect class="form-control" v-model="value" :options="options" :show-labels="false" :allow-empty="false"
				:custom-label="customLabel" :placeholder="placeholder" @select="onSelect"></multiselect>
			<div v-if="clearable" class="input-group-append">
				<span class="input-group-text cursor-pointer" @click="onClear"><img class="icon" src="/i/svg/x.svg" alt="clear"></span>
			</div>
		</div>
		<span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span>
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
		storageKeyRemoveOn: {default: null},
		romFunction: {default: null},
		placeholder: {default: 'Select option'},
		triggerOnMount: {default: false},
		rom: {default: null},
		clearable: {default: false},
		sid: {default: null},
	},
	mounted () {
		if (!this.storageKey) {
			if (this.triggerOnMount) {
				this.onSelect(this.value);
			}
			return;
		}
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
			if (!option) {
				return;
			}
			if (this.storageKey) {
				if (option.value == this.storageKeyRemoveOn) {
					localforage.removeItem(this.storageKey);
				} else {
					localforage.setItem(this.storageKey, option.value);
				}
			}
			if (this.rom && this.romFunction) {
				this.rom[this.romFunction](option.value);
			}
			this.$emit('select', option, this.sid);
			this.$emit('input', option, this.sid);
		},
		applyRomFunctions: (vm, rom) => {
			if (rom && vm.romFunction) {
				rom[vm.romFunction](vm.value.value);
			}
		},
		onClear () {
			this.value = this.storageKeyRemoveOn ? this.selected : null;
			if (this.value) {
				return this.onSelect(this.value)
			}
			this.$emit('select', null);
			this.$emit('input', {value: null});
		},
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
.cursor-pointer {
	cursor: pointer;
}
</style>
