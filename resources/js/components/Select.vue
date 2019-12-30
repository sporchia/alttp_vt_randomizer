<template>
  <div class="flex-input">
    <div class="input-group" role="group">
      <div v-if="$slots.default" class="input-group-prepend">
        <span class="input-group-text">
          <slot></slot>
          <sup v-if="noRace">
            <strong>*</strong>
          </sup>
        </span>
      </div>
      <multiselect
        class="form-control"
        :value="value"
        :options="options"
        :show-labels="false"
        :allow-empty="false"
        :custom-label="customLabel"
        :placeholder="placeholder"
        @input="onSelect"
      ></multiselect>
      <div class="input-group-append">
        <slot name="appends"></slot>
        <span v-if="clearable" class="input-group-text cursor-pointer" @click="onClear">
          <img class="icon" src="/i/svg/x.svg" alt="clear" />
        </span>
      </div>
    </div>
    <span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text">
      <img class="icon" src="/i/svg/question-mark.svg" alt="tooltip" />
    </span>
  </div>
</template>

<script>
import EventBus from "../core/event-bus";
import Multiselect from "vue-multiselect";

export default {
  components: {
    Multiselect
  },
  props: {
    options: { default: () => [] },
    noRace: { default: false },
    romFunction: { default: null },
    placeholder: { default: "Select option" },
    defaultItem: { default: null },
    clearable: { default: false },
    sid: { default: null },
    value: { default: null }
  },
  mounted() {
    EventBus.$on("gameLoaded", rom => {
      this.applyRomFunctions(this, rom);
    });
  },
  data() {
    return {};
  },
  methods: {
    customLabel(option) {
      return this.$i18n.t(option.name);
    },
    onSelect(option) {
      this.$emit("input", option, this.sid);
    },
    applyRomFunctions: (vm, rom) => {
      if (rom && vm.romFunction) {
        rom[vm.romFunction](vm.value.value);
      }
    },
    onClear() {
      return this.onSelect(this.defaultItem);
    }
  }
};
</script>

<style scoped>
.flex-input {
  display: flex;
  flex-direction: row;
}
.icon {
  vertical-align: -0.9em;
}
.has-tooltip {
  cursor: help;
}
.cursor-pointer {
  cursor: pointer;
}
</style>
