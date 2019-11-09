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
          <div class="card-body">World: {{ world_id }}</div>
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
    this.$store.dispatch("multiworld/getItemSettings");
    this.$store.dispatch("romSettings/initialize");
    this.$store.dispatch("getSettings");
  },
  methods: {
    ...mapActions("multiworld", [
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
    ...mapMutations("multiworld", [
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
    ...mapState("multiworld", {
      optionsPreset: state => state.options.preset,
      //preset: state => state.preset,
      optionsGlitchesRequired: state => state.options.glitches_required,
      //glitchesRequired: state => state.glitches_required,
      optionsItemPlacement: state => state.options.item_placement,
      //itemPlacement: state => state.item_placement,
      optionsDungeonItems: state => state.options.dungeon_items,
      //dungeonItems: state => state.dungeon_items,
      optionsAccessibility: state => state.options.accessibility,
      //accessibility: state => state.accessibility,
      optionsGoal: state => state.options.goal,
      //goal: state => state.goal,
      optionsTowerOpen: state => state.options.tower_open,
      //towerOpen: state => state.tower_open,
      optionsGanonOpen: state => state.options.ganon_open,
      //ganonOpen: state => state.ganon_open,
      optionsWorldState: state => state.options.world_state,
      //worldState: state => state.world_state,
      optionsEntranceShuffle: state => state.options.entrance_shuffle,
      //entranceShuffle: state => state.entrance_shuffle,
      optionsHints: state => state.options.hints,
      //hints: state => state.hints,
      optionsWeapons: state => state.options.weapons,
      //weapons: state => state.weapons,
      optionsItemPool: state => state.options.item_pool,
      //itemPool: state => state.item_pool,
      optionsItemFunctionality: state => state.options.item_functionality
      //itemFunctionality: state => state.item_functionality
    }),
    editable() {
      return this.$store.state.multiworld.preset.value === "custom";
    }
  }
};
</script>

<style scoped>
.card-body {
  padding: 0.5rem;
}
</style>
