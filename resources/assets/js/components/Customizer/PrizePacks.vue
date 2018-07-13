<template>
	<div class="card border-success">
		<div class="card-header bg-success card-heading-btn card-heading-sticky">
			<h3 class="card-title text-white float-left">Prize Packs</h3>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<div class="sticky-head">
				<table class="table table-sm">
					<thead>
						<tr>
							<th class="col w-10">Pack</th>
							<th class="col w-80">Prizes</th>
						</tr>
					</thead>
				</table>
			</div>
			<table class="table table-sm">
				<tbody class="searchable">
					<tr v-for="(pack, id) in value" v-if="['pull', 'crab', 'stun', 'fish'].indexOf(id) === -1">
						<td class="col w-10">
							{{ id }}
						</td>
						<td class="col w-20">
							<vt-select v-model="pack[0]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
							<vt-select v-model="pack[4]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
							<vt-select v-model="pack[1]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
							<vt-select v-model="pack[5]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
							<vt-select v-model="pack[2]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
							<vt-select v-model="pack[6]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
							<vt-select v-model="pack[3]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
							<vt-select v-model="pack[7]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
					</tr>
					<tr>
						<td class="col w-10">
							Pull
						</td>
						<td class="col w-20">
							<vt-select v-model="value.pull[0]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
							<vt-select v-model="value.pull[1]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
							<vt-select v-model="value.pull[2]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
						</td>
					</tr>
					<tr>
						<td class="col w-10">
							Crab
						</td>
						<td class="col w-20">
							<vt-select v-model="value.crab[0]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
							<vt-select v-model="value.crab[1]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
						</td>
						<td class="col w-20">
						</td>
					</tr>
					<tr>
						<td class="col w-10">
							Stun
						</td>
						<td class="col w-20">
							<vt-select v-model="value.stun[0]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
						</td>
						<td class="col w-20">
						</td>
						<td class="col w-20">
						</td>
					</tr>
					<tr>
						<td class="col w-10">
							Fish
						</td>
						<td class="col w-20">
							<vt-select v-model="value.fish[0]" @input="selectedItem" :options="drops" :selected="defaultItem" :trigger-on-mount="true" />
						</td>
						<td class="col w-20">
						</td>
						<td class="col w-20">
						</td>
						<td class="col w-20">
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
		'drops',
		'value',
	],
	data() {
		return {
			oldValues: {},
			defaultItem: {name:'Heart', value:'Heart'},
		}
	},
	mounted () {
		localforage.getItem('vt.custom.prizepacks').then(value => {
			if (value === null) {
				return;
			}
			//this.items = value;
		}).then(() => {
			//this.$emit('input', this.selectedEq);
		});
	},
	methods: {
		selectedItem (selectedOption, sid) {
			if (!selectedOption) {
				selectedOption = this.defaultItem;
			}
			EventBus.$emit('prizePackAdd', selectedOption.value, sid, true);
			if (sid in this.oldValues) {
				EventBus.$emit('prizePackRemove', this.oldValues[sid]);
			}
			this.oldValues[sid] = selectedOption.value;
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
