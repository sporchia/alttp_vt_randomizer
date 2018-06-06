
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
if (process.env.MIX_SENTRY_DSN_PUBLIC) {
	var Raven = require('raven-js');
	Raven.config(process.env.MIX_SENTRY_DSN_PUBLIC).install();
}

require('./bootstrap');

window.Vue = require('vue');
window.Multiselect = require('vue-multiselect');
window.path = require('path');

import VTooltip from 'v-tooltip'
import ToggleButton from 'vue-js-toggle-button'

Vue.use(VTooltip);
Vue.use(ToggleButton);
Vue.component('vt-rom-info', require('./components/VTRomInfo.vue'));
Vue.component('vt-rom-loader', require('./components/VTRomLoader.vue'));
Vue.component('vt-rom-settings', require('./components/VTRomSettings.vue'));
Vue.component('vt-select', require('./components/VTSelect.vue'));
Vue.component('vt-spoiler', require('./components/VTSpoiler.vue'));
Vue.component('vt-sprite-select', require('./components/VTSpriteSelect.vue'));
Vue.component('vt-text', require('./components/VTText.vue'));
Vue.component('vt-toggle', require('./components/VTToggle.vue'));

// Views
Vue.component('vt-customizer', require('./views/Customizer.vue'));
Vue.component('vt-enemizer', require('./views/Enemizer.vue'));
Vue.component('vt-entrance-randomizer', require('./views/EntranceRandomizer.vue'));
Vue.component('vt-hash-loader', require('./views/HashLoader.vue'));
Vue.component('vt-item-randomizer', require('./views/ItemRandomizer.vue'));

// ignore adsense
Vue.config.ignoredElements = ['ins'];
