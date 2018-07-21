<template>
	<div class="card border-success">
		<div class="card-header bg-success card-heading-btn card-heading-sticky">
			<h3 class="card-title text-white float-left">Locations</h3>
			<div class="btn-toolbar float-right">
				<Select v-model="searchRegion" class="region-searcher" :options="regions" />
				<input class="items-filter" placeholder="search" type="text" v-model="search" />
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
					<tr v-for="location in locations" v-show="(searchRegion.value == 'all' || location.region == searchRegion.value)
						&& (searchEx.test(location.name) || searchEx.test(location.region) || searchEx.test(location.item.name))">
						<td class="col w-20">
							<label>{{ location.region }}</label>
						</td>
						<td class="col w-40">
							<label>{{ location.name }}</label>
						</td>
						<td class="col w-40">
							<Select :sid="location" :value="location.item" @input="selectedItem" v-if="location.class == 'items'"
								:default-item="defaultItem" :options="items" :clearable="true" placeholder="type to search" />
							<Select :sid="location" :value="location.item" @input="selectedItem" v-if="location.class == 'bottles'"
								:default-item="defaultItem" :options="bottles" :clearable="true" placeholder="type to search" />
							<Select :sid="location":value="location.item" @input="selectedItem" v-if="location.class == 'prizes'"
								:default-item="defaultItem" :options="prizes" :clearable="true" placeholder="type to search" />
							<Select :sid="location" :value="location.item" @input="selectedItem" v-if="location.class == 'medallions'"
								:default-item="defaultItem" :options="medallions" :clearable="true" placeholder="type to search" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import Select from '../Select.vue';

export default {
	components: {
		Select: Select,
	},
	data() {
		return {
			search: '',
			searchRegion: {name:'All Regions',value:'all'},
		};
	},
	methods: {
		selectedItem (selectedOption, sid) {
			this.$store.dispatch('itemLocations/setLocation', {
				location: sid,
				item: selectedOption,
			});
		},
	},
	computed: {
		searchEx () {
			return new RegExp(this.search, 'i');
		},
		regions () {
			var regions = {
				all: true,
			}
			this.$store.state.itemLocations.locations.forEach(location => {
				regions[location.region] = true;
			});

			return Object.keys(regions).map(item => {
				if (item == 'all') return {name:'All Regions',value:'all'};
				return {name: item, value: item};
			});
		},
		locations () {
			return this.$store.state.itemLocations.locations;
		},
		items () {
			return this.$store.state.itemLocations.pool.items.slice().sort((a, b) => {
				var nameA = a.name.toUpperCase();
				var nameB = b.name.toUpperCase();
				if (nameA < nameB || nameA == 'RANDOM') return -1;
				if (nameA > nameB || nameB == 'RANDOM') return 1;
				return 0;
			});
		},
		bottles () {
			return this.$store.state.itemLocations.pool.bottles;
		},
		medallions () {
			return this.$store.state.itemLocations.pool.medallions;
		},
		prizes () {
			return this.$store.state.itemLocations.pool.prizes;
		},
		defaultItem () {
			return this.$store.getters.itemLookup['auto_fill'];
		},
	},
};
</script>

<style scss scoped>
.card-heading-sticky {
	z-index: 995;
}
.region-searcher {
	width: 200px;
}
.region-searcher >>> .input-group {
	width: 190px !important;
}
.region-searcher >>> .multiselect {
	min-height: 34px !important;
}
.region-searcher >>> .multiselect__tags {
	min-height: 34px;
	padding-top: 7px;
}
.region-searcher >>> .multiselect__content,
.region-searcher >>> .multiselect__content-wrapper {
	z-index: 995;
}
.items-filter {
	width: 220px;
}
.sticky-head {
	position: sticky;
	top: 146px;
	z-index: 990;
	background-color: white;
}
>>> .multiselect__input::placeholder {
	color: #DCDCDC;
}
</style>
