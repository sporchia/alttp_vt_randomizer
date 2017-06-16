#!/usr/bin/env node

const util = require('util');
const exec = util.promisify(require('child_process').exec);
const jsonexport = require('jsonexport');

var results = {};
var chunks = [];
// use 5 processors
for (var i = 0; i < 5; i++) {
	chunks[i] = getResults(5000);
}

Promise.all(chunks).then(values => {
	console.log(JSON.stringify(results, null, 2));
});

async function getResults(itterations) {
	const { stdout, stderr } = await exec('php artisan alttp:distribution required blah ' + itterations);
	results = mergeSum(results, JSON.parse(stdout));
}

function cleanResults(results) {
	var ret = [];
	for (var location in results) {
		results[location].name = location;
		ret.push(results[location]);
	}
	return ret;
}

function mergeSum(objA, objB) {
	var ret = {};
	var keys = [...new Set(Object.keys(objA).concat(Object.keys(objB)))];
	keys.forEach(function(key) {
		ret[key] = sumProperties(objA[key] || {}, objB[key] || {});
	});
	return ret;
}

function sumProperties(objA, objB) {
return Object.keys(objA)
	.reduce(function(obj, k) {
		obj[k] = (obj[k] || 0) + objA[k];
		return obj;
	}, Object.assign({}, objB))
}
