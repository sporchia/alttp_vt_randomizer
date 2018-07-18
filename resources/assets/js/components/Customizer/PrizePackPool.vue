<template>
	<div class="card border-success" :class="{'border-danger': unevenCount}">
		<div class="card-header bg-success card-heading-btn card-heading-sticky" :class="{'bg-danger': unevenCount}">
			<h3 class="card-title text-white float-left">Drop Pool {{ dropCount + placedDropCount }} / {{ max }}
				<span v-if="dropCount + placedDropCount < max">({{ max - dropCount - placedDropCount}} empty drops)</span>
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
					<tr v-for="drop in orderedDrops" v-if="drop.hasOwnProperty('count')" v-show="searchEx.test(drop.name)">
						<td class="col w-25">
							<input type="number" :value="drop.count" @input="dropCountChanged($event, drop)"
								min="0" :max="max" step="1" class="input-sm custom-drops">
						</td>
						<td class="col w-25">
							<input :value="drop.placed" type="number" min="0" :max="max" step="1" readonly
								tabindex="-1" class="custom-placed input-sm">
						</td>
						<td class="col w-50">
							<label>{{ drop.name }}</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			search: '',
			max: 63,
		};
	},
	methods: {
		dropCountChanged (e, drop) {
			this.$store.dispatch('prizePacks/setDropCount', {
				drop: drop,
				count: e.target.value,
			});

			this.$emit('input', e.target.value);
		},
	},
	computed: {
		searchEx () {
			return new RegExp(this.search, 'i');
		},
		orderedDrops () {
			return this.$store.state.prizePacks.pool.slice().sort((a, b) => {
				var nameA = a.name.toUpperCase();
				var nameB = b.name.toUpperCase();
				if (nameA < nameB) return -1;
				if (nameA > nameB) return 1;
				return 0;
			});
		},
		unevenCount () {
			return this.placedDropCount + this.dropCount != this.max;
		},
		placedDropCount () {
			if (!this.orderedDrops.length) {
				return 0;
			}
			return this.orderedDrops.filter(drop => {
				return drop.value !== 'auto_fill';
			}).map(drop => {
				return Number(drop.placed || 0);
			}).reduce((carry, placed) => {
				return carry + placed;
			});
		},
		dropCount () {
			if (!this.orderedDrops.length) {
				return 0;
			}
			return this.orderedDrops.map(drop => {
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
