import axios from "axios";

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
      spoiler: [
        {
          value: "off",
          name: "randomizer.spoiler.options.off"
        },
        {
          value: "on",
          name: "randomizer.spoiler.options.on"
        },
        {
          value: "generate",
          name: "randomizer.spoiler.options.generate"
        }
      ]
    },
    preset_map: {},
    initializing: true
  },
  actions: {
    getItemSettings({ commit }) {
      return axios
        .get(`/randomizer/settings`)
        .then(response => {
          commit("updateItemSettings", response.data);
        })
        .then(() => {
          commit("setInitalizing", false);
        });
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
        enemy_health
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
      state.preset_map = presets;
    },
    setInitalizing(state, init) {
      state.initializing = init;
    }
  }
};
