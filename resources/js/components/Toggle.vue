<template>
  <div :class="{disabled:disabled}">
    <toggle-button
      ref="toggle"
      :value="value"
      @input="onInput"
      :sync="true"
      :width="70"
      :height="35"
      :labels="{checked: 'Yes', unchecked: 'No'}"
      :disabled="disabled"
      color="blue"
    ></toggle-button>
    <label @click="onClickLabel">
      <slot></slot>
      <sup v-if="noRace">
        <strong>*</strong>
      </sup>
    </label>
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
    value: { default: false },
    disabled: { default: false }
  },
  methods: {
    onInput(input) {
      this.$emit("input", input);
    },
    onClickLabel() {
      if (!this.disabled) {
        this.$emit("input", !this.value);
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
.disabled {
  color: #bcc3c9;
}
</style>
