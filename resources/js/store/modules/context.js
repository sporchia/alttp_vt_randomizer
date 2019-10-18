import localforage from "localforage";

export default {
  namespaced: true,
  state: {
    settings: {
      "item.Goal.Required": "",
      "item.require.Lamp": false,
      "item.value.BlueClock": "",
      "item.value.GreenClock": "",
      "item.value.RedClock": "",
      "item.value.Rupoor": "",
      "prize.crossWorld": true,
      "prize.shuffleCrystals": true,
      "prize.shufflePendants": true,
      "region.bossNormalLocation": true,
      "region.wildBigKeys": false,
      "region.wildCompasses": false,
      "region.wildKeys": false,
      "region.wildMaps": false,
      "rom.dungeonCount": "off",
      "rom.freeItemMenu": false,
      "rom.freeItemText": false,
      "rom.mapOnPickup": false,
      "rom.timerMode": "off",
      "rom.timerStart": "",
      "rom.rupeeBow": false,
      "rom.genericKeys": false,
      "spoil.BootsLocation": false
    },
    initializing: true
  },
  actions: {
    clearStorage() {
      return localforage.removeItem("vt.custom.settings");
    },
    initalize({ commit, dispatch, state }) {
      return localforage
        .getItem("vt.custom.settings")
        .then(value => {
          if (value === null) {
            localforage.setItem("vt.custom.settings", state.settings);
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
        localforage.setItem("vt.custom.settings", state.settings);
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
