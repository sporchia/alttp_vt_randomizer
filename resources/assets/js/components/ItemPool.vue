<template>
	<div class="card border-success">
		<div class="card-header bg-success card-heading-btn card-heading-sticky">
			<h3 class="card-title text-white float-left">Item Pool {{ placedItemCount }} / {{ placedItemCount }}</h3>
			<div class="btn-toolbar float-right">
				<input id="items-filter" placeholder="search" type="text" v-model="search" />
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<table class="table table-sm">
				<thead>
					<tr class="sticky-head">
						<th>Randomly Place</th>
						<th>Currently Placed</th>
						<th>Item Name</th>
					</tr>
				</thead>
				<tbody class="searchable">
					<tr v-for="item in items" v-show="searchEx.test(item.name)">
						<td class="col w-25">
							<input :id="'item-count-' + item.value" type="number" :value="item.count"
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
		placedItemCount: (vm) => {
			if (!vm.items.length) {
				return 0;
			}

			return vm.items.map(item => {
				return item.placed;
			}).reduce((carry, placed) => {
				return carry + placed;
			});
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
