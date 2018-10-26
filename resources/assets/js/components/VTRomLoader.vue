<template>
	<div>
		<div v-if="!loading" id="rom-select" class="card border-info">
			<div class="card-header bg-info">
				<h4 class="card-title">{{ $t('rom.loader.title') }}</h4>
			</div>
			<div class="card-body">
				<p>
					<label class="btn btn-outline-primary btn-file">
						{{ $t('rom.loader.file_select') }} <input type="file" accept=".sfc,.smc" @change="loadBlob">
					</label>
				</p>
				<p v-html="$t('rom.loader.content')" />
			</div>
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
			loading: true,
			settings_loaded: false,
		};
	},
	created () {
		if (typeof current_rom_hash !== 'undefined') {
			this.current_rom_hash = current_rom_hash;
			this.settings_loaded = true;
			return;
		}
		axios.get(`/base_rom/settings`).then(response => {
			this.current_rom_hash = response.data.rom_hash;
			this.current_base_file = response.data.base_file;
			this.settings_loaded = true;

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
		EventBus.$on('noBlob', this.noBlob);
	},
	methods: {
		noBlob() {
			this.loading = false;
		},
		loadBlob(change) {
			if (!this.settings_loaded) {
				return setTimeout(this.loadBlob, 50, change);
			}
			this.loading = true;
			let blob = change.target.files[0];

			new ROM(blob, (rom) => {
				this.patchRomFromJSON(rom).then((rom) => {
					if (rom.checkMD5() != this.current_rom_hash) {
						this.$emit('error', this.$i18n.t('error.bad_file'));
						this.loading = false;
						return;
					} else {
						localforage.setItem('rom', rom.getOriginalArrayBuffer()).catch((error) => {
							if (error === 'QuotaExceededError') {
								this.$emit('error', this.$i18n.t('error.quota_exceeded_error'));
								this.loading = false;
								return;
							}
							throw error;
						});
						this.$emit('update', rom, this.current_rom_hash);
						EventBus.$emit('applyHash', rom);
						this.loading = false;
					}
				}).catch((error) => {
					if (error == 'base patch corrupt') {
						localforage.setItem('vt.stored_base').catch((error) => {
							if (error === 'QuotaExceededError') {
								this.$emit('error', this.$i18n.t('error.quota_exceeded_error'));
								this.loading = false;
								return;
							}
							throw error;
						});
						this.loadBlob(change);
					}
				});
			}, (error) => {
				this.$emit('error', 'Unknown Error: something went wrong?');
				this.loading = false;
			});
		},
		patchRomFromJSON(rom) {
			return new Promise((resolve, reject) => {
				if (typeof vt_base_patch !== 'undefined') {
					if (!Array.isArray(vt_base_patch)) {
						return reject('base patch corrupt');
					}
					return rom.parsePatch({patch: vt_base_patch}).then((rom) => {
						rom.setBasePatch(vt_base_patch);
						resolve(rom);
					});
				}
				localforage.getItem('vt.stored_base').then((stored_base_file) => {
					if (this.current_base_file == stored_base_file) {
						localforage.getItem('vt.base_json').then((patch) => {
							if (!Array.isArray(patch)) {
								return reject('base patch corrupt');
							}
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
									}))
									.catch((error) => {
										if (error === 'QuotaExceededError') {
											this.$emit('error', this.$i18n.t('error.quota_exceeded_error'));
											return;
										}
										throw error;
									});
							})
							.catch((error) => {
								if (error === 'QuotaExceededError') {
									this.$emit('error', this.$i18n.t('error.quota_exceeded_error'));
									return;
								}
								throw error;
							});
						});
					}
				});
			});
		},
	}
}
</script>
