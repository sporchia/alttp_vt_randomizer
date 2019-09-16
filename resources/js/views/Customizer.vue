<template>
  <div id="customizer">
    <div v-if="error" class="alert alert-danger" role="alert">
      <button type="button" class="close" aria-label="Close">
        <img class="icon" src="/i/svg/x.svg" alt="clear" @click="error = false" />
      </button>
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      <span class="message" v-html="this.error"></span>
    </div>
    <div v-show="$store.state.loading" class="center">
      <div class="loading" />
      <h1>Loading...</h1>
    </div>
    <tabs v-show="!$store.state.loading" class="think" nav-type="tabs" :sticky="true">
      <tab name="Home" :selected="true">
        <div class="card border-success mb-3">
          <div class="card-header bg-success">
            <h3
              class="card-title text-white"
            >Welcome to Customizer: Just because you can, doesn't mean you should</h3>
          </div>
          <div class="card-body">
            <h2>What is this?</h2>
            <p>
              Customizer is an advanced interface where you have total control over item placement. If you're
              just looking to make a randomized game and get playing, head over to the
              <a
                href="/start"
              >
                Start
                Playing section.
              </a>
            </p>
            <h2>What can be customized?</h2>
            <ul>
              <li>Every item location can be set to a specific item, no item, or a random item.</li>
              <li>Keys, maps, and compasses can be placed outside of their dungeons.</li>
              <li>Every prize can be set to any pendant or crystal.</li>
              <li>The overall item pool for random items.</li>
              <li>Link's starting equipment.</li>
              <li>...and more!</li>
            </ul>
            <h2>How do I use this?</h2>
            <p>Simply click on one of the sections on the left hand panel.</p>
            <p>
              Beware! You can generate incompletable games using this. If that is your choice please don't report
              item locks generated using this tool.
            </p>
            <p>Here are the keys to Hyrule. Enjoy!</p>
          </div>
        </div>
      </tab>
      <tab id="seed-generate" name="Generate">
        <rom-loader v-if="!romLoaded" @update="updateRom" @error="onError"></rom-loader>
        <div v-if="romLoaded && !generating" class="card border-success mb-3">
          <div class="card-header bg-success card-heading-btn">
            <h3
              class="card-title text-white float-left"
            >Customizer (v5): Just because you can, doesn't mean you should</h3>
            <div class="btn-toolbar float-right"></div>
          </div>
          <div class="card-body">
            <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.placement.title') }}</h5>
            <div class="card-body">
              <div class="row">
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
            </div>
            <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.goal.title') }}</h5>
            <div class="card-body">
              <div class="row">
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
            <div class="card-body">
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
                    :value="hints"
                    @input="setHints"
                    :options="optionsHints"
                  >{{ $t('randomizer.hints.title') }}</Select>
                </div>
              </div>
            </div>
            <h5 class="card-title p-2 border-bottom">{{ $t('randomizer.difficulty.title') }}</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-xl-4 col-lg-6 my-1">
                  <Select
                    :value="weapons"
                    @input="setWeapons"
                    :options="optionsWeapons"
                  >{{ $t('randomizer.weapons.title') }}</Select>
                </div>
                <div class="col-xl-4 col-lg-6 my-1">
                  <Select
                    :value="itemPool"
                    @input="setItemPool"
                    :options="optionsItemPool"
                  >{{ $t('randomizer.item_pool.title') }}</Select>
                </div>
                <div class="col-xl-4 col-lg-6 my-1">
                  <Select
                    :value="itemFunctionality"
                    @input="setItemFunctionality"
                    :options="optionsItemFunctionality"
                  >{{ $t('randomizer.item_functionality.title') }}</Select>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md mb-3">
                  <vt-text
                    v-model="choice.name"
                    placeholder="name this"
                    maxlength="100"
                    storage-key="vt.custom.name"
                  >Name</vt-text>
                </div>
                <div class="col-md mb-3">
                  <vt-textarea
                    v-model="choice.notes"
                    placeholder="game notes"
                    storage-key="vt.custom.notes"
                  >Notes</vt-textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-md">
                <div class="btn-group btn-flex" role="group">
                  <button
                    name="generate"
                    :disabled="generating"
                    class="btn btn-success"
                    @click="applySpoilerSeed"
                  >{{ $t('randomizer.generate.race') }}</button>
                </div>
              </div>
              <div class="col-md">
                <div class="btn-group btn-flex" role="group">
                  <button
                    class="btn btn-info"
                    name="generate-tournament-rom"
                    :disabled="generating"
                    @click="testSpoilerSeed"
                  >Test Placements</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-show="generating" class="center">
          <div class="loading" />
          <h1>{{ $t('randomizer.generate.generating') }}</h1>
        </div>
      </tab>
      <tab name="Game Details" v-show="gameLoaded">
        <div
          id="seed-details"
          class="card border-success"
          :class="{'border-info': choice.tournament}"
          v-if="gameLoaded && romLoaded"
        >
          <div class="card-header text-white bg-success" :class="{'bg-info': choice.tournament}">
            <h3 class="card-title">
              {{ $t('randomizer.details.title') }}
              <span v-if="rom.name">: {{rom.name}}</span>
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md mb-3">
                <vt-rom-info :rom="rom"></vt-rom-info>
              </div>
              <div class="col-md mb-3">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="btn-group btn-flex" role="group">
                      <button
                        class="btn btn-light border-secondary text-center"
                        @click="saveSpoiler"
                      >{{ $t('randomizer.details.save_spoiler') }}</button>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div
                      v-if="this.endpoint == '/api/customizer'"
                      class="btn-group btn-flex"
                      role="group"
                    >
                      <button
                        class="btn btn-success text-center"
                        @click="saveRom"
                      >{{ $t('randomizer.details.save_rom') }}</button>
                    </div>
                  </div>
                </div>
                <div v-if="this.endpoint == '/api/customizer'" class="row">
                  <vt-rom-settings class="col-12" :rom="rom"></vt-rom-settings>
                </div>
              </div>
            </div>
            <vt-spoiler :rom="rom"></vt-spoiler>
          </div>
        </div>
        <div class="card border-info" v-if="!gameLoaded || !romLoaded">
          <div class="card-header text-white bg-info">
            <h3 class="card-title">No Game Generated</h3>
          </div>
          <div class="card-body">
            <p>Please Generate or Test Generate settings for this panel to have information</p>
          </div>
        </div>
      </tab>
      <tab name="Settings">
        <settings v-if="!$store.state.loading"></settings>
      </tab>
      <tab name="Logic">
        <glitches v-if="!$store.state.loading"></glitches>
      </tab>
      <tab name="Starting Equipment">
        <equipment-select v-model="equipment"></equipment-select>
      </tab>
      <tab name="Item Pool">
        <item-pool v-if="!$store.state.loading" />
      </tab>
      <tab name="Locations">
        <locations v-if="!$store.state.loading" />
      </tab>
      <tab name="Prize Pack Pool">
        <prize-pack-pool v-if="!$store.state.loading" />
      </tab>
      <tab name="Prize Packs">
        <prize-packs v-if="!$store.state.loading" />
      </tab>
      <tab name="Save/Restore">
        <div class="card border-info">
          <div class="card-header text-white bg-success">
            <h3 class="card-title">Save/Restore</h3>
          </div>
          <div class="card-body">
            <button class="btn btn-success" @click="saveSettings">Save</button>
            <label class="btn btn-info btn-file">
              Load
              <input type="file" accept=".json" @change="loadSettings" />
            </label>
            <button class="btn btn-danger" @click="iveDoneMessedUp">Reset Everything</button>
          </div>
        </div>
      </tab>
    </tabs>
  </div>
