<template>
  <div>
    <toggle-button
      v-model="value"
      @input="onInput"
      :sync="true"
      :width="70"
      :height="35"
      :labels="{checked: 'Yes', unchecked: 'No'}"
      color="blue"
    ></toggle-button>
    <label @click="onClickLabel">
      <slot></slot>
    </label>
    <span v-if="$slots['clickable']" v-html="$slots['clickable'][0].text" />
    <sup v-if="noRace">
      <strong>*</strong>
    </sup>
    <span v-if="$slots['tooltip']" v-tooltip="$slots['tooltip'][0].text">
      <img class="icon" src="/i/svg/question-mark.svg" alt="tooltip" />
    </span>
  </div>
</template>

<script>
import { ToggleButton } from "vue-js-toggle-button";

export default {
  components: {
    ToggleButton
  },
  props: {
    noRace: { default: false },
    storageKey: { default: "" },
    selected: { default: false },
    romFunction: { default: null },
    rom: { default: null }
  },
  mounted() {
    localforage
      .getItem(this.storageKey)
      .then(
        function(value) {
          if (value === null) return;
          this.value = value;
          this.$emit("input", this.value);
        }.bind(this)
      )
      .then(
        function() {
          this.onInput(this.value);
        }.bind(this)
      );
  },
  data() {
    return {
      value: this.selected
    };
  },
  methods: {
    onInput(input) {
      localforage.setItem(this.storageKey, this.value);
      if (this.rom && this.romFunction) {
        this.rom[this.romFunction](this.value);
      }
      this.$emit("input", this.value);
    },
    onClickLabel() {
      this.value = !this.value;
    },
    applyRomFunctions: (vm, rom) => {
      if (rom && vm.romFunction) {
        rom[vm.romFunction](vm.value);
      }
    }
  }
};
</script>

<style scoped>
.vue-js-switch {
  margin: 2px;
}
.vue-js-switch {
  font-size: 16px !important;
}
.icon {
  vertical-align: middle;
}
.has-tooltip {
  cursor: help;
}
</style>
