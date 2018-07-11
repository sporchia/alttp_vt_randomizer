<template>
	<div class="card border-success" :class="{'border-danger': unevenCount}">
		<div class="card-header bg-success card-heading-btn card-heading-sticky" :class="{'bg-danger': unevenCount}">
			<h3 class="card-title text-white float-left">Item Pool {{ itemCount + placedItemCount }} / 216</h3>
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
							<th class="col w-25">Randomly Place ({{ itemCount }})</th>
							<th class="col w-25">Manually Placed ({{ placedItemCount }})</th>
							<th class="col w-50">Item Name</th>
						</tr>
					</thead>
				</table>
			</div>
			<table class="table table-sm">
				<tbody class="searchable">
					<tr v-for="item in orderedItems" v-if="item.hasOwnProperty('count')" v-show="searchEx.test(item.name)">
						<td class="col w-25">
							<input :id="'item-count-' + item.value" type="number" v-model="item.count"
								min="0" max="218" step="1" :name="'data[alttp.custom.item.count.' + item.value + ']'" class="input-sm custom-items">
						</td>
						<td class="col w-25">
							<input :id="'item-placed-' + item.value" :value="item.placed" type="number" min="0" max="218" step="1" readonly
								tabindex="-1" class="custom-placed input-sm">
						</td>
						<td class="col w-50">
							<label :for="'item-count-' + item.value">{{ item.name }}</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import orderBy from 'lodash.orderby';

export default {
	props: [
		'items',
	],
	data() {
		return {
			search: '',
		};
	},
	computed: {
		searchEx: (vm) => {
			return new RegExp(vm.search, 'i');
		},
		orderedItems: function () {
			return orderBy(this.items, 'name');
		},
		unevenCount () {
			return this.placedItemCount + this.itemCount != 216;
		},
		placedItemCount (vm) {
			if (!vm.items.length) {
				return 0;
			}
			return vm.items.filter(item => {
				return item.value !== 'auto_fill';
			}).map(item => {
				return Number(item.placed || 0);
			}).reduce((carry, placed) => {
				return carry + placed;
			});
		},
		itemCount: (vm) => {
			if (!vm.items.length) {
				return 0;
			}
			return vm.items.map(item => {
				return Number(item.count || 0);
			}).reduce((carry, count) => {
				return carry + count;
			});
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
</style>
