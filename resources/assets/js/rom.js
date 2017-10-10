const SparkMD5 = require('./spark-md5');
const FileSaver = require('file-saver');

var ROM = (function(blob, loaded_callback) {
	var u_array;
	var arrayBuffer;

	var music = {
		0:[866107,866139,889080],
		20:[894736,894884,894907,894930],
		60:[874836,877883,894774,894802,894834,894866],
		80:[875335,875358],
		90:[869126],
		100:[878712,878723,880200,880246,880379,880429,893457,893787,893819,893838,893855,894403,894609,894632,894687],
		120:[861001,868165,869099,870585,870655,873535,874519,874839,875211,875240,875338,894430,894472,894517,894562,894751,894895,894918,894941],
		130:[864000,893909],
		160:[861340,861389,863241,863315,863407,863467,863633,863974,866541,867473,867539,867560,868108,868226,868447,868665,868760,868821,868854,
			868907,868976,869041,869172,869233,869286,869339,869406,869783,871228,871339,871427,871507,871551,871836,873508,878034,878159,878232,
			878335,878981,879708,879727,879758,879796,879997,885373,890380,890920,893491,893858,894110,894763,894789,894821,894853,895990,896013,
			896702,896940],
		170:[891394,891862],
		180:[860621,860793,863846,863856,863915,867223,867244,867304,867341,867385,867432,867487,867516,868382,869008,869438,869743,870355,871747,
			871884,872122,872203,872421,872466,873660,873685,873712,873737,874456,874937,875055,875243,876126,876521,877967,878410,878631,879062,
			879093,879109,879337,880079,880160,880331,881108,881126,881155,881182,886564,886578,890450,890520,892092,892352,892489,895592,895607,
			895624,895641,896772],
		140:[859432,859457,859484,859511,859886,864541,864721,868680,873795,875375,878003,878432,879467,880118,880141,881569,885068,885341,885438,
			885568,885652,885804,886678,887043,887082,889320,889387,889568,889726,889793,895320,895345,895372,895399],
		200:[859538,859581,859627,859997,860063,860093,860124,860138,860362,860603,860873,862036,862284,862310,862343,862368,862394,862427,862452,
			862526,863219,863263,863337,863393,863429,863493,863603,863663,863805,864054,864070,864111,864207,864223,864299,864390,864409,864421,
			864461,864502,864596,864644,865082,865241,865439,865610,865765,865828,865852,865906,865937,865972,865990,866084,866151,866507,867101,
			867119,867157,867184,867201,867263,867636,867669,867694,867782,867844,867896,868197,868262,868431,868487,868730,868768,868956,869145,
			869180,869359,869388,869458,869524,869557,869650,869841,869871,870018,870083,870460,870472,870485,870498,870511,870524,870940,870971,
			871008,871207,871546,871698,871809,872080,872150,872162,872453,872494,872508,872577,872881,872903,872911,872943,872972,872980,873009,
			873047,873069,873077,873135,873149,873165,873179,873628,874497,874660,875112,875135,875538,875889,876048,876186,876427,876452,877850,
			877890,878061,878109,878295,878454,878781,878821,878934,878963,879016,879185,879238,879510,879678,879946,880284,880512,881022,881040,
			881081,885021,885049,885099,885130,885150,885182,885404,885473,885510,885518,885598,885675,885706,885744,885752,885835,885881,885918,
			885963,885995,886003,886090,886131,886173,886196,886222,886314,886401,886755,886783,886907,886982,887011,887108,887163,887959,887972,
			887987,888002,888017,888065,889211,889228,889242,889269,889296,889309,889376,889459,889476,889490,889517,889544,889557,889617,889634,
			889648,889675,889702,889715,889782,890790,890818,890844,890875,890897,891135,891247,891304,891349,891440,891470,891499,891528,891639,
			891677,891715,891772,891817,892036,892045,892076,892136,892147,892157,892230,893790,893822,893841,894072,894147,894167,894198,894229,
			894690,895426,895469,895515,895575,895919,895945,895970,896040,896070,896099,896184,896236,896264,896293,896322,896351,896535,896564,
			896593,896814,896853,896875,896897,897359,897387,897408,897429,897450],
		210:[863112,865866,865951,866119],
		220:[860479,860532,860830,861222,870193,870227,870260,870293,870326,871077,871140,871318,871589,873591,875069,877926,878380,878528,879032,
			879281,879621,880051,881067,888365,888589,890080,890180,890280,891266,891734,894612,894635,896648,896712,896742,897471],
		230:[860426,860892,861255,875085,875996,893521,893548],
		240:[889950,890493,890562,892053,892646,894406],
		250:[860231,861378,861420,861604,867754,872872,872934,873038,873118,876613,885214,885278,890026,891550,891620,893577],
		255:[860293,860613,876328]
	};

	var fileReader = new FileReader();

	fileReader.onload = function() {
		arrayBuffer = this.result;
	};

	fileReader.onloadend = function() {
		// fill out rom to 2mb
		if (arrayBuffer.byteLength < 2097152) {
			arrayBuffer = this.resizeUint8(arrayBuffer, 2097152);
		}

		u_array = new Uint8Array(arrayBuffer);

		if (loaded_callback) loaded_callback(this);
	}.bind(this);

	fileReader.readAsArrayBuffer(blob);

	this.checkMD5 = function() {
		return SparkMD5.ArrayBuffer.hash(arrayBuffer);
	};

	this.getArrayBuffer = function() {
		return arrayBuffer;
	};

	this.write = function(seek, bytes) {
		if (!bytes.length) {
			u_array[seek] = bytes;
			return;
		}
		for (var i = 0; i < bytes.length; i++) {
			u_array[seek + i] = bytes[i];
		}
	};

	this.updateChecksum = function() {
		return new Promise(function(resolve, reject) {
			var sum = u_array.reduce(function(sum, mbyte, i) {
				if (i >= 0x7FB0 && i <= 0x7FE0) {
					return sum;
				}
				return sum + mbyte;
			});
			var checksum = sum & 0xFFFF;
			var inverse = checksum ^ 0xFFFF;
			this.write(0x7FDC, [inverse & 0xFF, inverse >> 8, checksum & 0xFF, checksum >> 8]);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.save = function(filename) {
		this.updateChecksum().then(function() {
			FileSaver.saveAs(new Blob([u_array]), filename);
		});
	};

	this.parseSprGfx = function(spr) {
		return new Promise(function(resolve, reject) {
			for (var i = 0; i < 0x7000; i++) {
				u_array[0x80000 + i] = spr[i];
			}
			for (var i = 0; i < 120; i++) {
				u_array[0xDD308 + i] = spr[0x7000 + i];
			}
			// gloves color
			u_array[0xDEDF5] = spr[0x7036];
			u_array[0xDEDF6] = spr[0x7037];
			u_array[0xDEDF7] = spr[0x7054];
			u_array[0xDEDF8] = spr[0x7055];
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setSramTrace = function(enable) {
		return new Promise(function(resolve, reject) {
			this.write(0x180030, enable ? 0x01 : 0x00);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setMusicVolume = function(enable) {
		return new Promise(function(resolve, reject) {
			for (volume in this.music) {
				for (var i = 0; i < this.music[volume].length; i++) {
					u_array[this.music[volume][i]] = enable ? volume : 0;
				}
			}
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setFastMenu = function(enable) {
		return new Promise(function(resolve, reject) {
			this.write(0x180048, enable ? 0x01 : 0x00);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setHeartSpeed = function(speed) {
		return new Promise(function(resolve, reject) {
			var sbyte = 0x20;
			switch (speed) {
				case 'off': sbyte = 0x00; break;
				case 'half': sbyte = 0x40; break;
				case 'quarter': sbyte = 0x80; break;
			}
			this.write(0x180033, sbyte);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.parsePatch = function(patch, progressCallback) {
		return new Promise(function(resolve, reject) {
			patch.forEach(function(value, index, array) {
				if (progressCallback) progressCallback(index / patch.length, this);
				for (address in value) {
					this.write(Number(address), value[address]);
				}
			}.bind(this));
			resolve(this);
		}.bind(this));
	};

	this.resizeUint8 = function(baseArrayBuffer, newByteSize) {
		var resizedArrayBuffer = new ArrayBuffer(newByteSize),
			len = baseArrayBuffer.byteLength,
			resizeLen = (len > newByteSize)? newByteSize : len;

		(new Uint8Array(resizedArrayBuffer, 0, resizeLen)).set(new Uint8Array(baseArrayBuffer, 0, resizeLen));

		return resizedArrayBuffer;
	}
});

module.exports = ROM;
