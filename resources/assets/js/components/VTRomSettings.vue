<template>
	<div class="collapse mb-3" id="rom-settings">
		<div class="card border-info">
			<div class="card-header bg-info text-white">Additional ROM Options</div>
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<vt-select id="heart-speed" :options="settings.heartSpeeds" storage-key="rom.heart-speed"
							:rom="rom" :selected="defaults.heartSpeeds" rom-function="setHeartSpeed">Heart Speed</vt-select>
					</div>
					<div class="col">
						<vt-sprite-select id="sprite-gfx" @select="onSpriteSelect" storage-key="rom.sram-trace"></vt-sprite-select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<vt-select id="menu-speed" no-race="true" :options="settings.menuSpeeds" storage-key="rom.menu-speed"
							:rom="rom" :selected="defaults.menuSpeeds" rom-function="setMenuSpeed">Menu Speed</vt-select>
					</div>
					<div class="col">
						<vt-select id="heart-color" :options="settings.heartColors" storage-key="rom.heart-color"
							:rom="rom" :selected="defaults.heartColors" rom-function="setHeartColor">Heart Color</vt-select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<vt-toggle id="sram-trace" :selected="defaults.sramTrace" no-race="true" storage-key="rom.sram-trace">SRAM Trace</vt-toggle>
					</div>
					<div class="col">
						<vt-toggle id="quickswap" :selected="defaults.quickswap" storage-key="rom.quickswap" :no-race="true">Item Quickswap</vt-toggle>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<vt-toggle id="music-on" :selected="defaults.music" storage-key="rom.music-on">Background Music (set to "No" for MSU-1 support)</vt-toggle>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div><strong>*</strong> Does not work in Race Roms</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ['rom'],
	data() {
		return {
			settings: {
				heartSpeeds: [
					{value: 'off', name: 'Off'},
					{value: 'normal', name: 'Normal Speed'},
					{value: 'half', name: 'Half Speed'},
					{value: 'quarter', name: 'Quarter Speed'},
				],
				menuSpeeds: [
					{value: 'instant', name: 'Instant'},
					{value: 'fast', name: 'Fast'},
					{value: 'normal', name: 'Normal'},
					{value: 'slow', name: 'Slow'},
				],
				heartColors: [
					{value: 'blue', name: 'Blue'},
					{value: 'green', name: 'Green'},
					{value: 'red', name: 'Red'},
					{value: 'yellow', name: 'Yellow'},
				],
			},
			defaults: {
				heartSpeeds: {value: 'half', name: 'Half Speed'},
				menuSpeeds: {value: 'normal', name: 'Normal'},
				heartColors: {value: 'red', name: 'Red'},
				sramTrace: false,
				quickswap: false,
				music: true,
			}
		};
	},
	methods: {
		onSpriteSelect(selected) {
			let sprite_name = path.basename(selected.file);
			if (this.rom) {
				new Promise((resolve, reject) => {
					localforage.getItem('vt_sprites.' + sprite_name).then(function(spr) {
						if (spr) {
							resolve(spr);
						}
						axios.get(selected.file, {responseType: 'arraybuffer'}).then(response => {
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
				}).then(this.rom.parseSprGfx);
			}
			localforage.setItem('rom.sprite-gfx', sprite_name);
		}
	}
};
</script>

