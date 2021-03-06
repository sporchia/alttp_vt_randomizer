import localforage from "localforage";
import axios from "axios";
import Defaults from "./defaults";

function hasValue(value, array) {
  return (
    array.filter(v => {
      return value.value === v.value;
    }).length > 0
  );
}

function asMulti(object, mKey) {
  return Object.keys(object).map(key => {
    return {
      value: key,
      name: `randomizer.${mKey}.options.${key}`
    };
  });
}

export default {
  namespaced: true,
  state: {
    ...Defaults,
    options: {
      preset: [],
      glitches_required: [],
      item_placement: [],
      dungeon_items: [],
      accessibility: [],
      goal: [],
      tower_open: [],
      ganon_open: [],
      world_state: [],
      entrance_shuffle: [],
      boss_shuffle: [],
      enemy_shuffle: [],
      hints: [],
      weapons: [],
      item_pool: [],
      item_functionality: [],
      enemy_damage: [],
      enemy_health: [],
      spoiler: []
    },
    preset_map: {},
    initializing: true
  },
  getters: {},
  actions: {
    getItemSettings({ commit, dispatch }) {
      return axios
        .get(`/randomizer/settings`)
        .then(response => {
          commit("updateItemSettings", response.data);
        })
        .then(() =>
          Promise.all([
            dispatch("load", ["preset", "setPreset"]),
            dispatch("load", ["glitches_required", "setGlitchesRequired"]),
            dispatch("load", ["item_placement", "setItemPlacement"]),
            dispatch("load", ["dungeon_items", "setDungeonItems"]),
            dispatch("load", ["accessibility", "setAccessibility"]),
            dispatch("load", ["goal", "setGoal"]),
            dispatch("load", ["tower_open", "setTowerOpen"]),
            dispatch("load", ["ganon_open", "setGanonOpen"]),
            dispatch("load", ["world_state", "setWorldState"]),
            dispatch("load", ["entrance_shuffle", "setEntranceShuffle"]),
            dispatch("load", ["boss_shuffle", "setBossShuffle"]),
            dispatch("load", ["enemy_shuffle", "setEnemyShuffle"]),
            dispatch("load", ["hints", "setHints"]),
            dispatch("load", ["weapons", "setWeapons"]),
            dispatch("load", ["item_pool", "setItemPool"]),
            dispatch("load", ["item_functionality", "setItemFunctionality"]),
            dispatch("load", ["enemy_damage", "setEnemyDamage"]),
            dispatch("load", ["enemy_health", "setEnemyHealth"]),
            dispatch("load", ["spoilers", "setSpoiler"])
          ])
        )
        .then(() => {
          commit("setInitalizing", false);
        });
    },
    setPreset({ commit, state }, preset) {
      if (
        preset.value !== "custom" &&
        typeof state.preset_map[preset.value] !== "undefined"
      ) {
        commit(
          "setGlitchesRequired",
          state.preset_map[preset.value]["glitches_required"]
        );
        commit(
          "setItemPlacement",
          state.preset_map[preset.value]["item_placement"]
        );
        commit(
          "setDungeonItems",
          state.preset_map[preset.value]["dungeon_items"]
        );
        commit(
          "setAccessibility",
          state.preset_map[preset.value]["accessibility"]
        );
        commit("setGoal", state.preset_map[preset.value]["goal"]);
        commit("setTowerOpen", state.preset_map[preset.value]["tower_open"]);
        commit("setGanonOpen", state.preset_map[preset.value]["ganon_open"]);
        commit("setWorldState", state.preset_map[preset.value]["world_state"]);
        commit(
          "setEntranceShuffle",
          state.preset_map[preset.value]["entrance_shuffle"]
        );
        commit(
          "setBossShuffle",
          state.preset_map[preset.value]["boss_shuffle"]
        );
        commit(
          "setEnemyShuffle",
          state.preset_map[preset.value]["enemy_shuffle"]
        );
        commit("setHints", state.preset_map[preset.value]["hints"]);
        commit("setWeapons", state.preset_map[preset.value]["weapons"]);
        commit("setItemPool", state.preset_map[preset.value]["item_pool"]);
        commit(
          "setItemFunctionality",
          state.preset_map[preset.value]["item_functionality"]
        );
        commit(
          "setEnemyDamage",
          state.preset_map[preset.value]["enemy_damage"]
        );
        commit(
          "setEnemyHealth",
          state.preset_map[preset.value]["enemy_health"]
        );
      }

      commit("setPreset", preset);
    },
    async load({ commit, state }, [key, mutate]) {
      const value = await localforage.getItem(`randomizer.${key}`);
      if (value !== null && hasValue(value, state.options[key])) {
        commit(mutate, value);
      }
    },
    setGlitchesRequired({ commit, state }, value) {
      commit("setGlitchesRequired", value);

      if (
        ["none", "no_logic"].indexOf(state.glitches_required.value) === -1 &&
        state.entrance_shuffle.value !== "none"
      ) {
        commit("setEntranceShuffle", "none");
      }
    },
    setItemPlacement({ commit, state }, value) {
      commit("setItemPlacement", value);

      if (
        state.item_placement.value !== "advanced" &&
        state.entrance_shuffle.value !== "none"
      ) {
        commit("setEntranceShuffle", "none");
      }
      if (
        state.item_placement.value !== "advanced" &&
        state.item_pool.value === "crowd_control"
      ) {
        commit("setItemPool", "expert");
      }
    },
    setDungeonItems({ commit, state }, value) {
      commit("setDungeonItems", value);

      if (
        ["full", "standard"].indexOf(state.dungeon_items.value) === -1 &&
        state.entrance_shuffle.value !== "none"
      ) {
        commit("setEntranceShuffle", "none");
      }
    },
    setGoal({ commit, state }, value) {
      commit("setGoal", value);

      if (state.goal.value === "dungeons") {
        commit("setGanonOpen", "7");
      }
    },
    setGanonOpen({ commit, state }, value) {
      commit("setGanonOpen", value);

      if (state.ganon_open.value !== "7" && state.goal.value === "dungeons") {
        commit("setGoal", "ganon");
      }
    },
    setWorldState({ commit }, value) {
      commit("setWorldState", value);
    },
    setEntranceShuffle({ commit, state }, value) {
      commit("setEntranceShuffle", value);

      // rules when ER is enabled, hopefully we can reduce this section to be
      // completely removed in the future.
      if (state.entrance_shuffle.value !== "none") {
        if (
          ["none", "no_logic"].indexOf(state.glitches_required.value) === -1
        ) {
          commit("setGlitchesRequired", "none");
        }

        if (state.item_placement.value !== "advanced") {
          commit("setItemPlacement", "advanced");
        }

        if (["full", "standard"].indexOf(state.dungeon_items.value) === -1) {
          commit("setDungeonItems", "standard");
        }
      }
    },
    setItemPool({ commit, state }, value) {
      commit("setItemPool", value);

      if (
        state.item_pool.value === "crowd_control" &&
        state.item_placement.value !== "advanced"
      ) {
        commit("setItemPlacement", "advanced");
      }
    }
  },
  mutations: {
    updateItemSettings(
      state,
      {
        presets,
        glitches_required,
        item_placement,
        dungeon_items,
        accessibility,
        goals,
        tower_open,
        ganon_open,
        world_state,
        entrance_shuffle,
        boss_shuffle,
        enemy_shuffle,
        hints,
        weapons,
        item_pool,
        item_functionality,
        enemy_damage,
        enemy_health,
        spoilers
      }
    ) {
      state.options.preset = asMulti(presets, "preset");
      state.options.glitches_required = asMulti(
        glitches_required,
        "glitches_required"
      );
      state.options.item_placement = asMulti(item_placement, "item_placement");
      state.options.dungeon_items = asMulti(dungeon_items, "dungeon_items");
      state.options.accessibility = asMulti(accessibility, "accessibility");
      state.options.goal = asMulti(goals, "goal");
      state.options.tower_open = asMulti(tower_open, "tower_open");
      state.options.ganon_open = asMulti(ganon_open, "ganon_open");
      state.options.world_state = asMulti(world_state, "world_state");
      state.options.entrance_shuffle = asMulti(
        entrance_shuffle,
        "entrance_shuffle"
      );
      state.options.boss_shuffle = asMulti(boss_shuffle, "boss_shuffle");
      state.options.enemy_shuffle = asMulti(enemy_shuffle, "enemy_shuffle");
      state.options.hints = asMulti(hints, "hints");
      state.options.weapons = asMulti(weapons, "weapons");
      state.options.item_pool = asMulti(item_pool, "item_pool");
      state.options.item_functionality = asMulti(
        item_functionality,
        "item_functionality"
      );
      state.options.enemy_damage = asMulti(enemy_damage, "enemy_damage");
      state.options.enemy_health = asMulti(enemy_health, "enemy_health");
      state.options.spoiler = asMulti(spoilers, "spoiler");
      state.preset_map = presets;
    },
    setPreset(state, value) {
      if (typeof value === "string") {
        value = state.options.preset.find(o => o.value === value);
      }
      state.preset = value;
      localforage.setItem("randomizer.preset", value);
    },
    setGlitchesRequired(state, value) {
      if (typeof value === "string") {
        value = state.options.glitches_required.find(o => o.value === value);
      }
      state.glitches_required = value;
      localforage.setItem("randomizer.glitches_required", value);
    },
    setItemPlacement(state, value) {
      if (typeof value === "string") {
        value = state.options.item_placement.find(o => o.value === value);
      }
      state.item_placement = value;
      localforage.setItem("randomizer.item_placement", value);
    },
    setDungeonItems(state, value) {
      if (typeof value === "string") {
        value = state.options.dungeon_items.find(o => o.value === value);
      }
      state.dungeon_items = value;
      localforage.setItem("randomizer.dungeon_items", value);
    },
    setAccessibility(state, value) {
      if (typeof value === "string") {
        value = state.options.accessibility.find(o => o.value === value);
      }
      state.accessibility = value;
      localforage.setItem("randomizer.accessibility", value);
    },
    setGoal(state, value) {
      if (typeof value === "string") {
        value = state.options.goal.find(o => o.value === value);
      }
      state.goal = value;
      localforage.setItem("randomizer.goal", value);
    },
    setTowerOpen(state, value) {
      if (typeof value === "string") {
        value = state.options.tower_open.find(o => o.value === value);
      }
      state.tower_open = value;
      localforage.setItem("randomizer.tower_open", value);
    },
    setGanonOpen(state, value) {
      if (typeof value === "string") {
        value = state.options.ganon_open.find(o => o.value === value);
      }
      state.ganon_open = value;
      localforage.setItem("randomizer.ganon_open", value);
    },
    setWorldState(state, value) {
      if (typeof value === "string") {
        value = state.options.world_state.find(o => o.value === value);
      }
      state.world_state = value;
      localforage.setItem("randomizer.world_state", value);
    },
    setEntranceShuffle(state, value) {
      if (typeof value === "string") {
        value = state.options.entrance_shuffle.find(o => o.value === value);
      }
      state.entrance_shuffle = value;
      localforage.setItem("randomizer.entrance_shuffle", value);
    },
    setBossShuffle(state, value) {
      if (typeof value === "string") {
        value = state.options.boss_shuffle.find(o => o.value === value);
      }
      state.boss_shuffle = value;
      localforage.setItem("randomizer.boss_shuffle", value);
    },
    setEnemyShuffle(state, value) {
      if (typeof value === "string") {
        value = state.options.enemy_shuffle.find(o => o.value === value);
      }
      state.enemy_shuffle = value;
      localforage.setItem("randomizer.enemy_shuffle", value);
    },
    setHints(state, value) {
      if (typeof value === "string") {
        value = state.options.hints.find(o => o.value === value);
      }
      state.hints = value;
      localforage.setItem("randomizer.hints", value);
    },
    setWeapons(state, value) {
      if (typeof value === "string") {
        value = state.options.weapons.find(o => o.value === value);
      }
      state.weapons = value;
      localforage.setItem("randomizer.weapons", value);
    },
    setItemPool(state, value) {
      if (typeof value === "string") {
        value = state.options.item_pool.find(o => o.value === value);
      }
      state.item_pool = value;
      localforage.setItem("randomizer.item_pool", value);
    },
    setItemFunctionality(state, value) {
      if (typeof value === "string") {
        value = state.options.item_functionality.find(o => o.value === value);
      }
      state.item_functionality = value;
      localforage.setItem("randomizer.item_functionality", value);
    },
    setEnemyDamage(state, value) {
      if (typeof value === "string") {
        value = state.options.enemy_damage.find(o => o.value === value);
      }
      state.enemy_damage = value;
      localforage.setItem("randomizer.enemy_damage", value);
    },
    setEnemyHealth(state, value) {
      if (typeof value === "string") {
        value = state.options.enemy_health.find(o => o.value === value);
      }
      state.enemy_health = value;
      localforage.setItem("randomizer.enemy_health", value);
    },
    setSpoiler(state, value) {
      if (typeof value === "string") {
        value = state.options.spoiler.find(o => o.value === value);
      }
      state.spoiler = value;
      localforage.setItem("randomizer.spoiler", value);
    },
    setInitalizing(state, init) {
      state.initializing = init;
    }
  }
};
