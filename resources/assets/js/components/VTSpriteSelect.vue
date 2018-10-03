<template>
	<div id="sprite-gfx" class="input-group" role="group">
		<div class="input-group-prepend">
			<span class="input-group-text">{{ title }}</span>
		</div>
		<multiselect class="form-control" v-model="value" :options="sprites"
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
		storageKey: {default: ''},
		rom: {default: null},
	},
	data() {
		return {
			value: this.selected,
		};
	},
	created () {
		localforage.getItem('rom.sprite-gfx').then(value => {
			if (value === null) return;
			for (var sprite in this.sprites) {
				if (path.basename(this.sprites[sprite].file) == value) {
					this.value = this.sprites[sprite];
					break;
				}
			}
			this.applyRomFunctions(this, this.rom);
		});
	},
	methods: {
		customLabel (option) {
			return `${option.name}`;
		},
		customClass (option) {
			return `"icon-custom-" + option.name.replace(/[ \)\(\.]/g, '')`;
		},
		onSelect (option) {
			this.value = option;
			if (this.storageKey) {
				let sprite_name = path.basename(option.file);
				localforage.setItem(this.storageKey, sprite_name);
			}
			if (this.rom) {
				this.applyRomFunctions(this, this.rom);
			}
		},
		applyRomFunctions: (vm, rom) => {
			let pickedSprite = vm.value;

			if (pickedSprite === null) {
				pickedSprite = vm.sprites[0];
			}

			while (pickedSprite.file === null) {
				pickedSprite = vm.sprites[Math.floor(Math.random() * vm.sprites.length)];
			}

			new Promise((resolve, reject) => {
				let sprite_name = path.basename(pickedSprite.file);
				localforage.getItem('vt_sprites.' + sprite_name).then(function(spr) {
					if (spr) {
						resolve(spr);
						return;
					}
					axios.get(pickedSprite.file, {responseType: 'arraybuffer'}).then(response => {
						var spr_array = new Uint8Array(response.data);
						localforage.setItem('vt_sprites.' + sprite_name, spr_array).then(function(spr) {
							resolve(spr);
						}).catch(function() {
							reject('could not save sprite to local storage');
						});
					}).catch(function(){
						reject('cannot find sprite file');
					});
				});
			}).then(rom.parseSprGfx);
		},
	},
	computed: {
		sprites () {
			return this.$store.state.sprites;
		},
	},
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

