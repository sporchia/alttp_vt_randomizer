
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
Vue.component('vt-toggle', require('./components/VTToggle.vue'));
Vue.component('vt-select', require('./components/VTSelect.vue'));
Vue.component('vt-text', require('./components/VTText.vue'));
Vue.component('vt-sprite-select', require('./components/VTSpriteSelect.vue'));
Vue.component('vt-rom-settings', require('./components/VTRomSettings.vue'));
Vue.component('vt-rom-info', require('./components/VTRomInfo.vue'));
Vue.component('vt-spoiler', require('./components/VTSpoiler.vue'));
Vue.component('vt-rom-loader', require('./components/VTRomLoader.vue'));

// Views
Vue.component('vt-item-randomizer', require('./views/ItemRandomizer.vue'));
Vue.component('vt-entrance-randomizer', require('./views/EntranceRandomizer.vue'));
Vue.component('vt-customizer', require('./views/Customizer.vue'));

// ignore adsense
Vue.config.ignoredElements = ['ins'];

// todo: remove this later
window.getSprite = function getSprite(sprite_name) {
	return new Promise(function(resolve, reject) {
		if (sprite_name == 'random') {
			var options = $('#sprite-gfx option');
			sprite_name = options[Math.floor(Math.random() * (options.length - 1))].value;
		}
		localforage.getItem('vt_sprites.' + sprite_name).then(function(spr) {
			if (spr) {
				resolve(spr);
				return;
			}
			var oReq = new XMLHttpRequest();
			oReq.open("GET", "http://spr.beegunslingers.com/" + sprite_name, true);
			oReq.responseType = "arraybuffer";

			oReq.onload = function(oEvent) {
				var spr_array = new Uint8Array(oReq.response);
				localforage.setItem('vt_sprites.' + sprite_name, spr_array).then(function(spr) {
					resolve(spr);
				});
			};

			oReq.send();
		});
	});
}