</template>

<script>
import EquipmentSelect from "../components/Customizer/EquipmentSelect.vue";
import EventBus from "../core/event-bus";
import FileSaver from "file-saver";
import localforage from "localforage";
import axios from "axios";
import RomLoader from "../components/VTRomLoader.vue";
import ItemPool from "../components/Customizer/ItemPool.vue";
import Locations from "../components/Customizer/Locations.vue";
import PrizePackPool from "../components/Customizer/PrizePackPool.vue";
import PrizePacks from "../components/Customizer/PrizePacks.vue";
import Settings from "../components/Customizer/Settings.vue";
import Glitches from "../components/Customizer/Glitches.vue";
import Tab from "../components/VTTab.vue";
import Tabs from "../components/VTTabs.vue";
import VTTextarea from "../components/VTTextarea.vue";
import Select from "../components/Select.vue";
import { mapMutations, mapActions, mapState } from "vuex";

export default {
  components: {
    EquipmentSelect: EquipmentSelect,
    ItemPool: ItemPool,
    Locations: Locations,
    PrizePackPool: PrizePackPool,
    PrizePacks: PrizePacks,
    Settings: Settings,
    Glitches: Glitches,
    Tab: Tab,
    Tabs: Tabs,
    VtTextarea: VTTextarea,
    RomLoader,
    Select
  },
  data() {
    return {
      rom: null,
      error: false,
      generating: false,
      romLoaded: false,
      current_rom_hash: "",
      gameLoaded: false,
      endpoint: "/api/customizer",
      choice: {
        name: "",
        notes: ""
      },
      tournament: false,
      settings: {
        logics: [],
        weapons: [],
        goals: [],
        variations: []
      },
      equipment: [],
      save_restore_settings: [
        "vt.custom.drops",
        "vt.custom.equipment",
        "vt.custom.items",
        "vt.custom.locations",
        "vt.custom.name",
        "vt.custom.notes",
        "vt.custom.prizepacks",
        "vt.custom.settings",
        "vt.custom.glitches",
        "randomizer.glitches_required",
        "randomizer.item_placement",
        "randomizer.dungeon_items",
        "randomizer.accessibility",
        "randomizer.goal",
        "randomizer.tower_open",
        "randomizer.ganon_open",
        "randomizer.world_state",
        "randomizer.hints",
        "randomizer.weapons",
        "randomizer.item_pool",
        "randomizer.item_functionality"
      ],
      restore_lookup: {
        "randomizer.glitches_required": "setGlitchesRequired",
        "randomizer.item_placement": "setItemPlacement",
        "randomizer.dungeon_items": "setDungeonItems",
        "randomizer.accessibility": "setAccessibility",
        "randomizer.goal": "setGoal",
        "randomizer.tower_open": "setTowerOpen",
        "randomizer.ganon_open": "setGanonOpen",
        "randomizer.world_state": "setWorldState",
        "randomizer.hints": "setHints",
        "randomizer.weapons": "setWeapons",
        "randomizer.item_pool": "setItemPool",
        "randomizer.item_functionality": "setItemFunctionality"
      }
    };
  },
  created() {
    this.$store.dispatch("getSprites");
    this.$store.dispatch("getSettings");
    this.$store.dispatch("randomizer/getItemSettings");
    this.$store.dispatch("romSettings/initialize");

    localforage.getItem("rom").then(function(blob) {
      if (blob == null) {
        EventBus.$emit("noBlob");
        return;
      }
      EventBus.$emit("loadBlob", { target: { files: [new Blob([blob])] } });
    });
  },
  methods: {
    ...mapActions("randomizer", [
      "setPreset",
      "setGlitchesRequired",
      "setItemPlacement",
      "setGoal",
      "setGanonOpen",
      "setWorldState",
      "setEntranceShuffle",
      "setItemPool"
    ]),
    ...mapMutations("randomizer", [
      "setDungeonItems",
      "setAccessibility",
      "setTowerOpen",
      "setBossShuffle",
      "setEnemyShuffle",
      "setHints",
      "setWeapons",
      "setItemFunctionality",
      "setEnemyDamage",
      "setEnemyHealth"
    ]),
    applySpoilerSeed() {
      this.endpoint = "/api/customizer";
      this.applySeed();
    },
    testSpoilerSeed() {
      this.endpoint = "/api/customizer/test";
      this.applySeed();
    },
    applySeed(e, second_attempt) {
      this.error = false;
      this.generating = true;
      if (this.rom.checkMD5() != this.current_rom_hash) {
        if (second_attempt) {
          return new Promise(function(resolve, reject) {
            this.generating = false;
            reject(this.rom);
          });
        }
        return this.rom
          .reset()
          .then(
            function() {
              return this.applySeed(e, true);
            }.bind(this)
          )
          .catch(error => {
            console.log(error);
            this.generating = false;
          });
      }
      return new Promise(
        function(resolve, reject) {
          this.gameLoaded = false;
          axios
            .post(this.endpoint, {
              glitches: this.glitchesRequired.value,
              item_placement: this.itemPlacement.value,
              dungeon_items: this.dungeonItems.value,
              accessibility: this.accessibility.value,
              goal: this.goal.value,
              crystals: {
                ganon: this.ganonOpen.value,
                tower: this.towerOpen.value
              },
              mode: this.worldState.value,
              weapons: this.weapons.value,
              item: {
                pool: this.itemPool.value,
                functionality: this.itemFunctionality.value
              },
              tournament: this.tournament,
              spoilers: this.spoilers,
              lang: document.documentElement.lang,
              name: this.choice.name,
              notes: this.choice.notes,
              l: this.locations,
              eq: this.equipment,
              drops: this.packs,
              custom: {
                ...this.context,
                ...this.glitches,
                item: {
                  count: this.flatItemPool
                },
                drop: {
                  count: this.dropPool
                }
              }
            })
            .then(response => {
              this.rom.parsePatch(response.data).then(
                function() {
                  if (
                    response.data.current_rom_hash &&
                    response.data.current_rom_hash != this.current_rom_hash
                  ) {
                    // The base rom has been updated. or test call
                    window.location.reload(true);
                  }

                  this.gameLoaded = true;
                  this.generating = false;
                  EventBus.$emit("gameLoaded", this.rom);
                  EventBus.$emit("selectTabHref", "#game-details");
                  this.error = null;
                  resolve({ rom: this.rom, patch: response.data.patch });
                }.bind(this)
              );
            })
            .catch(error => {
              if (error.response) {
                switch (error.response.status) {
                  case 429:
                    this.error = this.$i18n.t("error.429");
                    break;
                  default:
                    this.error =
                      this.$i18n.t("error.failed_generation") +
                      "<br />" +
                      error.response.data;
                }
              }
              reject(error);
            })
            .finally(() => {
              this.generating = false;
            });
        }.bind(this)
      );
    },
    saveRom() {
      return this.rom.save(this.rom.downloadFilename() + ".sfc", {
        quickswap: this.quickswap,
        paletteShuffle: this.paletteShuffle,
        musicOn: this.musicOn
      });
    },
    saveSpoiler() {
      return FileSaver.saveAs(
        new Blob([JSON.stringify(this.rom.spoiler, null, 4)]),
        this.rom.downloadFilename() + ".txt"
      );
    },
    updateRom(rom, current_rom_hash) {
      if (!rom) {
        return;
      }
      this.rom = rom;
      this.current_rom_hash = current_rom_hash;
      this.error = false;
      this.romLoaded = true;
    },
    onError(error) {
      this.error = error;
    },
    saveSettings() {
      var promises = [];
      for (var i = 0; i < this.save_restore_settings.length; ++i) {
        promises.push(localforage.getItem(this.save_restore_settings[i]));
      }
      Promise.all(promises).then(values => {
        var save = {};
        for (var i = 0; i < this.save_restore_settings.length; ++i) {
          if (values[i] && values[i].value) {
            save[this.save_restore_settings[i]] = values[i].value;
          } else {
            save[this.save_restore_settings[i]] = values[i];
          }
        }
        return FileSaver.saveAs(
          new Blob([JSON.stringify(save)]),
          (this.choice.name ? this.choice.name : "customizer") +
            "-settings.json"
        );
      });
    },
    loadSettings(change) {
      var file = change.target.files[0];
      var fileReader = new FileReader();

      fileReader.onload = () => {
        try {
          var settings = JSON.parse(fileReader.result);
        } catch (e) {
          this.error = e;
          return;
        }
        var promises = [];
        for (var i = 0; i < this.save_restore_settings.length; ++i) {
          if (!settings[this.save_restore_settings[i]]) continue;
          if (this.restore_lookup[this.save_restore_settings[i]]) {
            promises.push(
              new Promise(resolve => {
                this[this.restore_lookup[this.save_restore_settings[i]]](
                  settings[this.save_restore_settings[i]] || null
                );
                resolve();
              })
            );
          } else {
            promises.push(
              localforage.setItem(
                this.save_restore_settings[i],
                settings[this.save_restore_settings[i]] || null
              )
            );
          }
        }
        // this used to return onSettingsParseError which was undefined?
        if (!promises.length) return;
        Promise.all(promises).then(function() {
          window.location.hash = "";
          window.location.reload();
        });
      };

      fileReader.readAsText(file);
    },
    iveDoneMessedUp() {
      const promises = [
        localforage.removeItem("vt.custom.HardMode"),
        localforage.removeItem("vt.custom.name"),
        localforage.removeItem("vt.custom.notes"),
        localforage.removeItem("vt.custom.rom-logic"),
        localforage.removeItem("vt.custom.weapons"),
        localforage.removeItem("vt.custom.goal"),
        localforage.removeItem("vt.custom.logic"),
        localforage.removeItem("vt.custom.state"),
        localforage.removeItem("randomizer.glitches_required"),
        localforage.removeItem("randomizer.item_placement"),
        localforage.removeItem("randomizer.dungeon_items"),
        localforage.removeItem("randomizer.accessibility"),
        localforage.removeItem("randomizer.goal"),
        localforage.removeItem("randomizer.tower_open"),
        localforage.removeItem("randomizer.ganon_open"),
        localforage.removeItem("randomizer.world_state"),
        localforage.removeItem("randomizer.hints"),
        localforage.removeItem("randomizer.weapons"),
        localforage.removeItem("randomizer.item_pool"),
        localforage.removeItem("randomizer.item_functionality"),
        this.$store.dispatch("nukeStore")
      ];
      Promise.all(promises).then(() => {
        window.location.hash = "";
        window.location.reload();
      });
    }
  },
  computed: {
    ...mapState("randomizer", {
      optionsPreset: state => state.options.preset,
      preset: state => state.preset,
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
      optionsBossShuffle: state => state.options.boss_shuffle,
      bossShuffle: state => state.boss_shuffle,
      optionsEnemyShuffle: state => state.options.enemy_shuffle,
      enemyShuffle: state => state.enemy_shuffle,
      optionsHints: state => state.options.hints,
      hints: state => state.hints,
      optionsWeapons: state => state.options.weapons,
      weapons: state => state.weapons,
      optionsItemPool: state => state.options.item_pool,
      itemPool: state => state.item_pool,
      optionsItemFunctionality: state => state.options.item_functionality,
      itemFunctionality: state => state.item_functionality,
      optionsEnemyDamage: state => state.options.enemy_damage,
      enemyDamage: state => state.enemy_damage,
      optionsEnemyHealth: state => state.options.enemy_health,
      enemyHealth: state => state.enemy_health
    }),
    ...mapState("romSettings", {
      heartSpeed: state => state.heartSpeed,
      menuSpeed: state => state.menuSpeed,
      heartColor: state => state.heartColor,
      quickswap: state => state.quickswap,
      musicOn: state => state.musicOn,
      paletteShuffle: state => state.paletteShuffle
    }),
    flatItemPool() {
      return this.$store.getters["itemLocations/flatItemPool"];
    },
    dropPool() {
      return this.$store.getters["prizePacks/flatPool"];
    },
    locations() {
      return this.$store.getters["itemLocations/flatLocations"];
    },
    packs() {
      return this.$store.state.prizePacks.flatpacks;
    },
    context() {
      return this.$store.state.context.settings;
    },
    glitches() {
      return this.$store.state.glitches.settings;
    }
  }
};
</script>

<style scoped>
.btn-file {
  margin: 0;
}
.think .tabs {
  position: fixed !important;
  top: 0;
}
</style>
