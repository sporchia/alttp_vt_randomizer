import * as Sentry from "@sentry/browser";
import VTooltip from "v-tooltip";
import VueTimeago from "vue-timeago";

if (process.env.MIX_SENTRY_DSN_PUBLIC) {
  Sentry.init({
    dsn: process.env.MIX_SENTRY_DSN_PUBLIC,
    blacklistUrls: [
      // Chrome extensions
      /extensions\//i,
      /^chrome:\/\//i,
      // Firefox extensions
      /^moz-extension:\/\//i,
      // AdSense
      /pagead2\.googlesyndication\.com/i
    ]
  });
}

require("./polyfill");
require("./bootstrap");

const Vue = require("vue");
window.Vue = Vue;
window.cStore = require("./store/customizer").default;

import VueInternationalization from "vue-i18n";
import Locale from "./vue-i18n-locales.generated";

Vue.use(VueInternationalization);

window.i18n = new VueInternationalization({
  locale: document.documentElement.lang,
  fallbackLocale: "en",
  silentFallbackWarn: true,
  silentTranslationWarn: true,
  messages: Locale
});

Vue.use(VTooltip);
Vue.use(VueTimeago, {
  locale: "en", // Default locale
  locales: {
    fr: require("date-fns/locale/fr"),
    de: require("date-fns/locale/de"),
    es: require("date-fns/locale/es")
  }
});
Vue.component("vt-rom-info", require("./components/VTRomInfo.vue").default);
Vue.component(
  "vt-rom-settings",
  require("./components/VTRomSettings.vue").default
);
Vue.component("vt-select", require("./components/VTSelect.vue").default);
Vue.component("vt-spoiler", require("./components/VTSpoiler.vue").default);
Vue.component(
  "vt-sprite-select",
  require("./components/VTSpriteSelect.vue").default
);
Vue.component("vt-text", require("./components/VTText.vue").default);
//Vue.component("Streams", require("./components/Streams").default);

// Views
Vue.component("Multiworld", require("./views/Multiworld.vue").default);
Vue.component("Customizer", require("./views/Customizer.vue").default);
Vue.component("Hashloader", require("./views/HashLoader.vue").default);
Vue.component("Randomizer", require("./views/Randomizer.vue").default);
Vue.component("Sprites", require("./views/Sprites.vue").default);

// ignore adsense
Vue.config.ignoredElements = ["ins"];
