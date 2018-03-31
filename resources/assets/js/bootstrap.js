
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
require('./bootstrap-toggle');
require('bootstrap-select');
require('bootstrap-slider');
require('select2');
window.SparkMD5 = require('./spark-md5');
window.localforage = require('localforage');
window.jszip = require('jszip');
window.FileSaver = require('file-saver');
window.ROM = require('./rom.js');
