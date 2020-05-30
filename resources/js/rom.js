const SparkMD5 = require('spark-md5');
const FileSaver = require('file-saver');
const Prando = require('prando').default;
const PotShuffle = require('./potshuffle').default;

function RGBtoColor(r, g, b) {
    return (r << 16) + (g << 8) + b;
}

var ROM = (function(blob, loaded_callback, error_callback) {
	var u_array = [];
	var arrayBuffer;
	var base_patch;
	var original_data;
    var size = 2; // mb
    var rand = new Prando();

	var fileReader = new FileReader();

	fileReader.onload = function() {
		arrayBuffer = this.result;
	};

	fileReader.onloadend = function() {
		if (typeof arrayBuffer === 'undefined') {
			if (error_callback) error_callback();
			return;
		}
		// Check rom for header and cut it out
		if (arrayBuffer.byteLength % 0x400 == 0x200) {
			arrayBuffer = arrayBuffer.slice(0x200, arrayBuffer.byteLength);
		}

		original_data = arrayBuffer.slice(0);
		this.resize(size);

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

	this.getOriginalArrayBuffer = function() {
		return original_data;
	};

	this.write = function(seek, bytes) {
		if (!Array.isArray(bytes)) {
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
				if (i >= 0x7FDC && i < 0x7FE0) {
					return sum;
				}
				return sum + mbyte;
			});
			var checksum = (sum + 0x1FE) & 0xFFFF;
			var inverse = checksum ^ 0xFFFF;
			this.write(0x7FDC, [inverse & 0xFF, inverse >> 8, checksum & 0xFF, checksum >> 8]);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.save = function(filename, { paletteShuffle, quickswap, musicOn }) {
		let preProcess = arrayBuffer.slice(0);

		if (paletteShuffle) {
			this.randomizePalettes();
		}
		if (!this.tournament || this.allowQuickSwap) {
			this.setQuickswap(quickswap);
		} else {
			this.setQuickswap(false);
		}
		this.setMusicVolume(musicOn);

		this.updateChecksum().then(function() {
			FileSaver.saveAs(new Blob([u_array]), filename);

			// undo any presave processing we did.
			arrayBuffer = preProcess;
			u_array = new Uint8Array(arrayBuffer);
		});
	};

	this.parseSprGfx = function(spr) {
		if ('ZSPR' == String.fromCharCode(spr[0]) + String.fromCharCode(spr[1]) + String.fromCharCode(spr[2]) + String.fromCharCode(spr[3])) {
			return this.parseZsprGfx(spr);
		}
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

	this.parseZsprGfx = function(zspr) {
		// we are going to just hope that it's in the proper format O.o
		return new Promise(function(resolve, reject) {
			var gfx_offset =  zspr[12] << 24 | zspr[11] << 16 | zspr[10] << 8 | zspr[9];
			var palette_offset = zspr[18] << 24 | zspr[17] << 16 | zspr[16] << 8 | zspr[15];
			// GFX
			for (var i = 0; i < 0x7000; i++) {
				u_array[0x80000 + i] = zspr[gfx_offset + i];
			}
			// Palettes
			for (var i = 0; i < 120; i++) {
				u_array[0xDD308 + i] = zspr[palette_offset + i];
			}
			// Gloves
			for (var i = 0; i < 4; ++i) {
				u_array[0xDEDF5 + i] = zspr[palette_offset + 120 + i];
			}
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setQuickswap = function(enable) {
		return new Promise(function(resolve, reject) {
			this.write(0x18004B, enable ? 0x01 : 0x00);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setMusicVolume = (enable) => {
		return new Promise(resolve => {
			if (this.build > '2019-08-01') {
				this.write(0x18021A, !enable ? 0x01 : 0x00);
			} else {
				this.write(0x0CFE18, !enable ? 0x00 : 0x70);
				this.write(0x0CFEC1, !enable ? 0x00 : 0xC0);
				this.write(0x0D0000, !enable ? [0x00, 0x00] : [0xDA, 0x58]);
				this.write(0x0D00E7, !enable ? [0xC4, 0x58] : [0xDA, 0x58]);
			}

			resolve(this);
		});
	};

	this.setMenuSpeed = function(speed) {
		return new Promise(function(resolve, reject) {
			var fast = false;
			switch (speed) {
				case 'instant':
				this.write(0x180048, 0xE8);
					fast = true;
					break;
				case 'fast':
				this.write(0x180048, 0x10);
					break;
				case 'normal':
				default:
				this.write(0x180048, 0x08);
					break;
				case 'slow':
				this.write(0x180048, 0x04);
					break;
			}
			this.write(0x6DD9A, fast ? 0x20 : 0x11);
			this.write(0x6DF2A, fast ? 0x20 : 0x12);
			this.write(0x6E0E9, fast ? 0x20 : 0x12);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.setHeartColor = function(color_on) {
		return new Promise(function(resolve, reject) {
			switch (color_on) {
				case 'blue':
					byte = 0x2C;
					file_byte = 0x0D;
					break;
				case 'green':
					byte = 0x3C;
					file_byte = 0x19;
					break;
				case 'yellow':
					byte = 0x28;
					file_byte = 0x09;
					break;
				case 'red':
				default:
					byte = 0x24;
					file_byte = 0x05;
			}
			this.write(0x6FA1E, byte);
			this.write(0x6FA20, byte);
			this.write(0x6FA22, byte);
			this.write(0x6FA24, byte);
			this.write(0x6FA26, byte);
			this.write(0x6FA28, byte);
			this.write(0x6FA2A, byte);
			this.write(0x6FA2C, byte);
			this.write(0x6FA2E, byte);
			this.write(0x6FA30, byte);
			this.write(0x65561, file_byte);
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
				case 'double': sbyte = 0x10; break;
			}
			this.write(0x180033, sbyte);
			resolve(this);
		}.bind(this));
	}.bind(this);

	this.parsePatch = function(data, progressCallback) {
		return new Promise(function(resolve, reject) {
            this.rand = new Prando(data.hash);
			this.seed = data.seed;
			this.spoiler = data.spoiler;
			this.hash = data.hash;
			this.generated = data.generated;
			if (data.size) {
				this.resize(data.size);
			}
			if (data.spoiler && data.spoiler.meta) {
				this.accessibility = data.spoiler.meta.accessibility;
				this.build = data.spoiler.meta.build;
				this.goal = data.spoiler.meta.goal;
				this.logic = data.spoiler.meta.logic;
				this.mode = data.spoiler.meta.mode;
				this.name = data.spoiler.meta.name;
				this.variation = data.spoiler.meta.variation;
				this.weapons = data.spoiler.meta.weapons;
				this.shuffle = data.spoiler.meta.shuffle;
				this.difficulty_mode = data.spoiler.meta.difficulty_mode;
				this.difficulty = data.spoiler.meta.difficulty;
				this.notes = data.spoiler.meta.notes;
				this.tournament = data.spoiler.meta.tournament;
				this.spoilers = data.spoiler.meta.spoilers;
				this.allow_quickswap = data.spoiler.meta.allow_quickswap;
				this.special = data.spoiler.meta.special;
			}
			if (data.patch && data.patch.length) {
				data.patch.forEach(function(value, index, array) {
					if (progressCallback) progressCallback(index / data.patch.length, this);
					for (address in value) {
						this.write(Number(address), value[address]);
					}
				}.bind(this));
			}
			resolve(this);
		}.bind(this));
	};

	this.setBasePatch = function(patch) {
		this.base_patch = patch;
	};

	this.resizeUint8 = function(baseArrayBuffer, newByteSize) {
		var resizedArrayBuffer = new ArrayBuffer(newByteSize),
			len = baseArrayBuffer.byteLength,
			resizeLen = (len > newByteSize)? newByteSize : len;

		(new Uint8Array(resizedArrayBuffer, 0, resizeLen)).set(new Uint8Array(baseArrayBuffer, 0, resizeLen));

		return resizedArrayBuffer;
	};

	this.resize = function(size) {
		switch (size) {
			case 4:
				arrayBuffer = this.resizeUint8(arrayBuffer, 4194304);
				break;
			case 2:
				arrayBuffer = this.resizeUint8(arrayBuffer, 2097152);
				break;
			case 1:
			default:
				size = 1;
				arrayBuffer = this.resizeUint8(arrayBuffer, 1048576);
		}
		u_array = new Uint8Array(arrayBuffer);
		this.size = size;
	};

	this.downloadFilename = function() {
		if (this.name) {
			return 'alttpr - ' + this.name + '_' + this.hash
		} else if (this.spoilers == "mystery") {
			return 'alttpr - mystery_' + this.hash;
		} else {
			return 'alttpr - ' + this.logic
				+ '-' + this.mode
				+ '-' + this.goal
				+ '_' + this.hash
				+ (this.special ? '_special' : '');
		}
	};

	this.reset = function(size) {
		return new Promise((resolve, reject) => {
			arrayBuffer = original_data.slice(0);
			// always reset to 2mb so we can verify MD5 later
			this.resize(2);

			if (!this.base_patch) {
				reject('base patch not set');
			}
			this.parsePatch({patch: this.base_patch}).then((rom) => {
				resolve(rom);
			}).catch((error) => {
				console.log(error, ":(");
				reject('sadness');
			});
		});
    };

    this.getRandomColor = function()
    {
        var r = this.rand.nextInt(60, 240);
        var g = this.rand.nextInt(60, 240);
        var b = this.rand.nextInt(60, 240);

        return RGBtoColor(r, g, b);
    }

    this.randomizePalettes = function()
    {
        this.randomizeDungeonPalettes();
        this.randomizeOverworldPalettes();
    }

	this.setColor = function(address, color, shade)
	{
		const r = (((color >> 16) & 0xFF) * Math.pow(.8, shade)) / 255 * 0x1F;
		const g = (((color >> 8) & 0xFF) * Math.pow(.8, shade)) / 255 * 0x1F;
		const b = ((color & 0xFF) * Math.pow(.8, shade)) / 255 * 0x1F;

        const snesColor = (b << 10) | (g << 5) | (r << 0);
		this.write(address, snesColor & 0xFF);
		this.write(address + 1, (snesColor >> 8) & 0xFF);
    }

    this.randomizeDungeonPalettes = function()
    {
        for (let i = 0; i < 20; i++)
        {
            this.randomizeWall(i);
            this.randomizeFloors(i);
        }
    }

    this.randomizeWall = function(dungeon)
    {
        var wallColor = this.getRandomColor();
        for (let i = 0; i < 5; i++) {
            var shadex = (10 - (i * 2));
            this.setColor((0xDD734 + (0xB4 * dungeon)) + (i * 2), wallColor, shadex);
            this.setColor((0xDD770 + (0xB4 * dungeon)) + (i * 2), wallColor, shadex);
            this.setColor((0xDD744 + (0xB4 * dungeon)) + (i * 2), wallColor, shadex);

            if (dungeon == 0) {
                this.setColor((0xDD7CA + (0xB4 * dungeon)) + (i * 2), wallColor, shadex);
            }
        }

        if (dungeon == 2) {
            this.setColor((0xDD74E + (0xB4 * dungeon)), wallColor, 3);
            this.setColor((0xDD74E + 2 + (0xB4 * dungeon)), wallColor, 5);
            this.setColor((0xDD73E + (0xB4 * dungeon)), wallColor, 3);
            this.setColor((0xDD73E + 2 + (0xB4 * dungeon)), wallColor, 5);
        }

        this.setColor(0xDD7E4 + (0xB4 * dungeon), wallColor, 4);
        this.setColor(0xDD7E6 + (0xB4 * dungeon), wallColor, 2);

        this.setColor(0xDD7DA + (0xB4 * dungeon), wallColor, 10);
        this.setColor(0xDD7DC + (0xB4 * dungeon), wallColor, 8);


        var potColor = this.getRandomColor();
        this.setColor(0xDD75A + (0xB4 * dungeon), potColor, 7);
        this.setColor(0xDD75C + (0xB4 * dungeon), potColor, 1);
        this.setColor(0xDD75E + (0xB4 * dungeon), potColor, 3);

        this.setColor(0xDD76A + (0xB4 * dungeon), wallColor, 7);
        this.setColor(0xDD76C + (0xB4 * dungeon), wallColor, 2);
        this.setColor(0xDD76E + (0xB4 * dungeon), wallColor, 4);

        var chestColor = this.getRandomColor();
        this.setColor(0xDD7AE + (0xB4 * dungeon), chestColor, 2);
        this.setColor(0xDD7B0 + (0xB4 * dungeon), chestColor, 0);
    }

    this.randomizeFloors = function(dungeon)
    {
        const floorColor = [
            this.getRandomColor(),
            this.getRandomColor(),
            this.getRandomColor()
        ];

        for (let i = 0; i < 3; i++) {
            var shadex = (6 - (i * 2)) & 0xFF;
            this.setColor(0xDD764 + (0xB4 * dungeon) + (i * 2), floorColor[0], shadex);
            this.setColor(0xDD782 + (0xB4 * dungeon) + (i * 2), floorColor[0], (shadex + 3) & 0xFF);

            this.setColor(0xDD7A0 + (0xB4 * dungeon) + (i * 2), floorColor[1], shadex);
            this.setColor(0xDD7BE + (0xB4 * dungeon) + (i * 2), floorColor[1], (shadex + 3) & 0xFF);
        }

        this.setColor(0xDD7E2 + (0xB4 * dungeon), floorColor[2], 3);
        this.setColor(0xDD796 + (0xB4 * dungeon), floorColor[2], 4);
    }

    this.randomizeOverworldPalettes = function()
    {
        const grass = this.getRandomColor();
        const grass2 = this.getRandomColor();
        const grass3 = this.getRandomColor();
        const dirt = this.getRandomColor();
        const dirt2 = this.getRandomColor();
        const water = this.getRandomColor();
        const clouds = this.getRandomColor();
        const dwdirt = this.getRandomColor();
        const dwgrass = this.getRandomColor();
        const dwwater = this.getRandomColor();
        const dwdmdirt = this.getRandomColor();
        const dwdmgrass = this.getRandomColor();
        const dwdmclouds1 = this.getRandomColor();
        const dwdmclouds2 = this.getRandomColor();

        const treeleaf = RGBtoColor(
            ((grass >> 16) & 0xFF) - 20 + this.rand.nextInt(0, 30),
            ((grass >> 8) & 0xFF) - 20 + this.rand.nextInt(0, 30),
            (grass & 0xFF) - 20 + this.rand.nextInt(0, 30)
        );
        const dwtree = RGBtoColor(
            ((dwgrass >> 16) & 0xFF) - 20 + this.rand.nextInt(0, 30),
            ((dwgrass >> 8) & 0xFF) - 20 + this.rand.nextInt(0, 30),
            (dwgrass & 0xFF) - 20 + this.rand.nextInt(0, 30)
        );

        [0x67FB4, 0x67F94, 0x67FC6, 0x67FE6, 0x5FEA9, 0xDE886, 0xDE6D2,
            0xDE6FC, 0xDE70A, 0xDE6FE, 0xDE93A, 0xDE92C, 0xDE91E,
            0xDEA1C, 0xDEA2A, 0xDEA30].forEach(address => {
            this.setColor(address, grass, 0);
        });

        [0xDE892, 0xDE70C, 0xDE91C, 0xDE92A].forEach(address => {
            this.setColor(address, grass, 1);
        });

        [0xDE708, 0xDD4AC].forEach(address => {
            this.setColor(address, grass, 2);
        });

        [0xDE6FA, 0X067FE1, 0X0DE6D0, 0xDE884, 0xDE8AE, 0xDE8BE, 0xDE8E4, 0xDE938, 0xDE9C4].forEach(address => {
            this.setColor(address, grass, 3);
        });

        [0xDE6D0].forEach(address => {
            this.setColor(address, grass, 4);
        });

        [0xDE6DE, 0xDD3D2, 0xDE88C, 0xDE8A8,
            0xDE9F8, 0xDEA4E, 0xDEAF6, 0xDEB2E, 0xDEB4A].forEach(address => {
            this.setColor(address, grass2, 2);
        });

        [0xDE6E0, 0xDD4AE, 0xDE9FA, 0xDEA0E].forEach(address => {
            this.setColor(address, grass2, 1);
        });

        [0xDE6E2, 0xDE9FE].forEach(address => {
            this.setColor(address, grass2, 0);
        });

        [0xDE75C, 0xDE786, 0xDE794, 0xDE99A].forEach(address => {
            this.setColor(address, grass3, 2);
        });

        [0xDE75E, 0xDE788, 0xDE796, 0xDE99C].forEach(address => {
            this.setColor(address, grass3, 1);
        });

        this.setColor(0xDE93C, dirt, 1);

        [0xDE672, 0xDE6D4, 0xDE6DC, 0xDE6E2, 0xDE6EA, 0xDE6EE, 0xDE6F0, 0xDE920, 0xDE936].forEach(address => {
            this.setColor(address, dirt, 2);
        });

        [0xDE66E, 0xDE6CE, 0xDE916, 0xDE934, 0xDE9F2].forEach(address => {
            this.setColor(address, dirt, 3);
        });

        [0xDE6CC, 0xDE6DA, 0xDE6E8, 0xDE6EC, 0xDE932].forEach(address => {
            this.setColor(address, dirt, 4);
        });

        [0xDE6CA, 0xDE6D8, 0xDE6E6, 0xDEA2E].forEach(address => {
            this.setColor(address, dirt, 5);
        });

        [0xDE756, 0xDE764, 0xDE772, 0xDE994, 0xDE9A2].forEach(address => {
            this.setColor(address, dirt2, 4);
        });

        [0xDE758, 0xDE766, 0xDE774, 0xDE996, 0xDE9A4].forEach(address => {
            this.setColor(address, dirt2, 3);
        });

        [0xDE75A, 0xDE768, 0xDE776, 0xDE778, 0xDE998, 0xDE9A6].forEach(address => {
            this.setColor(address, dirt2, 2);
        });

        [0xDE9AC, 0xDE99E, 0xDE760, 0xDE77A, 0xDE77C, 0xDE798, 0xDE664, 0xDE980].forEach(address => {
            this.setColor(address, dirt2, 1);
        });

        this.setColor(0xDE890, treeleaf, 1);

        this.setColor(0xDE894, treeleaf, 0);

        this.setColor(0xDEA10, water, 4);

        [0xDEA16, 0xDE924, 0xDE668].forEach(address => {
            this.setColor(address, water, 3);
        });

        this.setColor(0xDE66A, water, 2);

        [0xDEA1A, 0xDE92E, 0xDE918, 0xDE670].forEach(address => {
            this.setColor(address, water, 1);
        });

        [0xDE91A, 0xDE66C].forEach(address => {
            this.setColor(address, water, 2);
        });

        [0xDE76A, 0xDE9A8, 0xDE98C].forEach(address => {
            this.setColor(address, clouds, 2);
        });

        [0xDE76E, 0xDE9AA, 0xDE8DA, 0xDE8D8, 0xDE8D0, 0xDE990].forEach(address => {
            this.setColor(address, clouds, 0);
        });

        [0xDE716, 0xDE740, 0xDE74E, 0xDEAC0, 0xDEACE, 0xDEADC, 0xDEB24].forEach(address => {
            this.setColor(address, dwgrass, 3);
        });

        this.setColor(0xDE752, dwgrass, 2);

        [0xDE718, 0xDE742, 0xDE750, 0xDEB26, 0xDEAC2, 0xDEAD0, 0xDEADE, 0x5FEB3].forEach(address => {
            this.setColor(address, dwgrass, 1);
        });

        this.setColor(0xDEB34, dwtree, 4);

        this.setColor(0xDEB30, dwtree, 3);

        this.setColor(0xDEB32, dwtree, 1);

        [0xDE710, 0xDE71E, 0xDE72C, 0xDEAD6].forEach(address => {
            this.setColor(address, dwdirt, 5);
        });

        [0xDE712, 0xDE720, 0xDE72E, 0xDE660, 0xDEAD8].forEach(address => {
            this.setColor(address, dwdirt, 4);
        });

        [0xDEADA, 0xDE714, 0xDE722, 0xDE730, 0xDE732].forEach(address => {
            this.setColor(address, dwdirt, 3);
        });

        [0xDE734, 0xDE736, 0xDE728, 0xDE71A, 0xDE664, 0xDEAE0].forEach(address => {
            this.setColor(address, dwdirt, 2);
		});

        this.setColor(0xDE65A, dwwater, 5);

        [0xDEAC8, 0xDEAAE, 0xDEAAC, 0xDE65C].forEach(address => {
            this.setColor(address, dwwater, 3);
        });

        [0xDEAD2, 0xDEABC, 0xDEAB6, 0xDEA9E, 0xDEA98, 0xDE662].forEach(address => {
            this.setColor(address, dwwater, 2);
        });

        [0xDEABE, 0xDE65E].forEach(address => {
            this.setColor(address, dwwater, 1);
        });

        [0xDE7BC, 0xDE7A2, 0xDE7BE, 0xDE7CC, 0xDE7DA, 0xDEB6A, 0xDE948, 0xDE956, 0xDE964].forEach(address => {
            this.setColor(address, dwdmgrass, 3);
        });

        [0xDEA1A, 0xDEA16, 0x67FE1, 0x67F94, 0x67FB4, 0x67FC6, 0x67FE6, 0xDD4A0, 0xDE8E6,
            0xDEA1C, 0xDE7CE, 0xDE7A4, 0xDEBA2, 0xDEBB0].forEach(address => {
            this.setColor(address, dwdmgrass, 1);
        });

        [0xDE79A, 0xDE7A8, 0xDE7B6, 0xDEB60, 0xDEB6E, 0xDE93E, 0xDE94C, 0xDEBA6].forEach(address => {
            this.setColor(address, dwdmdirt, 6);
        });

        [0xDE79C, 0xDE7AA, 0xDE7B8, 0xDE7BE, 0xDE7CC, 0xDE7DA, 0xDEB70, 0xDEBA8].forEach(address => {
            this.setColor(address, dwdmdirt, 4);
        });

        [0xDEB72, 0xDEB74, 0xDE79E, 0xDE7AC, 0xDEB6A, 0xDE948, 0xDE956, 0xDE964, 0xDEBAA, 0xDE7A0].forEach(address => {
            this.setColor(address, dwdmdirt, 3);
        });

        [0xDEBAC, 0xDE7AE, 0xDE7C2, 0xDE7A6, 0xDEB7A, 0xDEB6C, 0xDE7C0].forEach(address => {
            this.setColor(address, dwdmdirt, 2);
        });

        [0xDE644, 0xDEB84].forEach(address => {
            this.setColor(address, dwdmclouds1, 2);
        });

        [0xDE648, 0xDEB88].forEach(address => {
            this.setColor(address, dwdmclouds1, 1);
        });

        [0xDEBAE, 0xDE7B0].forEach(address => {
            this.setColor(address, dwdmclouds2, 2);
        });

        [0xDE7B4, 0xDEB78, 0xDEBB2].forEach(address => {
            this.setColor(address, dwdmclouds2, 0);
        });
    }
});

module.exports = ROM;
