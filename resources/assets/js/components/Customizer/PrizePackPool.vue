<template>
	<div class="card border-success" :class="{'border-danger': unevenCount}">
		<div class="card-header bg-success card-heading-btn card-heading-sticky" :class="{'bg-danger': unevenCount}">
			<h3 class="card-title text-white float-left">Drop Pool {{ dropCount + placedDropCount }} / 63
				<span v-if="dropCount + placedDropCount < 63">({{ 63 - dropCount - placedDropCount}} empty locations)</span>
			</h3>
			<div class="btn-toolbar float-right">
				<input id="drops-filter" placeholder="search" type="text" v-model="search" />
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<div class="sticky-head">
				<table class="table table-sm">
					<thead>
						<tr>
							<th class="col w-25">Randomly Place ({{ dropCount }})</th>
							<th class="col w-25">Manually Placed ({{ placedDropCount }})</th>
							<th class="col w-50">Drop Name</th>
						</tr>
					</thead>
				</table>
			</div>
			<table class="table table-sm">
				<tbody class="searchable">
					<tr v-for="drop in ordereddrops" v-if="drop.hasOwnProperty('count')" v-show="searchEx.test(drop.name)">
						<td class="col w-25">
							<input :id="'drop-count-' + drop.value" type="number" v-model="drop.count"
								min="0" max="218" step="1" :name="'data[alttp.custom.drop.count.' + drop.value + ']'" class="input-sm custom-drops">
						</td>
						<td class="col w-25">
							<input :id="'drop-placed-' + drop.value" :value="drop.placed" type="number" min="0" max="218" step="1" readonly
								tabindex="-1" class="custom-placed input-sm">
						</td>
						<td class="col w-50">
							<label :for="'drop-count-' + drop.value">{{ drop.name }}</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
// @TODO: consider using Array.prototype.sort().
import orderBy from 'lodash.orderby';

export default {
	props: [
		'value',
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
		ordereddrops: function () {
			return orderBy(this.value, 'name');
		},
		unevenCount () {
			return this.placedDropCount + this.dropCount != 63;
		},
		placedDropCount (vm) {
			if (!vm.value.length) {
				return 0;
			}
			return vm.value.filter(drop => {
				return drop.value !== 'auto_fill';
			}).map(drop => {
				return Number(drop.placed || 0);
			}).reduce((carry, placed) => {
				return carry + placed;
			});
		},
		dropCount: (vm) => {
			if (!vm.value.length) {
				return 0;
			}
			return vm.value.map(drop => {
				return Number(drop.count || 0);
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
