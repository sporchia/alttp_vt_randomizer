
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
