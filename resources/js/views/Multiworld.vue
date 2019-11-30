<template>
  <div id="seed-generate">
    <div v-if="error" class="alert alert-danger" role="alert">
      <button type="button" class="close" aria-label="Close">
        <img class="icon" src="/i/svg/x.svg" alt="clear" @click="error = false" />
      </button>
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">{{ $t('error.title') }}:</span>
      <span class="message">{{ this.error }}</span>
    </div>

    <div
      v-if="!gameLoaded && !generating && !$store.state.multiworld.initializing"
      class="card border-success my-1"
    >
      <div class="card-header bg-success card-heading-btn">
        <h3 class="card-title text-white">{{ $t('multiworld.title') }}</h3>
      </div>
      <tabs
        v-show="!$store.state.loading"
        class="think"
        nav-type="tabs"
        :sticky="true"
        :actions="worldList.length < 8 ? [{name:'+ Add World'}] : []"
        @click="onActionClick"
      >
        <tab
          :name="'World ' + world_id"
          v-for="world_id in worldList"
          :key="world_id"
          :selected="selectedWorldId === world_id"
        >
          <div class="card-body">
            <h2>World: {{ world_id }}</h2>
            <div class="card-body">
              <div class="card border-info my-1">
                <div class="card-body">
                  <div class="row">
                    <div class="col my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].preset"
                        @input="setPreset"
                        :options="optionsPreset"
                      >
                        <template v-slot:default>{{ $t('randomizer.preset.title') }}</template>
                        <template v-slot:appends v-if="worlds[world_id].preset.value !== 'custom'">
                          <button
                            class="btn btn-outline-secondary"
                            type="button"
                            @click="setPreset('custom', world_id)"
                          >{{ $t('randomizer.preset.customize')}}</button>
                        </template>
                      </Select>
                    </div>
                  </div>
                </div>
                <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.placement.title') }}</h5>
                <div class="card-body">
                  <div class="row" v-if="!editable[world_id]">
                    <div
                      class="col-xl-3 col-lg-6 my-1"
                    >{{ $t('randomizer.glitches_required.title') }}: {{ $t(worlds[world_id].glitches_required.name) }}</div>
                    <div
                      class="col-xl-3 col-lg-6 my-1"
                    >{{ $t('randomizer.item_placement.title') }}: {{ $t(worlds[world_id].item_placement.name) }}</div>
                    <div
                      class="col-xl-3 col-lg-6 my-1"
                    >{{ $t('randomizer.dungeon_items.title') }}: {{ $t(worlds[world_id].dungeon_items.name) }}</div>
                    <div
                      class="col-xl-3 col-lg-6 my-1"
                    >{{ $t('randomizer.accessibility.title') }}: {{ $t(worlds[world_id].accessibility.name) }}</div>
                  </div>
                  <div class="row" v-if="editable[world_id]">
                    <div class="col-xl-6 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].glitches_required"
                        @input="setGlitchesRequired"
                        :options="optionsGlitchesRequired"
                      >{{ $t('randomizer.glitches_required.title') }}</Select>
                    </div>
                    <div class="col-xl-6 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].item_placement"
                        @input="setItemPlacement"
                        :options="optionsItemPlacement"
                      >{{ $t('randomizer.item_placement.title') }}</Select>
                    </div>
                    <div class="col-xl-6 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].dungeon_items"
                        @input="setDungeonItems"
                        :options="optionsDungeonItems"
                      >{{ $t('randomizer.dungeon_items.title') }}</Select>
                    </div>
                    <div class="col-xl-6 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].accessibility"
                        @input="setAccessibility"
                        :options="optionsAccessibility"
                      >{{ $t('randomizer.accessibility.title') }}</Select>
                    </div>
                  </div>
                  <div
                    v-if="worlds[world_id].glitches_required.value !== 'none'"
                    class="logic-warning text-danger"
                    v-html="$t('randomizer.glitches_required.glitch_warning')"
                  />
                </div>
                <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.goal.title') }}</h5>
                <div class="card-body">
                  <div class="row" v-if="!editable[world_id]">
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.goal.title') }}: {{ $t(worlds[world_id].goal.name) }}</div>
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.tower_open.title') }}: {{ $t(worlds[world_id].tower_open.name) }}</div>
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.ganon_open.title') }}: {{ $t(worlds[world_id].ganon_open.name) }}</div>
                  </div>
                  <div class="row" v-if="editable[world_id]">
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].goal"
                        @input="setGoal"
                        :options="optionsGoal"
                      >{{ $t('randomizer.goal.title') }}</Select>
                    </div>
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].tower_open"
                        @input="setTowerOpen"
                        :options="optionsTowerOpen"
                      >{{ $t('randomizer.tower_open.title') }}</Select>
                    </div>
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].ganon_open"
                        @input="setGanonOpen"
                        :options="optionsGanonOpen"
                      >{{ $t('randomizer.ganon_open.title') }}</Select>
                    </div>
                  </div>
                </div>
                <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.gameplay.title') }}</h5>
                <div class="card-body" v-if="!editable[world_id]">
                  <div class="row">
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.world_state.title') }}: {{ $t(worlds[world_id].world_state.name) }}</div>
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.entrance_shuffle.title') }}: {{ $t(worlds[world_id].entrance_shuffle.name) }}</div>
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.hints.title') }}: {{ $t(worlds[world_id].hints.name) }}</div>
                  </div>
                </div>
                <div class="card-body" v-if="editable[world_id]">
                  <div class="row">
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].world_state"
                        @input="setWorldState"
                        :options="optionsWorldState"
                      >{{ $t('randomizer.world_state.title') }}</Select>
                    </div>
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].entrance_shuffle"
                        @input="setEntranceShuffle"
                        :options="optionsEntranceShuffle"
                      >{{ $t('randomizer.entrance_shuffle.title') }}</Select>
                    </div>
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].hints"
                        @input="setHints"
                        :options="optionsHints"
                      >{{ $t('randomizer.hints.title') }}</Select>
                    </div>
                  </div>
                </div>
                <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.difficulty.title') }}</h5>
                <div class="card-body">
                  <div class="row" v-if="!editable[world_id]">
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.weapons.title') }}: {{ $t(worlds[world_id].weapons.name) }}</div>
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.item_pool.title') }}: {{ $t(worlds[world_id].item_pool.name) }}</div>
                    <div
                      class="col-xl-4 col-lg-6 my-1"
                    >{{ $t('randomizer.item_functionality.title') }}: {{ $t(worlds[world_id].item_functionality.name) }}</div>
                  </div>
                  <div class="row" v-if="editable[world_id]">
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].weapons"
                        @input="setWeapons"
                        :options="optionsWeapons"
                      >{{ $t('randomizer.weapons.title') }}</Select>
                    </div>
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].item_pool"
                        @input="setItemPool"
                        :options="optionsItemPool"
                      >
                        {{ $t('randomizer.item_pool.title') }}
                        <sup
                          v-if="worlds[world_id].item_pool.value === 'crowd_control'"
                        >*</sup>
                      </Select>
                    </div>
                    <div class="col-xl-4 col-lg-6 my-1">
                      <Select
                        :sid="world_id"
                        :value="worlds[world_id].item_functionality"
                        @input="setItemFunctionality"
                        :options="optionsItemFunctionality"
                      >{{ $t('randomizer.item_functionality.title') }}</Select>
                    </div>
                  </div>
                  <div
                    v-if="worlds[world_id].item_pool.value === 'crowd_control'"
                    class="logic-warning text-info"
                    v-html="$t('randomizer.item_pool.crowd_control_warning')"
                  />
                </div>
              </div>
            </div>
          </div>
        </tab>
      </tabs>
      <div class="card-footer">
        <div class="row">
          <div class="col-md">
            <div class="btn-group btn-flex" role="group"></div>
          </div>
          <div class="col-md">
            <div class="btn-group btn-flex" role="group">
              <button
                class="btn btn-info w-50 text-center"
                :disabled="generating"
                @click="generateMultiworld"
              >{{ $t('multiworld.generate') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <ins
      class="adsbygoogle"
      style="display:inline-block;width:100%;height:90px"
      data-ad-client="ca-pub-5161309967767506"
      data-ad-slot="9849787408"
    ></ins>

    <div v-show="generating" class="center">
      <div class="loading" />
      <h1>{{ $t('randomizer.generate.generating') }}</h1>
    </div>
  </div>
</template>

<script>
import FileSaver from "file-saver";
import Select from "../components/Select.vue";
import Tab from "../components/VTTab.vue";
import Tabs from "../components/VTTabs.vue";
import axios from "axios";
import { mapState } from "vuex";

export default {
  components: {
    Tab: Tab,
    Tabs: Tabs,
    Select
  },
  data() {
    return {
      worldList: [1, 2],
      selectedWorldId: 1,
      error: false,
      generating: false,
      gameLoaded: false,
      tournament: false,
      spoilers: false
    };
  },
  created() {
    this.$store.dispatch("multiworld/getItemSettings");
  },
  methods: {
    setPreset(value, worldId) {
      this.$store.dispatch("multiworld/setPreset", { preset: value, worldId });
    },
    setGlitchesRequired(value, worldId) {
      this.$store.dispatch("multiworld/setGlitchesRequired", {
        value,
        worldId
      });
    },
    setItemPlacement(value, worldId) {
      this.$store.dispatch("multiworld/setItemPlacement", { value, worldId });
    },
    setDungeonItems(value, worldId) {
      this.$store.dispatch("multiworld/setDungeonItems", { value, worldId });
    },
    setAccessibility(value, worldId) {
      this.$store.commit("multiworld/setAccessibility", { value, worldId });
    },
    setGoal(value, worldId) {
      this.$store.dispatch("multiworld/setGoal", { value, worldId });
    },
    setGanonOpen(value, worldId) {
      this.$store.dispatch("multiworld/setGanonOpen", { value, worldId });
    },
    setTowerOpen(value, worldId) {
      this.$store.commit("multiworld/setTowerOpen", { value, worldId });
    },
    setWorldState(value, worldId) {
      this.$store.dispatch("multiworld/setWorldState", { value, worldId });
    },
    setEntranceShuffle(value, worldId) {
      this.$store.dispatch("multiworld/setEntranceShuffle", { value, worldId });
    },
    setHints(value, worldId) {
      this.$store.commit("multiworld/setHints", { value, worldId });
    },
    setItemPool(value, worldId) {
      this.$store.dispatch("multiworld/setItemPool", { value, worldId });
    },
    setWeapons(value, worldId) {
      this.$store.commit("multiworld/setWeapons", { value, worldId });
    },
    setItemFunctionality(value, worldId) {
      this.$store.commit("multiworld/setItemFunctionality", { value, worldId });
    },
    generateMultiworld() {
      this.error = false;
      this.generating = true;
      return new Promise((resolve, reject) => {
        this.gameLoaded = false;
        // convert page to a useful payload
        const payload = Object.keys(this.worlds).reduce((result, key) => {
          // filter out unused worlds
          if (this.worldList.indexOf(Number(key)) === -1) {
            return result;
          }
          const part = { ...this.worlds[key] };
          result[key] = Object.keys(part).reduce((result, key) => {
            result[key] = part[key].value;
            return result;
          }, {});
          return result;
        }, {});
        axios
          .post(`/api/multiworld`, {
            worlds: { ...payload },
            lang: document.documentElement.lang
          })
          .catch(error => {
            if (error.response) {
              switch (error.response.status) {
                case 429:
                  this.error = this.$i18n.t("error.429");

                  break;
                default:
                  this.error = this.$i18n.t("error.failed_generation");
              }
            }

            reject(error);
          })
          .finally(() => {
            this.generating = false;
          });
      });
    },
    onError(error) {
      this.error = error;
    },
    onActionClick(action) {
      if (action.name === "+ Add World") {
        const newWorldId = this.worldList.length + 1;
        this.worldList.push(newWorldId);
        this.selectedWorldId = newWorldId;
      }
    }
  },
  computed: {
    ...mapState("multiworld", {
      worlds: state => state.worlds,
      optionsPreset: state => state.options.preset,
      optionsGlitchesRequired: state => state.options.glitches_required,
      optionsItemPlacement: state => state.options.item_placement,
      optionsDungeonItems: state => state.options.dungeon_items,
      optionsAccessibility: state => state.options.accessibility,
      optionsGoal: state => state.options.goal,
      optionsTowerOpen: state => state.options.tower_open,
      optionsGanonOpen: state => state.options.ganon_open,
      optionsWorldState: state => state.options.world_state,
      optionsEntranceShuffle: state => state.options.entrance_shuffle,
      optionsHints: state => state.options.hints,
      optionsWeapons: state => state.options.weapons,
      optionsItemPool: state => state.options.item_pool,
      optionsItemFunctionality: state => state.options.item_functionality
    }),
    editable() {
      return {
        1: this.worlds[1].preset.value === "custom",
        2: this.worlds[2].preset.value === "custom",
        3: this.worlds[3].preset.value === "custom",
        4: this.worlds[4].preset.value === "custom",
        5: this.worlds[5].preset.value === "custom",
        6: this.worlds[6].preset.value === "custom",
        7: this.worlds[7].preset.value === "custom",
        8: this.worlds[8].preset.value === "custom"
      };
    }
  }
};
</script>

<style scoped>
.card-body {
  padding: 0.5rem;
}
</style>
