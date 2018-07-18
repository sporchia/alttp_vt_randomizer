import localforage from 'localforage';

export default {
	namespaced: true,
	state: {
		pool: {
			items: [],
			prizes: [],
			bottles: [],
			medallions: [],
		},
		locations: [],
		initializing: true,
	},
	getters: {
		flatItemPool: state => {
			return state.pool.items.reduce((map, obj) => {
				if (obj.value == 'auto_fill') return map;
				map[obj.value] = Number(obj.count);
				return map;
			}, {});
		},
		flatLocations: state => {
			return state.locations.reduce((map, location) => {
				if (!location.item || location.item.value == 'auto_fill') return map;
				map[location.hash] = location.item.value;
				return map;
			}, {});
		}
	},
	actions: {
		initalize({commit, dispatch, state, rootState, rootGetters}, locations) {
			var commit_locations = [];
			state.locations.forEach(location => {
				commit_locations.push({
					...location,
					item: rootGetters.itemLookup['auto_fill'],
				});
			});
			commit('setLocations', commit_locations);

			return localforage.getItem('vt.custom.locations').then(value => {
				if (value === null) {
					return;
				}
				Object.keys(value).forEach(hash => {
					dispatch('setLocation', {
						item: value[hash],
						location: rootGetters.locationLookup[hash],
						save: false,
					});
				});
			}).then(() => {
				return localforage.getItem('vt.custom.items').then(value => {
					if (value === null) {
						return;
					}

					Object.keys(value).forEach(name => {
						if (rootGetters.itemLookup[name]) {
							// TODO: v3 compat, remove in v5
							var lookupName = name.replace(/^item-count-/);
							dispatch('setItemCount', {
								item: rootGetters.itemLookup[lookupName],
								count: value[name],
								save: false,
							})
						}
					});
				})
			}).then(() => {
				return commit('setInitalizing', false);
			});
		},
		setLocation({commit, state, rootState, getters, rootGetters}, data) {
			data = {
				save: true,
				lookup: rootGetters.itemLookup,
				...data,
			};
			if (rootGetters.itemLookup[data.item]) {
				data.item = rootGetters.itemLookup[data.item];
			}
			commit('setLocation', data);
			if (data.save) {
				localforage.setItem('vt.custom.locations', getters.flatLocations);
				// setLocation can side affect counts
				localforage.setItem('vt.custom.items', getters.flatItemPool);
			}
		},
		setItemCount({commit, state, getters}, data) {
			data = {
				save: true,
				...data,
			};
			commit('setItemCount', data);
			if (data.save) {
				localforage.setItem('vt.custom.items', getters.flatItemPool);
			}
		},
	},
	mutations: {
		setLocation(state, data) {
			for (var i = 0; i < state.locations.length; ++i) {
				if (state.locations[i] == data.location) {
					var previous = state.locations[i].item;
					break;
				}
			}
			data.location.item = data.item;

			if (data.location.class == 'prizes') {
				previous.$isDisabled = false;
				data.item.$isDisabled = true;
			}

			// we only pool the item type locations
			if (data.location.class != 'items') {
				return;
			}

			previous.placed--;
			if (previous.value.indexOf('Bottle') !== -1) {
				previous = data.lookup['BottleWithRandom'];
			}
			if (previous.value.indexOf('Shield') !== -1) {
				previous = data.lookup['ProgressiveShield'];
			}
			if (previous.value.indexOf('Sword') !== -1) {
				previous = data.lookup['ProgressiveSword'];
			}
			if (previous.value.indexOf('Mail') !== -1) {
				previous = data.lookup['ProgressiveArmor'];
			}
			if (previous.hasOwnProperty('count')) {
				if (previous.neg_count < 0) {
					previous.neg_count++;
				} else {
					previous.count++;
				}
			}

			data.item.placed++;
			if (data.item.value.indexOf('Bottle') !== -1) {
				data.item = data.lookup['BottleWithRandom'];
			}
			if (data.item.value.indexOf('Shield') !== -1) {
				data.item = data.lookup['ProgressiveShield'];
			}
			if (data.item.value.indexOf('Sword') !== -1) {
				data.item = data.lookup['ProgressiveSword'];
			}
			if (data.item.value.indexOf('Mail') !== -1) {
				data.item = data.lookup['ProgressiveArmor'];
			}
			if (data.item.hasOwnProperty('count')) {
				if (data.item.count > 0) {
					data.item.count--;
				} else {
					data.item.neg_count = data.item.neg_count ? data.item.neg_count - 1 : -1;
				}
			}
		},
		setItemCount(state, data) {
			state.pool.items.forEach(item => {
				if (item === data.item) {
					item.count = data.count;
				}
			});
		},
		setItemPool(state, pool) {
			state.pool.items = pool.items;
			state.pool.prizes = pool.prizes;
			state.pool.bottles = pool.bottles;
			state.pool.medallions = pool.medallions;
		},
		setLocations(state, locations) {
			state.locations = locations;
		},
		setInitalizing(state, init) {
			state.initializing = init;
		},
	},
};
