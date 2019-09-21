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

    <div v-if="!gameLoaded && !generating" class="card border-success my-1">
      <div class="card-header bg-success card-heading-btn">
        <h3 class="card-title text-white">{{ $t('multiworld.title') }}</h3>
      </div>
      <tabs v-show="!$store.state.loading" class="think" nav-type="tabs" :sticky="true">
        <tab
          :name="'World ' + world_id"
          v-for="world_id in [1,2,3,4,5,6,7,8]"
          :key="world_id"
          :selected="true"
        >
          <div class="card-body">
            <div class="card border-info my-1">
              <div class="card-body">
                <div class="row">
                  <div class="col my-1">
                    <Select :value="preset" @input="setPreset" :options="optionsPreset">
                      <template v-slot:default>{{ $t('randomizer.preset.title') }}</template>
                      <template v-slot:appends v-if="preset.value !== 'custom'">
                        <button
                          class="btn btn-outline-secondary"
                          type="button"
                          @click="setPreset('custom')"
                        >{{ $t('randomizer.preset.customize')}}</button>
                      </template>
                    </Select>
                  </div>
                </div>
              </div>
              <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.placement.title') }}</h5>
              <div class="card-body">
                <div class="row" v-if="!editable">
                  <div
                    class="col-xl-3 col-lg-6 my-1"
                  >{{ $t('randomizer.glitches_required.title') }}: {{ $t(glitchesRequired.name) }}</div>
                  <div
                    class="col-xl-3 col-lg-6 my-1"
                  >{{ $t('randomizer.item_placement.title') }}: {{ $t(itemPlacement.name) }}</div>
                  <div
                    class="col-xl-3 col-lg-6 my-1"
                  >{{ $t('randomizer.dungeon_items.title') }}: {{ $t(dungeonItems.name) }}</div>
                  <div
                    class="col-xl-3 col-lg-6 my-1"
                  >{{ $t('randomizer.accessibility.title') }}: {{ $t(accessibility.name) }}</div>
                </div>
                <div class="row" v-if="editable">
                  <div class="col-xl-6 col-lg-6 my-1">
                    <Select
                      :value="glitchesRequired"
                      @input="setGlitchesRequired"
                      :options="optionsGlitchesRequired"
                    >{{ $t('randomizer.glitches_required.title') }}</Select>
                  </div>
                  <div class="col-xl-6 col-lg-6 my-1">
                    <Select
                      :value="itemPlacement"
                      @input="setItemPlacement"
                      :options="optionsItemPlacement"
                    >{{ $t('randomizer.item_placement.title') }}</Select>
                  </div>
                  <div class="col-xl-6 col-lg-6 my-1">
                    <Select
                      :value="dungeonItems"
                      @input="setDungeonItems"
                      :options="optionsDungeonItems"
                    >{{ $t('randomizer.dungeon_items.title') }}</Select>
                  </div>
                  <div class="col-xl-6 col-lg-6 my-1">
                    <Select
                      :value="accessibility"
                      @input="setAccessibility"
                      :options="optionsAccessibility"
                    >{{ $t('randomizer.accessibility.title') }}</Select>
                  </div>
                </div>
                <div
                  v-if="glitchesRequired.value !== 'none'"
                  class="logic-warning text-danger"
                  v-html="$t('randomizer.glitches_required.glitch_warning')"
                />
              </div>
              <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.goal.title') }}</h5>
              <div class="card-body">
                <div class="row" v-if="!editable">
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.goal.title') }}: {{ $t(goal.name) }}</div>
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.tower_open.title') }}: {{ $t(towerOpen.name) }}</div>
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.ganon_open.title') }}: {{ $t(ganonOpen.name) }}</div>
                </div>
                <div class="row" v-if="editable">
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="goal"
                      @input="setGoal"
                      :options="optionsGoal"
                    >{{ $t('randomizer.goal.title') }}</Select>
                  </div>
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="towerOpen"
                      @input="setTowerOpen"
                      :options="optionsTowerOpen"
                    >{{ $t('randomizer.tower_open.title') }}</Select>
                  </div>
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="ganonOpen"
                      @input="setGanonOpen"
                      :options="optionsGanonOpen"
                    >{{ $t('randomizer.ganon_open.title') }}</Select>
                  </div>
                </div>
              </div>
              <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.gameplay.title') }}</h5>
              <div class="card-body" v-if="!editable">
                <div class="row">
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.world_state.title') }}: {{ $t(worldState.name) }}</div>
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.entrance_shuffle.title') }}: {{ $t(entranceShuffle.name) }}</div>
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.hints.title') }}: {{ $t(hints.name) }}</div>
                </div>
              </div>
              <div class="card-body" v-if="editable">
                <div class="row">
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="worldState"
                      @input="setWorldState"
                      :options="optionsWorldState"
                    >{{ $t('randomizer.world_state.title') }}</Select>
                  </div>
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="entranceShuffle"
                      @input="setEntranceShuffle"
                      :options="optionsEntranceShuffle"
                    >{{ $t('randomizer.entrance_shuffle.title') }}</Select>
                  </div>
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="hints"
                      @input="setHints"
                      :options="optionsHints"
                    >{{ $t('randomizer.hints.title') }}</Select>
                  </div>
                </div>
              </div>
              <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.difficulty.title') }}</h5>
              <div class="card-body">
                <div class="row" v-if="!editable">
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.weapons.title') }}: {{ $t(weapons.name) }}</div>
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.item_pool.title') }}: {{ $t(itemPool.name) }}</div>
                  <div
                    class="col-xl-4 col-lg-6 my-1"
                  >{{ $t('randomizer.item_functionality.title') }}: {{ $t(itemFunctionality.name) }}</div>
                </div>
                <div class="row" v-if="editable">
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="weapons"
                      @input="setWeapons"
                      :options="optionsWeapons"
                    >{{ $t('randomizer.weapons.title') }}</Select>
                  </div>
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select :value="itemPool" @input="setItemPool" :options="optionsItemPool">
                      {{ $t('randomizer.item_pool.title') }}
                      <sup
                        v-if="itemPool.value === 'crowd_control'"
                      >*</sup>
                    </Select>
                  </div>
                  <div class="col-xl-4 col-lg-6 my-1">
                    <Select
                      :value="itemFunctionality"
                      @input="setItemFunctionality"
                      :options="optionsItemFunctionality"
                    >{{ $t('randomizer.item_functionality.title') }}</Select>
                  </div>
                </div>
                <div
                  v-if="itemPool.value === 'crowd_control'"
                  class="logic-warning text-info"
                  v-html="$t('randomizer.item_pool.crowd_control_warning')"
                />
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
import localforage from "localforage";
import axios from "axios";
import { mapMutations, mapActions, mapState } from "vuex";

