<template>
	<div class="spoiler col-md-12">
		<div class="spoiler-toggle" @click="show = !show">
			<img v-if="!show" src="/i/svg/plus.svg">
			<img v-if="show" src="/i/svg/minus.svg">
			Spoiler!
		</div>
		<div v-if="show" class="spoiler-tabed">
			<div class="row">
				<div class="col"></div>
				<div class="col">
					<vt-select v-model="search" id="item-search" :options="items" placeholder="Search for Item"></vt-select>
				</div>
			</div>
			<tabs>
				<tab v-for="(value, section) in regions" :key="section" :name="section"
					:count="Object.values(value).filter((item) => { return item == search.value; }).length">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="w-50">Location</th>
								<th class="w-50">Item</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item, location) in value" class="spoil-item-location" :class="{ 'bg-info text-light': item == search.value }">
								<td>{{ location }}</td>
								<td class="item">{{ item }}</td>
							</tr>
						</tbody>
					</table>
				</tab>
				<tab v-if="paths" key="paths" name="Paths">
					<div v-for="(rows, location) in paths" class="row border-top">
						<div class="col-4 ">{{ location }}</div>
						<div class="col-8">
							<table class="table table-striped table-sm mb-0">
								<thead>
									<tr>
										<th class="w-50 border-top-0">Region</th>
										<th class="w-50 border-top-0">Entrance/Exit</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="row in rows">
										<td class="w-50">{{ row[0] }}</td>
										<td class="w-50">{{ row[1] }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</tab>
				<tab v-if="shops" key="shops" name="Shops" :count="Object.values(shops).filter((item) => {
						return [item.item_0, item.item_1, item.item_2].indexOf(search.value) !== -1;
					}).length">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="col-auto">Location</th>
								<th class="col-auto">Type</th>
								<th class="col-auto">Item 1</th>
								<th class="col-auto">Item 2</th>
								<th class="col-auto">Item 3</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="row in shops" class="spoil-item-location"
								:class="{ 'bg-info text-light': [row.item_0, row.item_1, row.item_2].indexOf(search.value) !== -1 }">
								<td>{{ row.location }}</td>
								<td>{{ row.type }}</td>
								<td class="item">{{ row.item_0 }}</td>
								<td class="item">{{ row.item_1 }}</td>
								<td class="item">{{ row.item_2 }}</td>
							</tr>
						</tbody>
					</table>
				</tab>
				<tab v-if="playthrough" key="playthrough" name="Playthrough"
					:count="Object.values(playthrough).filter((item) => { return item.item == search.value; }).length">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="col-auto">Sphere</th>
								<th v-if="!entrances" class="col-auto">Region</th>
								<th class="col-auto">Location</th>
								<th class="col-auto">Item</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="row in playthrough" class="spoil-item-location" :class="{ 'bg-info text-light': row.item == search.value }">
								<td>{{ row.sphere }}</td>
								<td v-if="!entrances">{{ row.region }}</td>
								<td>{{ row.location }}</td>
								<td class="item">{{ row.item }}</td>
							</tr>
						</tbody>
					</table>
				</tab>
				<tab v-if="entrances" key="entrances" name="Entrances">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="col-auto">Entrance</th>
								<th class="col-auto"></th>
								<th class="col-auto">Exit</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="row in entrances" class="spoil-item-location">
								<td>{{ row.entrance }}</td>
								<td>{{ row.direction == 'both' ? '↔' : '→' }}</td>
								<td>{{ row.exit }}</td>
							</tr>
						</tbody>
					</table>
				</tab>
				<tab v-if="meta" key="meta" name="meta">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="w-50">Setting</th>
								<th class="w-50">Value</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(value, setting) in meta" class="spoil-item-location">
								<td>{{ setting }}</td>
								<td>{{ value }}</td>
							</tr>
						</tbody>
					</table>
				</tab>
			</tabs>
		</div>
	</div>
</template>

<script>
import Tabs from './VTTabs.vue';
import Tab from './VTTab.vue';

export default {
	components: {
		Tabs: Tabs,
		Tab: Tab,
	},
	props: ['rom'],
	data() {
		return {
			show: false,
			search: '',
		}
	},
	computed: {
		regions: (vm) => {
			let regions = {};
			for (name in vm.rom.spoiler) {
				if (['meta', 'playthrough', 'Entrances', 'paths', 'Shops'].indexOf(name) === -1) {
					regions[name] = vm.rom.spoiler[name];
				}
			}
			return regions;
		},
		shops: (vm) => {
			return typeof vm.rom.spoiler.Shops !== 'undefined' ? vm.rom.spoiler.Shops : false;
		},
		entrances: (vm) => {
			return typeof vm.rom.spoiler.Entrances !== 'undefined' ? vm.rom.spoiler.Entrances : false;
		},
		playthrough: (vm) => {
			let playthrough = [];
			let spoiler = vm.rom.spoiler.playthrough;
			if (typeof vm.rom.spoiler.Entrances !== 'undefined') {
				Object.keys(spoiler).forEach((sphere) => {
					Object.keys(spoiler[sphere]).forEach((location) => {
						playthrough.push({
							sphere: sphere,
							location: location,
							item: vm.rom.spoiler.playthrough[sphere][location],
						});
					});
				});
			} else {
				Object.keys(spoiler).forEach((sphere) => {
					Object.keys(spoiler[sphere]).forEach((region) => {
						Object.keys(spoiler[sphere][region]).forEach((location) => {
							playthrough.push({
								sphere: sphere,
								region: region,
								location: location,
								item: vm.rom.spoiler.playthrough[sphere][region][location],
							});
						});
					});
				});
			}
			return playthrough;
		},
		paths: (vm) => {
			return typeof vm.rom.spoiler.paths !== 'undefined' ? vm.rom.spoiler.paths : false;
		},
		meta: (vm) => {
			return typeof vm.rom.spoiler.meta !== 'undefined' ? vm.rom.spoiler.meta : false;
		},
		items: (vm) => {
			let items = {};
			for (name in vm.rom.spoiler) {
				if (['meta', 'playthrough', 'Entrances', 'paths', 'Shops'].indexOf(name) === -1) {
					Object.keys(vm.rom.spoiler[name]).forEach((location) => {
						items[vm.rom.spoiler[name][location]] = true;
					});
				}
			}
			return Object.keys(items).sort().map((item) => {
				return {name: item, value: item};
			});
		},
	},
}
</script>
