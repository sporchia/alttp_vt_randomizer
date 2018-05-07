<template>
	<div id="sprite-gfx" class="input-group" role="group">
		<div class="input-group-prepend">
			<span class="input-group-text">{{ title }}</span>
		</div>
		<multiselect class="form-control" v-model="value" :options="options"
			selectLabel="" :show-labels="false" :allow-empty="false"
			:custom-label="customLabel" @select="onSelect">
			<template slot="singleLabel" slot-scope="props">
				<div class="option__desc">
					<div class="float-left" :class="'icon-custom-' + props.option.name.replace(/[ \)\(\.]/g, '')"></div>
					<div class="option__title sprite-name">{{ props.option.name }}</div>
				</div>
			</template>
			<template slot="option" slot-scope="props">
				<div class="option__desc">
					<div class="float-left" :class="'icon-custom-' + props.option.name.replace(/[ \)\(\.]/g, '')"></div>
					<span class="option__title sprite-name">{{ props.option.name }}</span>
				</div>
			</template>
		</multiselect>
	</div>
</template>

<script>
export default {
	components: {
		Multiselect: Multiselect.default
	},
	props: {
		title: {default: 'Play As'},
		selected: {default: null},
		rom: {default: null},
	},
	data() {
		return {
			value: this.selected,
			sprites: [],
		};
	},
	created () {
		axios.get(`/sprites`).then(response => {
			this.sprites = response.data;
			this.value = this.sprites[0];
			this.sprites.push({
				author: "none",
				file: null,
				name: "Random",
			});
			localforage.getItem('rom.sprite-gfx').then(function(value) {
				if (value === null) return;
				for (var sprite in this.sprites) {
					if (path.basename(this.sprites[sprite].file) == value) {
						this.value = this.sprites[sprite];
						break;
					}
				}
			}.bind(this));
		});
	},
	computed: {
		options: function() {
			return this.sprites;
		}
	},
	methods: {
		customLabel (option) {
			return `${option.name}`;
		},
		customClass (option) {
			return `"icon-custom-" + option.name.replace(/[ \)\(\.]/g, '')`;
		},
		onSelect (option) {
			this.$emit('select', option);
		}
	}
}
</script>

<style>
.sprite-name {
	margin-left: 2rem;
	font-size: 1.1rem;
	padding-top: 0.2rem;
}
.multiselect__single {
	margin-bottom: 5px;
}
.multiselect__option {
	line-height: 24px;
}
</style>

