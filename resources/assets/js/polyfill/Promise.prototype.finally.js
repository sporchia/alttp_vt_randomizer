// from on https://github.com/tc39/proposal-promise-finally/blob/master/polyfill.js
if (typeof Promise !== 'function') {
	throw new TypeError('A global Promise is required');
}

if (typeof Promise.prototype.finally !== 'function') {
	var speciesConstructor = function (O, defaultConstructor) {
		if (!O || (typeof O !== 'object' && typeof O !== 'function')) {
			throw new TypeError('Assertion failed: Type(O) is not Object');
		}
		var C = O.constructor;
		if (typeof C === 'undefined') {
			return defaultConstructor;
		}
		if (!C || (typeof C !== 'object' && typeof C !== 'function')) {
			throw new TypeError('O.constructor is not an Object');
		}
		var S = typeof Symbol === 'function' && typeof Symbol.species === 'symbol' ? C[Symbol.species] : undefined;
		if (S == null) {
			return defaultConstructor;
		}
		if (typeof S === 'function' && S.prototype) {
			return S;
		}
		throw new TypeError('no constructor found');
	};

	var shim = {
		finally(onFinally) {
			var promise = this;
			if (typeof promise !== 'object' || promise === null) {
				throw new TypeError('"this" value is not an Object');
			}
			var C = speciesConstructor(promise, Promise); // throws if SpeciesConstructor throws
			if (typeof onFinally !== 'function') {
				return Promise.prototype.then.call(promise, onFinally, onFinally);
			}
			return Promise.prototype.then.call(
				promise,
				x => new C(resolve => resolve(onFinally())).then(() => x),
				e => new C(resolve => resolve(onFinally())).then(() => { throw e; })
			);
		}
	};
	Object.defineProperty(Promise.prototype, 'finally', { configurable: true, writable: true, value: shim.finally });
}
