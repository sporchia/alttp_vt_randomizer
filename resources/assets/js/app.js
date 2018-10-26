
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
if (process.env.MIX_SENTRY_DSN_PUBLIC) {
	var Raven = require('raven-js');
	Raven.config(process.env.MIX_SENTRY_DSN_PUBLIC, {
		ignoreUrls: [
			// Chrome extensions
			/extensions\//i,
			/^chrome:\/\//i,
			// Firefox extensions
			/^moz-extension:\/\//i,
			// AdSense
			/pagead2\.googlesyndication\.com/i,
		],
	}).install();
}

require('./polyfill');
require('./bootstrap');

window.Vue = require('vue');
window.Multiselect = require('vue-multiselect');
window.path = require('path');
window.cStore = require('./store/customizer').default;

import VTooltip from 'v-tooltip';
import ToggleButton from 'vue-js-toggle-button';
import VueTimeago from 'vue-timeago';
//import Vuex from 'vuex';
//Vue.use(Vuex);

window.VueInternationalization = require('vue-i18n').default;
window.Locale = require('./vue-i18n-locales.generated').default;
Vue.use(VueInternationalization);

window.i18n = new VueInternationalization({
	locale: document.documentElement.lang,
	fallbackLocale: 'en',
	messages: Locale,
});

Vue.use(VTooltip);
Vue.use(ToggleButton);
Vue.use(VueTimeago, {
  locale: 'en', // Default locale
  locales: {
    'fr': require('date-fns/locale/fr'),
    'de': require('date-fns/locale/de'),
    'es': require('date-fns/locale/es'),
  }
});
Vue.component('vt-rom-info', require('./components/VTRomInfo.vue'));
Vue.component('vt-rom-loader', require('./components/VTRomLoader.vue'));
Vue.component('vt-rom-settings', require('./components/VTRomSettings.vue'));
Vue.component('vt-select', require('./components/VTSelect.vue'));
Vue.component('vt-spoiler', require('./components/VTSpoiler.vue'));
Vue.component('vt-sprite-select', require('./components/VTSpriteSelect.vue'));
Vue.component('vt-text', require('./components/VTText.vue'));
Vue.component('vt-toggle', require('./components/VTToggle.vue'));
Vue.component('Streams', require('./components/Streams'));

// Views
Vue.component('vt-customizer', require('./views/Customizer.vue'));
Vue.component('vt-enemizer', require('./views/Enemizer.vue'));
Vue.component('vt-entrance-randomizer', require('./views/EntranceRandomizer.vue'));
Vue.component('vt-hash-loader', require('./views/HashLoader.vue'));
Vue.component('vt-item-randomizer', require('./views/ItemRandomizer.vue'));
Vue.component('sprites', require('./views/Sprites.vue'));

// ignore adsense
Vue.config.ignoredElements = ['ins'];
