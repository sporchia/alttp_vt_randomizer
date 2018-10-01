import axios from 'axios';
import prizePacks from './modules/prizePacks';
import itemLocations from './modules/itemLocations';
import context from './modules/context';
import Vuex from 'vuex';

export default new Vuex.Store({
	strict: process.env.NODE_ENV !== 'production',
	state: {
		settings: {
			droppables: [],
			items: [],
			prizes: [],
		},
		randomizer_settings: {},
		sprites: [],
		loading: false,
	},
	modules: {
		prizePacks,
		itemLocations,
		context,
	},
	getters: {
		droppableLookup: state => {
			// determine if prizePacks is source of truth here.
			return state.settings.droppables.reduce((map, obj) => {
				map[obj.value] = obj;
				return map;
			}, {});
		},
		itemLookup: state => {
			// determine if itemLocations is source of truth here.
			return state.settings.items.concat(state.settings.prizes).reduce((map, obj) => {
				map[obj.value] = obj;
				return map;
			}, {});
		},
		locationLookup: state => {
			return state.itemLocations.locations.reduce((map, obj) => {
				map[obj.hash] = obj;
				return map;
			}, {});
		},
	},
	actions: {
		nukeStore({commit, dispatch}) {
			return Promise.all([
				dispatch('prizePacks/clearStorage'),
				dispatch('itemLocations/clearStorage'),
				dispatch('context/clearStorage'),
				localforage.removeItem('vt.custom.equipment'),
			]);
		},
		resetStore({commit, dispatch}) {
			commit('setLoading', true);
			commit('prizePacks/setPool', this.state.settings.droppables);
			commit('itemLocations/setItemPool', this.state.settings);
			commit('itemLocations/setLocations', this.state.settings.locations);

			return Promise.all([
				dispatch('prizePacks/initalize', this.state.settings.prizepacks),
				dispatch('itemLocations/initalize', this.state.settings.locations),
				dispatch('context/initalize'),
			]).then(() => {
				console.log('loaded!');
				commit('setLoading', false);
			});
		},
		getSprites({commit, dispatch}) {
			return axios.get(`/sprites`).then(response => {
				var sprites = response.data;
				sprites.push({
					author: "none",
					file: null,
					name: "Random",
				});
				commit('updateSprites', sprites);
			});
		},
		getItemSettings({commit, dispatch}) {
			commit('setLoading', true);
			return axios.get(`/randomizer/settings`).then(response => {
				commit('updateItemSettings', response.data);
			}).then(() => {
				commit('setLoading', false);
			});
		},
		getSettings({commit, dispatch}) {
			commit('setLoading', true);
			return axios.get(`/customizer/settings`).then(response => {
				commit('updateSettings', response.data);
				return dispatch('resetStore');
			});
		},
	},
	mutations: {
		updateSettings(state, settings) {
			state.settings = settings;
		},
		updateItemSettings(state, settings) {
			state.randomizer_settings = settings;
		},
		updateSprites(state, sprites) {
			state.sprites = sprites;
		},
		setLoading(state, loading) {
			state.loading = loading;
		},
	},
});
