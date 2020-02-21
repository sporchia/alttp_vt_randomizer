<template>
  <div>
    <div v-if="!loading" id="rom-select" class="card border-info">
      <div class="card-header bg-info">
        <h4 class="card-title">{{ $t("rom.loader.title") }}</h4>
      </div>
      <div class="card-body">
        <p>
          <label class="btn btn-outline-primary btn-file">
            {{ $t("rom.loader.file_select") }}
            <input type="file" accept=".sfc, .smc" @change="loadBlob" />
          </label>
        </p>
        <p v-html="$t('rom.loader.content')" />
      </div>
    </div>
  </div>
</template>

<script>
import EventBus from "../core/event-bus";
import axios from "axios";
import localforage from "localforage";
import ROM from "../rom";

export default {
  props: { currentRomHash: String, basePatch: Array },
  data() {
    return {
      current_rom_hash: "",
      current_base_file: "",
      loading: true,
      settings_loaded: false
    };
  },
  created() {
    if (typeof this.currentRomHash !== "undefined") {
      this.current_rom_hash = this.currentRomHash;
      this.settings_loaded = true;
      return;
    }
    axios.get(`/base_rom/settings`).then(response => {
      this.current_rom_hash = response.data.rom_hash;
      this.current_base_file = response.data.base_file;
      this.settings_loaded = true;
    });
  },
  mounted() {
    EventBus.$on("loadBlob", this.loadBlob);
    EventBus.$on("noBlob", this.noBlob);
  },
  methods: {
    noBlob() {
      this.loading = false;
    },
    loadBlob(change) {
      // this function doesn't let us test the way it is written
      if (!this.settings_loaded) {
        return setTimeout(this.loadBlob, 50, change);
      }
      this.loading = true;
      let blob = change.target.files[0];

      new ROM(
        blob,
        rom => {
          this.patchRomFromBPS(rom)
            .then(rom => {
              if (rom.checkMD5() != this.current_rom_hash) {
                this.$emit("error", this.$i18n.t("error.bad_file"));
                this.loading = false;
                return;
              } else {
                localforage
                  .setItem("rom", rom.getOriginalArrayBuffer())
                  .catch(error => {
                    if (error === "QuotaExceededError") {
                      this.$emit(
                        "error",
                        this.$i18n.t("error.quota_exceeded_error")
                      );
                      this.loading = false;
                      return;
                    }
                    throw error;
                  });
                this.$emit("update", rom, this.current_rom_hash);
                EventBus.$emit("applyHash", rom);
                this.loading = false;
              }
            })
            .catch(error => {
              if (error == "base patch corrupt") {
                localforage.setItem("vt.stored_base").catch(error => {
                  if (error === "QuotaExceededError") {
                    this.$emit(
                      "error",
                      this.$i18n.t("error.quota_exceeded_error")
                    );
                    this.loading = false;
                    return;
                  }
                  throw error;
                });
                this.loadBlob(change);
              }
            });
        },
        () => {
          this.$emit("error", "Unknown Error: something went wrong?");
          this.loading = false;
        }
      );
    },
    handleXHRError(error) {
      if (error === "QuotaExceededError") {
        this.$emit("error", this.$i18n.t("error.quota_exceeded_error"));
        return;
      }
      throw error;
    },
    patchRomFromBPS(rom) {
      return new Promise((resolve, reject) => {
        if (typeof this.basePatch !== "undefined") {
          if (!Array.isArray(this.basePatch)) {
            console.log(this.basePatch);
            return reject("base patch corrupt");
          }
          return rom.parseBaseBPS({ patch: this.basePatch }).then(rom => {
            rom.setBasePatch(this.basePatch);
            resolve(rom);
          });
        }
        localforage.getItem("vt.stored_base").then(stored_base_file => {
          if (this.current_base_file == stored_base_file) {
            localforage.getItem("vt.base_bps").then(patch => {
              rom.parseBaseBPS({ patch }).then(rom => {
                console.log("rom", rom);
                //rom.setBasePatch(patch);
                //resolve(rom);
              });
            });
          } else {
            axios
              .get(this.current_base_file, {
                responseType: "arraybuffer"
              })
              .then(response => {
                console.log(response);
                localforage
                  .setItem("vt.stored_base", this.current_base_file)
                  .then(() => {
                    localforage
                      .setItem("vt.base_bps", response.data)
                      .then(
                        this.patchRomFromBPS(rom).then(() => {
                          return resolve(rom);
                        })
                      )
                      .catch(this.handleXHRError);
                  })
                  .catch(this.handleXHRError);
              });
          }
        });
      });
    }
  }
};
</script>
