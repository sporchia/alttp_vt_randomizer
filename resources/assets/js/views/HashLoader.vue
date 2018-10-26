<template>
	<div id="seed-generate">
		<div v-if="error" class="alert alert-danger" role="alert">
			<button type="button" class="close" aria-label="Close">
				<img class="icon" src="/i/svg/x.svg" alt="clear" @click="error = false">
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">{{ $t('error.title') }}:</span>
			<span class="message">{{ this.error }}</span>
		</div>
		<vt-rom-loader v-if="!romLoaded" @update="updateRom" @error="onError"></vt-rom-loader>

		<div id="seed-details" class="card border-success" v-if="gameLoaded && romLoaded">
			<div class="card-header bg-success card-heading-btn" :class="{'bg-info': rom.tournament}">
				<h3 class="card-title text-white float-left">{{ rom.name || $t('randomizer.details.title') }}</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md mb-3">
						<vt-rom-info :no-link="noLink" :rom="rom"></vt-rom-info>
					</div>
					<div class="col-md mb-3">
						<div class="row">
							<div class="col-md-6 mb-3">
								<div class="btn-group btn-flex" role="group">
									<button class="btn btn-light border-secondary text-center" @click="saveSpoiler">{{ $t('randomizer.details.save_spoiler') }}</button>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="btn-group btn-flex" role="group">
									<button class="btn btn-success text-center" @click="saveRom">{{ $t('randomizer.details.save_rom') }}</button>
								</div>
							</div>
						</div>
						<div class="row">
							<vt-rom-settings class="col-12" :rom="rom"></vt-rom-settings>
						</div>
					</div>
				</div>
				<vt-spoiler :rom="rom"></vt-spoiler>
			</div>
		</div>
	</div>
</template>

<script>
import EventBus from '../core/event-bus';
import FileSaver from 'file-saver';

export default {
	props: {
		version: {},
		current_rom_hash: {},
		hash: {},
		noLink: {default: true},
	},
	data() {
		return {
			rom: null,
			error: false,
			generating: false,
			romLoaded: false,
			gameLoaded: false,
		};
	},
	created () {
		localforage.getItem('rom').then(function(blob) {
			if (blob == null) {
				EventBus.$emit('noBlob');
				return;
			}
			EventBus.$emit('loadBlob', {target: {files: [new Blob([blob])]}});
		});
	},
	mounted () {
		EventBus.$on('applyHash', this.applyHash);
	},
	methods: {
		applyHash(e, second_attempt) {
			if (this.rom.checkMD5() != this.current_rom_hash) {
				if (second_attempt) {
					return new Promise(function(resolve, reject) {
						reject(this.rom);
					});
				}
				return this.rom.reset().then(function() {
					return this.applyHash(e, true);
				}.bind(this)).catch((error) => {
					console.log(error);
				})
			}
			if (window.s3_prefix) {
				return new Promise(function(resolve, reject) {
					this.gameLoaded = false;
					// try to load from S3.
					axios.get(window.s3_prefix + '/' + this.hash + '.json').then(response => {
						this.rom.parsePatch(response.data).then(function() {
							console.log('loaded from s3 :)');
							if (this.rom.shuffle) {
								this.rom.allowQuickSwap = true;
							}
							this.gameLoaded = true;
							EventBus.$emit('gameLoaded', this.rom);
							resolve({rom: this.rom, patch: response.data.patch});
						}.bind(this));
					}).catch(function() {
						axios.post(`/hash/` + this.hash).then(response => {
							this.rom.parsePatch(response.data).then(function() {
								if (response.data.patch.current_rom_hash && response.data.patch.current_rom_hash != this.current_rom_hash) {
									// The base rom has been updated.
								}
								if (this.rom.shuffle) {
									this.rom.allowQuickSwap = true;
								}
								this.gameLoaded = true;
								EventBus.$emit('gameLoaded', this.rom);
								resolve({rom: this.rom, patch: response.data.patch});
							}.bind(this));
						}).catch((error) => {
							if (error.response) {
								switch (error.response.status) {
									case 429:
										this.error =  this.$i18n.t('error.429');
										break;
									default:
										this.error = this.$i18n.t('error.failed_generation');
								}
							}
						});
					}.bind(this));
				}.bind(this));
			}
			return new Promise(function(resolve, reject) {
				this.gameLoaded = false;
				axios.post(`/hash/` + this.hash).then(response => {
					this.rom.parsePatch(response.data).then(function() {
						if (response.data.patch.current_rom_hash && response.data.patch.current_rom_hash != this.current_rom_hash) {
							// The base rom has been updated.
						}
						this.gameLoaded = true;
						EventBus.$emit('gameLoaded', this.rom);
						resolve({rom: this.rom, patch: response.data.patch});
					}.bind(this));
				}).catch((error) => {
					if (error.response) {
						switch (error.response.status) {
							case 429:
								this.error = 'While we apprecate your want to generate a lot of games, Other people would like'
									+ ' to as well. Please come back later if you would like to generate more.';
								break;
							default:
								this.error = 'Failed Creating Seed :(';
						}
					}
				});
			}.bind(this));
		},
		saveRom() {
			return this.rom.save(this.rom.downloadFilename()+ '.sfc');
		},
		saveSpoiler() {
			return FileSaver.saveAs(new Blob([JSON.stringify(this.rom.spoiler, null, 4)]), this.rom.downloadFilename() + '.txt');
		},
		updateRom(rom, current_rom_hash) {
			if (!rom) {
				console.log(rom);
				return;
			}
			this.rom = rom;
			this.error = false;
			this.romLoaded = true;
		},
		onError(error) {
			this.error = error;
		}
	},
}
</script>
