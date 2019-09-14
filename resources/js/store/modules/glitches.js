import localforage from "localforage";

export default {
  namespaced: true,
  state: {
    settings: {
      canBombJump: false,
      canBootsClip: false,
      canBunnyRevive: false,
      canBunnySurf: false,
      canDungeonRevive: false,
      canFakeFlipper: false,
      canMirrorClip: false,
      canMirrorWrap: false,
      canOneFrameClipOW: false,
      canOWYBA: false,
      canSuperBunny: false,
      canSuperSpeed: false,
      canWaterFairyRevive: false,
      canWaterWalk: false
    },
    initializing: true
  },
  actions: {
    clearStorage() {
      return localforage.removeItem("vt.custom.glitches");
    },
    initalize({ commit, dispatch, state }) {
      return localforage
        .getItem("vt.custom.glitches")
        .then(value => {
          if (value === null) {
            localforage.setItem("vt.custom.glitches", state.settings);
            return;
          }
          Object.keys(value).forEach(name => {
            dispatch("setSetting", {
              key: name,
              value: value[name],
              save: false
            });
          });
        })
        .then(() => {
          return commit("setInitalizing", false);
        });
    },
    setSetting({ commit, state }, data) {
      data = {
        save: true,
        ...data
      };
      commit("setSetting", data);
      if (data.save) {
        localforage.setItem("vt.custom.glitches", state.settings);
      }
    }
  },
  mutations: {
    setSetting(state, data) {
      state.settings[data.key] = data.value;
    },
    setSettings(state, settings) {
      state.settings = settings;
    },
    setInitalizing(state, init) {
      state.initializing = init;
    }
  }
};
