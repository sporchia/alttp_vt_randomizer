<template>
  <div class="card border-success">
    <div class="card-header bg-success">
      <h3 class="card-title text-white">Logic Settings</h3>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col">
          <Toggle :value="noLogic" @input="setNoLogic($event, setting)">
            {{ $t(`customizer.glitches.noLogic.title`) }}
            <template
              slot="tooltip"
            >{{ $t(`customizer.glitches.noLogic.description`) }}</template>
          </Toggle>
        </div>
        <div class="col">
          <Select
            :value="logicMode"
            @input="selectItem($event, 'rom.logicMode')"
            :options="logicModes"
            >{{ $t(`customizer.glitches.logicMode.title`) }}
            <template
              slot="tooltip"
            >{{ $t(`customizer.glitches.logicMode.description`) }}</template>
          </Select>
        </div>
      </div>
      <div class="row mb-3">
        <div v-for="(value, setting) in glitches" :key="setting" class="col-xl-6 col-lg-6 my-1">
          <Toggle :disabled="noLogic" :value="glitches[setting]" @input="toggle($event, setting)">
            {{ $t(`customizer.glitches.${setting}.title`) }}
            <template
              slot="tooltip"
            >{{ $t(`customizer.glitches.${setting}.description`) }}</template>
          </Toggle>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EventBus from "../../core/event-bus";
import Toggle from "../Toggle.vue";
import Select from "../Select.vue";

export default {
  components: {
    Toggle: Toggle,
    Select: Select
  },
  data() {
    return {
      noLogic: false,
      logicModeLookup: {},
      logicModes: [
        {
          value: "NoGlitches",
          name: "randomizer.glitches_required.options.none"
        },
        {
          value: "OverworldGlitches",
          name: "randomizer.glitches_required.options.overworld_glitches"
        },
        {
          value: "MajorGlitches",
          name: "randomizer.glitches_required.options.major_glitches"
        },
        {
          value: "NoLogic",
          name: "randomizer.glitches_required.options.no_logic"
        }
      ]
    };
  },
  created() {
    this.logicModes.forEach(thing => {
      this.logicModeLookup[thing.value] = thing;
    });
  },
  methods: {
    toggle(value, key) {
      this.$store.dispatch("glitches/setSetting", {
        key: key,
        value: value
      });
    },
    selectItem(selectOption, key) {
      this.$store.dispatch("context/setSetting", {
        key: key,
        value: selectOption.value
      });
    },
    setNoLogic(value, key) {
      this.noLogic = value;
      if (value) {
        this.$store.dispatch("randomizer/setGlitchesRequired", "no_logic");
      } else {
        this.$store.dispatch("randomizer/setGlitchesRequired", "none");
      }
    }
  },
  computed: {
    glitches() {
      return this.$store.state.glitches.settings;
    },
    logicMode() {
      return this.logicModeLookup[
        this.$store.state.context.settings["rom.logicMode"]
      ];
    }
  }
};
</script>
