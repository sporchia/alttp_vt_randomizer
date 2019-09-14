<template>
  <div class="card border-success">
    <div class="card-header bg-success">
      <h3 class="card-title text-white">Logic Settings</h3>
    </div>
    <div class="card-body">
      <Toggle :value="noLogic" @input="setNoLogic($event, setting)">
        {{ $t(`customizer.glitches.noLogic.title`) }}
        <template
          slot="tooltip"
        >{{ $t(`customizer.glitches.noLogic.description`) }}</template>
      </Toggle>
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

export default {
  components: {
    Toggle: Toggle
  },
  data() {
    return {
      noLogic: false
    };
  },
  methods: {
    toggle(value, key) {
      this.$store.dispatch("glitches/setSetting", {
        key: key,
        value: value
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
    }
  }
};
</script>
