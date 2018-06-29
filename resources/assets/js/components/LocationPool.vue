<template>
	<div class="card border-success">
		<div class="card-header bg-success card-heading-btn card-heading-sticky">
			<h3 class="card-title text-white float-left">Locations</h3>
			<div class="btn-toolbar float-right">
				<input id="items-filter" placeholder="search" type="text" v-model="search" />
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<table class="table table-sm">
				<thead>
					<tr class="sticky-head">
						<th>Region</th>
						<th>Location</th>
						<th>Item</th>
					</tr>
				</thead>
				<tbody class="searchable">
					<tr v-for="location in locations" v-show="searchEx.test(location.name) || searchEx.test(location.region)
						|| searchEx.test(oldValues['location-' + location.hash])">
						<td class="col w-25">
							<label :for="'item-count-' + location.hash">{{ location.region }}</label>
						</td>
						<td class="col w-50">
							<label :for="'item-count-' + location.hash">{{ location.name }}</label>
						</td>
						<td class="col w-25">
							<vt-select :sid="'location-' + location.hash" @input="selectedItem" v-if="location.class == 'items'"
								:options="items" :storage-key="'vt.custom.' + location.hash" :selected="defaultItem" storage-key-remove-on="auto_fill" />
							<vt-select v-if="location.class == 'bottles'" :options="bottles" :storage-key="'vt.custom.' + location.hash" />
							<vt-select v-if="location.class == 'prizes'" :options="prizes" :storage-key="'vt.custom.' + location.hash" />
							<vt-select v-if="location.class == 'medallions'" :options="medallions" :storage-key="'vt.custom.' + location.hash" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import VTSelect from './VTSelect.vue';
import EventBus from '../core/event-bus';

export default {
	components: {
		VTSelect: VTSelect,
	},
	props: [
		'locations',
		'items',
		'bottles',
		'medallions',
		'prizes',
	],
	data() {
		return {
			search: '',
			oldValues: {},
			defaultItem: {name:'Random', value:'auto_fill'},
		};
	},
	mounted () {
	},
	methods: {
		selectedItem (selectedOption, sid) {
			EventBus.$emit('itemAdd', selectedOption.value);
			if (sid in this.oldValues) {
				EventBus.$emit('itemRemove', this.oldValues[sid]);
			}
			this.oldValues[sid] = selectedOption.value;
		},
	},
	computed: {
		searchEx: (vm) => {
			return new RegExp(vm.search, 'i');
		},
	},
};
</script>

<style scoped>
.sticky-head {
	position: sticky;
	top: 40px;
	z-index: 1200;
}
</style>
