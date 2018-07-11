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
			<div class="sticky-head">
				<table class="table table-sm">
					<thead>
						<tr>
							<th class="col w-20">Region</th>
							<th class="col w-40">Location</th>
							<th class="col w-40">Item</th>
						</tr>
					</thead>
				</table>
			</div>
			<table class="table table-sm">
				<tbody class="searchable">
					<tr v-for="location in locations" v-show="searchEx.test(location.name) || searchEx.test(location.region)
						|| searchEx.test(itemSearch[location.hash])">
						<td class="col w-20">
							<label :for="'item-count-' + location.hash">{{ location.region }}</label>
						</td>
						<td class="col w-40">
							<label :for="'item-count-' + location.hash">{{ location.name }}</label>
						</td>
						<td class="col w-40">
							<vt-select :sid="location.hash" @input="selectedItem" v-if="location.class == 'items'"
								:options="orderedItems" :storage-key="'vt.custom.' + location.hash" :selected="defaultItem" storage-key-remove-on="auto_fill"
								:clearable="true" placeholder="type to search" />
							<vt-select :sid="location.hash" @input="selectedOther" v-if="location.class == 'bottles'"
								:options="bottles" :storage-key="'vt.custom.' + location.hash" :selected="defaultItem" storage-key-remove-on="auto_fill"
								:clearable="true" placeholder="type to search" />
							<vt-select :sid="location.hash" @input="selectedPrize" v-if="location.class == 'prizes'"
								:options="prizes" :storage-key="'vt.custom.' + location.hash" :selected="defaultItem" storage-key-remove-on="auto_fill"
								:clearable="true" placeholder="type to search" />
							<vt-select :sid="location.hash" @input="selectedOther" v-if="location.class == 'medallions'"
								:options="medallions" :storage-key="'vt.custom.' + location.hash" :selected="defaultItem" storage-key-remove-on="auto_fill"
								:clearable="true" placeholder="type to search" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import VTSelect from '../VTSelect.vue';
import EventBus from '../../core/event-bus';
import orderBy from 'lodash.orderby';

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
			itemSearch: {},
			defaultItem: {name:'Random', value:'auto_fill'},
		};
	},
	mounted () {
	},
	methods: {
		selectedItem (selectedOption, sid) {
			if (!selectedOption) {
				selectedOption = this.defaultItem;
			}
			EventBus.$emit('itemAdd', selectedOption.value, sid, true);
			if (sid in this.oldValues) {
				EventBus.$emit('itemRemove', this.oldValues[sid]);
			}
			this.oldValues[sid] = selectedOption.value;
			this.itemSearch[sid] = selectedOption.name;
		},
		selectedPrize (selectedOption, sid) {
			if (!selectedOption) {
				selectedOption = this.defaultItem;
			}
			EventBus.$emit('itemAdd', selectedOption.value, sid);
			if (this.oldValues[sid] && this.oldValues[sid] !== 'auto_fill') {
				for (var i = 0; i < this.prizes.length; ++i) {
					console.log(i, this.prizes[i].value , this.oldValues[sid]);
					if (this.prizes[i].value == this.oldValues[sid]) {
						this.prizes[i].$isDisabled = false;
						break;
					}
				}
			}

			this.oldValues[sid] = selectedOption.value;
			this.itemSearch[sid] = selectedOption.name;
			if (selectedOption.value !== 'auto_fill') {
				for (var i = 0; i < this.prizes.length; ++i) {
					if (this.prizes[i].value == selectedOption.value) {
						this.prizes[i].$isDisabled = true;
						break;
					}
				}
			}
		},
		selectedOther (selectedOption, sid) {
			if (!selectedOption) {
				selectedOption = this.defaultItem;
			}
			EventBus.$emit('itemAdd', selectedOption.value, sid);
			this.oldValues[sid] = selectedOption.value;
			this.itemSearch[sid] = selectedOption.name;
		},
	},
	computed: {
		searchEx: (vm) => {
			return new RegExp(vm.search, 'i');
		},
		orderedItems: function () {
			return orderBy(this.items, 'name');
		},
	},
};
</script>

<style scoped>
.sticky-head {
	position: sticky;
	top: 143px;
	z-index: 990;
	background-color: white;
}
>>> .multiselect__input::placeholder {
	color: #DCDCDC;
}
</style>
