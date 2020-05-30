<template>
  <div>
    <div class="tabs" :class="{'nav-tabs-sticky': sticky}">
      <ul class="nav" :class="'nav-' + navType">
        <li class="nav-item" v-for="tab in tabs" :key="tab.href">
          <a
            class="nav-link"
            :class="{ 'active': tab.isActive }"
            :href="tab.href"
            @click="selectTab(tab)"
          >
            {{ tab.name }}
            <span
              v-if="tab.count"
              class="badge badge-pill badge-secondary"
            >{{ tab.count }}</span>
          </a>
        </li>
        <li class="nav-item" v-for="action in actions" :key="action.name">
          <a class="nav-link" @click="$emit('click', action)">
            {{ action.name }}
            <span
              v-if="action.count"
              class="badge badge-pill badge-secondary"
            >{{ action.count }}</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="tabs-details">
      <slot></slot>
    </div>
  </div>
</template>

<script>
import EventBus from "../core/event-bus";

export default {
  props: {
    navType: { default: "pills" },
    sticky: { default: false },
    defaultTab: { default: null },
    actions: { default: () => [] }
  },
  data() {
    return {
      tabs: [],
      activeTab: null
    };
  },
  created() {
    this.tabs = this.$children;
  },
  mounted() {
    if (window.location.hash) {
      this.selectTabHref(window.location.hash);
    }
    EventBus.$on("selectTabHref", this.selectTabHref);
  },
  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = tab.href == selectedTab.href;
        if (tab.isActive) {
          this.activeTab = tab.href;
        }
      });
    },
    selectTabHref(href) {
      this.tabs.forEach(tab => {
        tab.isActive = tab.href == href;
        if (tab.isActive) {
          this.activeTab = tab.href;
        }
      });
      if (!this.activeTab) {
        window.location.hash = this.defaultTab || this.tabs[0].href;
        this.selectTabHref(window.location.hash);
      }
    }
  }
};
</script>

<style scoped>
.nav-tabs-sticky {
  background-color: #eeeeee;
}
.nav-link {
  cursor: pointer;
}
</style>