export default {
  components: {
    Tab: Tab,
    Tabs: Tabs,
    Select
  },
  data() {
    return {
      error: false,
      generating: false,
      gameLoaded: false,
      tournament: false,
      spoilers: false
    };
  },
  created() {
    this.$store.dispatch("randomizer/getItemSettings");
    this.$store.dispatch("romSettings/initialize");
  },
  methods: {
    ...mapActions("randomizer", [
      "setPreset",
      "setGlitchesRequired",
      "setItemPlacement",
      "setDungeonItems",
      "setGoal",
      "setGanonOpen",
      "setWorldState",
      "setEntranceShuffle",
      "setItemPool"
    ]),
    ...mapMutations("randomizer", [
      "setAccessibility",
      "setTowerOpen",
      "setHints",
      "setWeapons",
      "setItemFunctionality"
    ]),
    applyTournamentSeed() {
      this.tournament = true;
      this.spoilers = false;
      this.applySeed();
    },
    applyTournamentSpoilerSeed() {
      this.tournament = false;
      this.spoilers = true;
      this.applySeed();
    },
    onError(error) {
      this.error = error;
    }
  },
  computed: {
    ...mapState("randomizer", {
      optionsPreset: state => state.options.preset,
      preset: state => state.preset,
      optionsGlitchesRequired: state => state.options.glitches_required,
      glitchesRequired: state => state.glitches_required,
      optionsItemPlacement: state => state.options.item_placement,
      itemPlacement: state => state.item_placement,
      optionsDungeonItems: state => state.options.dungeon_items,
      dungeonItems: state => state.dungeon_items,
      optionsAccessibility: state => state.options.accessibility,
      accessibility: state => state.accessibility,
      optionsGoal: state => state.options.goal,
      goal: state => state.goal,
      optionsTowerOpen: state => state.options.tower_open,
      towerOpen: state => state.tower_open,
      optionsGanonOpen: state => state.options.ganon_open,
      ganonOpen: state => state.ganon_open,
      optionsWorldState: state => state.options.world_state,
      worldState: state => state.world_state,
      optionsEntranceShuffle: state => state.options.entrance_shuffle,
      entranceShuffle: state => state.entrance_shuffle,
      optionsHints: state => state.options.hints,
      hints: state => state.hints,
      optionsWeapons: state => state.options.weapons,
      weapons: state => state.weapons,
      optionsItemPool: state => state.options.item_pool,
      itemPool: state => state.item_pool,
      optionsItemFunctionality: state => state.options.item_functionality,
      itemFunctionality: state => state.item_functionality
    }),
    editable() {
      return this.$store.state.randomizer.preset.value === "custom";
    }
  }
};
</script>

<style scoped>
.card-body {
  padding: 0.5rem;
}
</style>
