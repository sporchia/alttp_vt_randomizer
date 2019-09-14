import localforage from "localforage";

export default {
  namespaced: true,
  state: {
    pool: [],
    packs: {},
    flatpacks: {},
    initializing: true
  },
  getters: {
    flatPool: state => {
      return state.pool.reduce((map, obj) => {
        if (obj.value == "auto_fill") return map;
        map[obj.value] = Number(obj.count);
        return map;
      }, {});
    }
  },
  actions: {
    clearStorage({ commit, dispatch, state }) {
      return Promise.all([
        localforage.removeItem("vt.custom.prizepacks"),
        localforage.removeItem("vt.custom.drops")
      ]);
    },
    initalize(
      { commit, dispatch, state, rootState, getters, rootGetters },
      packs
    ) {
      var commit_packs = {};
      var commit_flatpacks = {};
      for (var i = 0; i < packs.length; ++i) {
        commit_packs[packs[i].name] = Array(packs[i].slots).fill(
          rootGetters.droppableLookup["auto_fill"]
        );
        commit_flatpacks[packs[i].name] = Array(packs[i].slots).fill(
          "auto_fill"
        );
      }
      commit("setPacks", commit_packs);
      commit("setFlatPacks", commit_flatpacks);

      return localforage
        .getItem("vt.custom.prizepacks")
        .then(value => {
          if (value === null) {
            return;
          }
          Object.keys(value).forEach(pack => {
            value[pack].forEach((item, slot) => {
              dispatch("setDrop", {
                pack: pack,
                slot: slot,
                drop: item,
                save: false
              });
            });
          });
        })
        .then(() => {
          return localforage.getItem("vt.custom.drops").then(value => {
            if (value === null) {
              return;
            }

            Object.keys(value).forEach(name => {
              if (rootGetters.droppableLookup[name]) {
                dispatch("setDropCount", {
                  drop: rootGetters.droppableLookup[name],
                  count: value[name],
                  save: false
                });
              }
            });
          });
        })
        .then(() => {
          return commit("setInitalizing", false);
        });
    },
    setDrop({ commit, state, rootState, getters, rootGetters }, data) {
      data = {
        save: true,
        ...data
      };
      if (rootGetters.droppableLookup[data.drop]) {
        data.drop = rootGetters.droppableLookup[data.drop];
      }
      commit("setDrop", data);
      if (data.save) {
        localforage.setItem("vt.custom.prizepacks", state.flatpacks);
        // setDrop can side affect counts
        localforage.setItem("vt.custom.drops", getters.flatPool);
      }
    },
    setDropCount({ commit, state, getters }, data) {
      data = {
        save: true,
        ...data
      };
      commit("setDropCount", data);
      if (data.save) {
        localforage.setItem("vt.custom.drops", getters.flatPool);
      }
    }
  },
  mutations: {
    setDrop(state, data) {
      var previous = state.packs[data.pack][data.slot];
      state.packs[data.pack][data.slot] = data.drop;
      state.flatpacks[data.pack][data.slot] = data.drop.value;

      previous.placed--;
      if (previous.hasOwnProperty("count")) {
        if (previous.neg_count < 0) {
          previous.neg_count++;
        } else {
          previous.count++;
        }
      }

      data.drop.placed++;
      if (data.drop.hasOwnProperty("count")) {
        if (data.drop.count > 0) {
          data.drop.count--;
        } else {
          data.drop.neg_count = data.drop.neg_count
            ? data.drop.neg_count - 1
            : -1;
        }
      }
    },
    setDropCount(state, data) {
      state.pool.forEach(item => {
        if (item === data.drop) {
          item.count = data.count;
        }
      });
    },
    setPool(state, pool) {
      state.pool = pool;
    },
    setPacks(state, packs) {
      state.packs = packs;
    },
    setFlatPacks(state, packs) {
      state.flatpacks = packs;
    },
    setInitalizing(state, init) {
      state.initializing = init;
    }
  }
};
