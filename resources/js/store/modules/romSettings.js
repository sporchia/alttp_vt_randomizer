import localforage from "localforage";

function hasValue(value, array) {
  return (
    array.filter(v => {
      return value.value === v.value;
    }).length > 0
  );
}

export default {
  namespaced: true,
  state: {
    heartSpeed: { value: "half", name: "rom.settings.heart_speeds.half" },
    menuSpeed: { value: "normal", name: "rom.settings.menu_speeds.normal" },
    heartColor: { value: "red", name: "rom.settings.heart_colors.red" },
    quickswap: false,
    musicOn: true,
    paletteShuffle: false,
    reduceFlashing: false,
    shuffleSfx: false,
    options: {
      heartSpeed: [
        { value: "off", name: "rom.settings.heart_speeds.off" },
        { value: "double", name: "rom.settings.heart_speeds.double" },
        { value: "normal", name: "rom.settings.heart_speeds.normal" },
        { value: "half", name: "rom.settings.heart_speeds.half" },
        { value: "quarter", name: "rom.settings.heart_speeds.quarter" }
      ],
      menuSpeed: [
        { value: "instant", name: "rom.settings.menu_speeds.instant" },
        { value: "fast", name: "rom.settings.menu_speeds.fast" },
        { value: "normal", name: "rom.settings.menu_speeds.normal" },
        { value: "slow", name: "rom.settings.menu_speeds.slow" }
      ],
      heartColor: [
        { value: "blue", name: "rom.settings.heart_colors.blue" },
        { value: "green", name: "rom.settings.heart_colors.green" },
        { value: "red", name: "rom.settings.heart_colors.red" },
        { value: "yellow", name: "rom.settings.heart_colors.yellow" },
        { value: "random", name: "rom.settings.heart_colors.random" }
      ]
    },
    initializing: true
  },
  getters: {},
  actions: {
    initialize({ commit, dispatch }) {
      return Promise.all([
        dispatch("load", ["heart_speeds", "setHeartSpeed"]),
        dispatch("load", ["menu_speeds", "setMenuSpeed"]),
        dispatch("load", ["heart_colors", "setHeartColor"]),
        dispatch("load", ["quickswap", "setQuickswap"]),
        dispatch("load", ["music_on", "setMusicOn"]),
        dispatch("load", ["palette_shuffle", "setPaletteShuffle"]),
        dispatch("load", ["reduce_flashing", "setReduceFlashing"]),
        dispatch("load", ["shuffle_sfx", "setShuffleSfx"]),
      ]).then(() => {
        commit("setInitalizing", false);
      });
    },
    async load({ commit, state }, [key, mutate]) {
      const value = await localforage.getItem(`rom.${key}`);
      if (
        value !== null &&
        (!state.options[key] || hasValue(value, state.options[key]))
      ) {
        commit(mutate, value);
      }
    }
  },
  mutations: {
    setHeartSpeed(state, heartSpeed) {
      state.heartSpeed = heartSpeed;
      localforage.setItem("rom.heart_speeds", heartSpeed);
    },
    setMenuSpeed(state, menuSpeed) {
      state.menuSpeed = menuSpeed;
      localforage.setItem("rom.menu_speeds", menuSpeed);
    },
    setHeartColor(state, heartColor) {
      state.heartColor = heartColor;
      localforage.setItem("rom.heart_colors", heartColor);
    },
    setQuickswap(state, quickswap) {
      state.quickswap = quickswap;
      localforage.setItem("rom.quickswap", quickswap);
    },
    setMusicOn(state, musicOn) {
      state.musicOn = musicOn;
      localforage.setItem("rom.music_on", musicOn);
    },
    setPaletteShuffle(state, paletteShuffle) {
      state.paletteShuffle = paletteShuffle;
      localforage.setItem("rom.palette_shuffle", paletteShuffle);
    },
    setReduceFlashing(state, reduceFlashing) {
      state.reduceFlashing = reduceFlashing;
      localforage.setItem("rom.reduce_flashing", reduceFlashing);
    },
    setShuffleSfx(state, shuffleSfx) {
      state.shuffleSfx = shuffleSfx;
      localforage.setItem("rom.shuffle_sfx", shuffleSfx);
    },
    setInitalizing(state, init) {
      state.initializing = init;
    }
  }
};
