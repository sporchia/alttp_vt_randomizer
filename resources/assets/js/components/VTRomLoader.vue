<template>
	<div id="rom-select" class="card border-info">
		<div class="card-header bg-info">
			<h4 class="card-title">Getting Started</h4>
		</div>
		<div class="card-body">
			<p>
				<label class="btn btn-outline-primary btn-file">
					Select ROM File <input type="file" accept=".sfc,.smc" @change="loadBlob">
				</label>
			</p>
			<ol>
				<li>Select your rom file and load it into the browser
					(Please use a <strong>Zelda no Densetsu: Kamigami no Triforce v1.0</strong> ROM with
					an .smc or .sfc extension)</li>
				<li>Select the <a href="/options">options</a> for how you would like your game randomized</li>
				<li>Click Generate</li>
				<li>Then Save your rom and get to playing</li>
			</ol>
		</div>
	</div>
</template>

<script>
import EventBus from '../core/event-bus';

export default {
	data() {
		return {
			current_rom_hash: '',
			current_base_file: '',
		};
	},
	created () {
		if (typeof current_rom_hash !== 'undefined') {
			this.current_rom_hash = current_rom_hash;
			return;
		}
		axios.get(`/base_rom/settings`).then(response => {
			this.current_rom_hash = response.data.rom_hash;
			this.current_base_file = response.data.base_file;

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
	mounted () {
		EventBus.$on('loadBlob', this.loadBlob);
	},
	methods: {
		loadBlob(change) {
			let blob = change.target.files[0];
			if (!blob) {
				console.log(blob);
				return;
			}

			new ROM(blob, (rom) => {
				this.patchRomFromJSON(rom).then((rom) => {
					if (rom.checkMD5() != this.current_rom_hash) {
						this.$emit('error', 'File not recognized');
						return;
					} else {
						localforage.setItem('rom', rom.getArrayBuffer());
						this.$emit('update', rom, this.current_rom_hash);
						EventBus.$emit('applyHash', rom);
					}
				});
			});
		},
		patchRomFromJSON(rom) {
			return new Promise((resolve, reject) => {
				if (typeof vt_base_patch !== 'undefined') {
					rom.parsePatch({patch: vt_base_patch}).then((rom) => {
						rom.setBasePatch(vt_base_patch);
						resolve(rom);
					});
					return;
				}
				localforage.getItem('vt.stored_base').then((stored_base_file) => {
					console.log(this.current_base_file, stored_base_file);
					if (this.current_base_file == stored_base_file) {
						localforage.getItem('vt.base_json').then((patch) => {
							rom.parsePatch({patch: patch}).then((rom) => {
								rom.setBasePatch(patch);
								resolve(rom);
							});
						});
					} else {
						axios.get(this.current_base_file).then(response => {
							localforage.setItem('vt.stored_base', this.current_base_file).then(() => {
								localforage.setItem('vt.base_json', response.data)
									.then(this.patchRomFromJSON(rom).then(() => {
										return resolve(rom);
									}));
							});
						});
					}
				});
			});
		},
	}
}
</script>
