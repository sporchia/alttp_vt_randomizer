<template>
	<div id="seed-generate">
		<div v-if="error" class="alert alert-danger" role="alert">
			<button type="button" class="close" aria-label="Close">
				<img class="icon" src="/i/svg/x.svg" alt="clear" @click="error = false">
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<span class="message">{{ this.error }}</span>
		</div>
		<vt-rom-loader v-if="!romLoaded" @update="updateRom" @error="onError"></vt-rom-loader>

		<div id="seed-details" class="card border-info" v-if="gameLoaded && romLoaded">
			<div class="card-header bg-success card-heading-btn">
				<h3 class="card-title text-white float-left">{{ rom.name || 'Game Details' }}</h3>
				<div class="btn-toolbar float-right">
					<button class="btn btn-light border-secondary" data-toggle="collapse" href="#rom-settings">
						ROM Options <img class="icon pulse" src="/i/svg/cog.svg" alt="ROM Options">
					</button>
				</div>
			</div>
			<div class="card-body">
				<vt-rom-settings :rom="rom"></vt-rom-settings>
				<div class="row">
					<div class="col-md mb-3">
						<vt-rom-info :rom="rom"></vt-rom-info>
					</div>
					<div class="col-md mb-3">
						<div class="row">
							<div class="col-md mb-3">
								<button class="btn btn-light border-secondary" @click="saveSpoiler">Save Spoiler</button>
							</div>
							<div class="col-md mb-3">
								<button class="btn btn-success" @click="saveRom">Save Rom</button>
							</div>
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

export default {
	props: [
		'version',
		'current_rom_hash',
		'hash',
	],
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
