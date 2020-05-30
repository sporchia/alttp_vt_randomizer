import SparkMD5 from "spark-md5";
import FileSaver from "file-saver";
import Prando from "prando";
import BPS from "./bps";

export default class ROM {
  constructor(blob, loadedCallback) {
    this.u_array = [];
    this.arrayBuffer;
    this.originalData;
    this.size = 2;

    const fileReader = new FileReader();

    fileReader.onload = event => {
      this.arrayBuffer = event.target.result;
    };

    fileReader.onloadend = () => {
      if (typeof this.arrayBuffer === "undefined") {
        throw new Error("Could not read this.arrayBuffer");
      }
      // Check rom for header and cut it out
      if (this.arrayBuffer.byteLength % 0x400 == 0x200) {
        this.arrayBuffer = this.arrayBuffer.slice(
          0x200,
          this.arrayBuffer.byteLength
        );
      }

      this.originalData = this.arrayBuffer.slice(0);
      this.resize(this.size);

      this.u_array = new Uint8Array(this.arrayBuffer);

      if (loadedCallback) loadedCallback(this);
    };

    fileReader.readAsArrayBuffer(blob);
  }

  checkMD5() {
    return SparkMD5.ArrayBuffer.hash(this.arrayBuffer);
  }

  getOriginalArrayBuffer() {
    return this.originalData;
  }

  write(seek, bytes) {
    if (!Array.isArray(bytes)) {
      this.u_array[seek] = bytes;
      return;
    }
    for (var i = 0; i < bytes.length; i++) {
      this.u_array[seek + i] = bytes[i];
    }
  }

  updateChecksum() {
    return new Promise(resolve => {
      var sum = this.u_array.reduce((sum, mbyte, i) => {
        if (i >= 0x7fdc && i < 0x7fe0) {
          return sum;
        }
        return sum + mbyte;
      });
      var checksum = (sum + 0x1fe) & 0xffff;
      var inverse = checksum ^ 0xffff;
      this.write(0x7fdc, [
        inverse & 0xff,
        inverse >> 8,
        checksum & 0xff,
        checksum >> 8
      ]);
      resolve(this);
    });
  }

  save(filename, { paletteShuffle, quickswap, musicOn }) {
    let preProcess = this.arrayBuffer.slice(0);

    if (paletteShuffle) {
      this.randomizePalettes();
    }
    if (!this.tournament || this.allowQuickSwap) {
      this.setQuickswap(quickswap);
    } else {
      this.setQuickswap(false);
    }
    this.setMusicVolume(musicOn);

    this.updateChecksum().then(() => {
      FileSaver.saveAs(new Blob([this.u_array]), filename);

      // undo any presave processing we did.
      this.arrayBuffer = preProcess;
      this.u_array = new Uint8Array(this.arrayBuffer);
    });
  }

  parseSprGfx(spr) {
    const headBytes =
      String.fromCharCode(spr[0]) +
      String.fromCharCode(spr[1]) +
      String.fromCharCode(spr[2]) +
      String.fromCharCode(spr[3]);

    if ("ZSPR" == headBytes) {
      return this.parseZsprGfx(spr);
    }

    return new Promise(resolve => {
      for (let i = 0; i < 0x7000; i++) {
        this.u_array[0x80000 + i] = spr[i];
      }
      for (let i = 0; i < 120; i++) {
        this.u_array[0xdd308 + i] = spr[0x7000 + i];
      }
      // gloves color
      this.u_array[0xdedf5] = spr[0x7036];
      this.u_array[0xdedf6] = spr[0x7037];
      this.u_array[0xdedf7] = spr[0x7054];
      this.u_array[0xdedf8] = spr[0x7055];
      resolve(this);
    });
  }

  // we are going to just hope that it's in the proper format O.o
  parseZsprGfx(zspr) {
    return new Promise(resolve => {
      const gfx_offset =
        (zspr[12] << 24) | (zspr[11] << 16) | (zspr[10] << 8) | zspr[9];
      const palette_offset =
        (zspr[18] << 24) | (zspr[17] << 16) | (zspr[16] << 8) | zspr[15];

      // GFX
      for (let i = 0; i < 0x7000; i++) {
        this.u_array[0x80000 + i] = zspr[gfx_offset + i];
      }

      // Palettes
      for (let i = 0; i < 120; i++) {
        this.u_array[0xdd308 + i] = zspr[palette_offset + i];
      }

      // Gloves
      for (let i = 0; i < 4; ++i) {
        this.u_array[0xdedf5 + i] = zspr[palette_offset + 120 + i];
      }

      resolve(this);
    });
  }

  setQuickswap(enable) {
    return new Promise(resolve => {
      this.write(0x18004b, enable ? 0x01 : 0x00);

      resolve(this);
    });
  }

  setMusicVolume(enable) {
    return new Promise(resolve => {
      if (this.build > "2019-08-01") {
        this.write(0x18021a, !enable ? 0x01 : 0x00);
      } else {
        this.write(0x0cfe18, !enable ? 0x00 : 0x70);
        this.write(0x0cfec1, !enable ? 0x00 : 0xc0);
        this.write(0x0d0000, !enable ? [0x00, 0x00] : [0xda, 0x58]);
        this.write(0x0d00e7, !enable ? [0xc4, 0x58] : [0xda, 0x58]);
      }

      resolve(this);
    });
  }

  setMenuSpeed(speed) {
    return new Promise(resolve => {
      let fast = false;
      switch (speed) {
        case "instant":
          this.write(0x180048, 0xe8);
          fast = true;

          break;
        case "fast":
          this.write(0x180048, 0x10);

          break;
        case "normal":
        default:
          this.write(0x180048, 0x08);

          break;
        case "slow":
          this.write(0x180048, 0x04);

          break;
      }
      this.write(0x6dd9a, fast ? 0x20 : 0x11);
      this.write(0x6df2a, fast ? 0x20 : 0x12);
      this.write(0x6e0e9, fast ? 0x20 : 0x12);

      resolve(this);
    });
  }

  setHeartColor(color_on) {
    return new Promise(resolve => {
      let byte = 0x24;
      let file_byte = 0x05;

      switch (color_on) {
        case "blue":
          byte = 0x2c;
          file_byte = 0x0d;

          break;
        case "green":
          byte = 0x3c;
          file_byte = 0x19;

          break;
        case "yellow":
          byte = 0x28;
          file_byte = 0x09;

          break;
        case "red":
        default:
        // do nothing
      }

      this.write(0x6fa1e, byte);
      this.write(0x6fa20, byte);
      this.write(0x6fa22, byte);
      this.write(0x6fa24, byte);
      this.write(0x6fa26, byte);
      this.write(0x6fa28, byte);
      this.write(0x6fa2a, byte);
      this.write(0x6fa2c, byte);
      this.write(0x6fa2e, byte);
      this.write(0x6fa30, byte);
      this.write(0x65561, file_byte);

      resolve(this);
    });
  }

  setHeartSpeed(speed) {
    return new Promise(resolve => {
      let sbyte = 0x20;
      switch (speed) {
        case "off":
          sbyte = 0x00;

          break;
        case "half":
          sbyte = 0x40;

          break;
        case "quarter":
          sbyte = 0x80;

          break;
        case "double":
          sbyte = 0x10;

          break;
      }
      this.write(0x180033, sbyte);

      resolve(this);
    });
  }

  parsePatch(data, progressCallback) {
    return new Promise(resolve => {
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
        this.special = data.spoiler.meta.special;
      }

      if (data.patch && data.patch.length) {
        data.patch.forEach((value, index) => {
          if (progressCallback)
            progressCallback(index / data.patch.length, this);
          for (let address in value) {
            this.write(Number(address), value[address]);
          }
        });
      }

      resolve(this);
    });
  }

  parseBaseBPS(bps) {
    return new Promise(resolve => {
      const patcher = new BPS();

      patcher.setPatch(bps);
      patcher.setSource(this.originalData);

      this.arrayBuffer = patcher.applyPatch();

      resolve(this);
    });
  }

  setBaseBPS(patch) {
    this.baseBPS = patch;
  }

  resizeUint8(baseArrayBuffer, newByteSize) {
    var resizedArrayBuffer = new ArrayBuffer(newByteSize),
      len = baseArrayBuffer.byteLength,
      resizeLen = len > newByteSize ? newByteSize : len;

    new Uint8Array(resizedArrayBuffer, 0, resizeLen).set(
      new Uint8Array(baseArrayBuffer, 0, resizeLen)
    );

    return resizedArrayBuffer;
  }

  resize(size) {
    switch (size) {
      case 4:
        this.arrayBuffer = this.resizeUint8(this.arrayBuffer, 4194304);
        break;
      case 2:
        this.arrayBuffer = this.resizeUint8(this.arrayBuffer, 2097152);
        break;
      case 1:
      default:
        size = 1;
        this.arrayBuffer = this.resizeUint8(this.arrayBuffer, 1048576);
    }
    this.u_array = new Uint8Array(this.arrayBuffer);
    this.size = size;
  }

  downloadFilename() {
    if (this.name) {
      return "alttpr - " + this.name + "_" + this.hash;
    } else if (this.spoilers == "mystery") {
      return "alttpr - mystery_" + this.hash;
    } else {
      return (
        "alttpr - " +
        this.logic +
        "-" +
        this.mode +
        "-" +
        this.goal +
        "_" +
        this.hash +
        (this.special ? "_special" : "")
      );
    }
  }

  reset() {
    return new Promise((resolve, reject) => {
      this.arrayBuffer = this.originalData.slice(0);
      // always reset to 2mb so we can verify MD5 later
      this.resize(2);

      if (!this.baseBPS) {
        reject("base patch not set");
      }
      this.parseBaseBPS(this.baseBPS)
        .then(rom => {
          resolve(rom);
        })
        .catch(error => {
          console.log(error, ":(");
          reject("sadness");
        });
    });
  }

  RGBtoColor(r, g, b) {
    return (r << 16) + (g << 8) + b;
  }

  getRandomColor() {
    var r = this.rand.nextInt(60, 240);
    var g = this.rand.nextInt(60, 240);
    var b = this.rand.nextInt(60, 240);

    return this.RGBtoColor(r, g, b);
  }

  randomizePalettes() {
    this.randomizeDungeonPalettes();
    this.randomizeOverworldPalettes();
  }

  setColor(address, color, shade) {
    const r = ((((color >> 16) & 0xff) * Math.pow(0.8, shade)) / 255) * 0x1f;
    const g = ((((color >> 8) & 0xff) * Math.pow(0.8, shade)) / 255) * 0x1f;
    const b = (((color & 0xff) * Math.pow(0.8, shade)) / 255) * 0x1f;

    const snesColor = (b << 10) | (g << 5) | (r << 0);
    this.write(address, snesColor & 0xff);
    this.write(address + 1, (snesColor >> 8) & 0xff);
  }

  randomizeDungeonPalettes() {
    for (let i = 0; i < 20; i++) {
      this.randomizeWall(i);
      this.randomizeFloors(i);
    }
  }

  randomizeWall(dungeon) {
    var wallColor = this.getRandomColor();
    for (let i = 0; i < 5; i++) {
      var shadex = 10 - i * 2;
      this.setColor(0xdd734 + 0xb4 * dungeon + i * 2, wallColor, shadex);
      this.setColor(0xdd770 + 0xb4 * dungeon + i * 2, wallColor, shadex);
      this.setColor(0xdd744 + 0xb4 * dungeon + i * 2, wallColor, shadex);

      if (dungeon == 0) {
        this.setColor(0xdd7ca + 0xb4 * dungeon + i * 2, wallColor, shadex);
      }
    }

    if (dungeon == 2) {
      this.setColor(0xdd74e + 0xb4 * dungeon, wallColor, 3);
      this.setColor(0xdd74e + 2 + 0xb4 * dungeon, wallColor, 5);
      this.setColor(0xdd73e + 0xb4 * dungeon, wallColor, 3);
      this.setColor(0xdd73e + 2 + 0xb4 * dungeon, wallColor, 5);
    }

    this.setColor(0xdd7e4 + 0xb4 * dungeon, wallColor, 4);
    this.setColor(0xdd7e6 + 0xb4 * dungeon, wallColor, 2);

    this.setColor(0xdd7da + 0xb4 * dungeon, wallColor, 10);
    this.setColor(0xdd7dc + 0xb4 * dungeon, wallColor, 8);

    var potColor = this.getRandomColor();
    this.setColor(0xdd75a + 0xb4 * dungeon, potColor, 7);
    this.setColor(0xdd75c + 0xb4 * dungeon, potColor, 1);
    this.setColor(0xdd75e + 0xb4 * dungeon, potColor, 3);

    this.setColor(0xdd76a + 0xb4 * dungeon, wallColor, 7);
    this.setColor(0xdd76c + 0xb4 * dungeon, wallColor, 2);
    this.setColor(0xdd76e + 0xb4 * dungeon, wallColor, 4);

    var chestColor = this.getRandomColor();
    this.setColor(0xdd7ae + 0xb4 * dungeon, chestColor, 2);
    this.setColor(0xdd7b0 + 0xb4 * dungeon, chestColor, 0);
  }

  randomizeFloors(dungeon) {
    const floorColor = [
      this.getRandomColor(),
      this.getRandomColor(),
      this.getRandomColor()
    ];

    for (let i = 0; i < 3; i++) {
      var shadex = (6 - i * 2) & 0xff;
      this.setColor(0xdd764 + 0xb4 * dungeon + i * 2, floorColor[0], shadex);
      this.setColor(
        0xdd782 + 0xb4 * dungeon + i * 2,
        floorColor[0],
        (shadex + 3) & 0xff
      );

      this.setColor(0xdd7a0 + 0xb4 * dungeon + i * 2, floorColor[1], shadex);
      this.setColor(
        0xdd7be + 0xb4 * dungeon + i * 2,
        floorColor[1],
        (shadex + 3) & 0xff
      );
    }

    this.setColor(0xdd7e2 + 0xb4 * dungeon, floorColor[2], 3);
    this.setColor(0xdd796 + 0xb4 * dungeon, floorColor[2], 4);
  }

  randomizeOverworldPalettes() {
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

    const treeleaf = this.RGBtoColor(
      ((grass >> 16) & 0xff) - 20 + this.rand.nextInt(0, 30),
      ((grass >> 8) & 0xff) - 20 + this.rand.nextInt(0, 30),
      (grass & 0xff) - 20 + this.rand.nextInt(0, 30)
    );
    const dwtree = this.RGBtoColor(
      ((dwgrass >> 16) & 0xff) - 20 + this.rand.nextInt(0, 30),
      ((dwgrass >> 8) & 0xff) - 20 + this.rand.nextInt(0, 30),
      (dwgrass & 0xff) - 20 + this.rand.nextInt(0, 30)
    );

    [
      0x67fb4,
      0x67f94,
      0x67fc6,
      0x67fe6,
      0x5fea9,
      0xde886,
      0xde6d2,
      0xde6fc,
      0xde70a,
      0xde6fe,
      0xde93a,
      0xde92c,
      0xde91e,
      0xdea1c,
      0xdea2a,
      0xdea30
    ].forEach(address => {
      this.setColor(address, grass, 0);
    });

    [0xde892, 0xde70c, 0xde91c, 0xde92a].forEach(address => {
      this.setColor(address, grass, 1);
    });

    [0xde708, 0xdd4ac].forEach(address => {
      this.setColor(address, grass, 2);
    });

    [
      0xde6fa,
      0x067fe1,
      0x0de6d0,
      0xde884,
      0xde8ae,
      0xde8be,
      0xde8e4,
      0xde938,
      0xde9c4
    ].forEach(address => {
      this.setColor(address, grass, 3);
    });

    [0xde6d0].forEach(address => {
      this.setColor(address, grass, 4);
    });

    [
      0xde6de,
      0xdd3d2,
      0xde88c,
      0xde8a8,
      0xde9f8,
      0xdea4e,
      0xdeaf6,
      0xdeb2e,
      0xdeb4a
    ].forEach(address => {
      this.setColor(address, grass2, 2);
    });

    [0xde6e0, 0xdd4ae, 0xde9fa, 0xdea0e].forEach(address => {
      this.setColor(address, grass2, 1);
    });

    [0xde6e2, 0xde9fe].forEach(address => {
      this.setColor(address, grass2, 0);
    });

    [0xde75c, 0xde786, 0xde794, 0xde99a].forEach(address => {
      this.setColor(address, grass3, 2);
    });

    [0xde75e, 0xde788, 0xde796, 0xde99c].forEach(address => {
      this.setColor(address, grass3, 1);
    });

    this.setColor(0xde93c, dirt, 1);

    [
      0xde672,
      0xde6d4,
      0xde6dc,
      0xde6e2,
      0xde6ea,
      0xde6ee,
      0xde6f0,
      0xde920,
      0xde936
    ].forEach(address => {
      this.setColor(address, dirt, 2);
    });

    [0xde66e, 0xde6ce, 0xde916, 0xde934, 0xde9f2].forEach(address => {
      this.setColor(address, dirt, 3);
    });

    [0xde6cc, 0xde6da, 0xde6e8, 0xde6ec, 0xde932].forEach(address => {
      this.setColor(address, dirt, 4);
    });

    [0xde6ca, 0xde6d8, 0xde6e6, 0xdea2e].forEach(address => {
      this.setColor(address, dirt, 5);
    });

    [0xde756, 0xde764, 0xde772, 0xde994, 0xde9a2].forEach(address => {
      this.setColor(address, dirt2, 4);
    });

    [0xde758, 0xde766, 0xde774, 0xde996, 0xde9a4].forEach(address => {
      this.setColor(address, dirt2, 3);
    });

    [0xde75a, 0xde768, 0xde776, 0xde778, 0xde998, 0xde9a6].forEach(address => {
      this.setColor(address, dirt2, 2);
    });

    [
      0xde9ac,
      0xde99e,
      0xde760,
      0xde77a,
      0xde77c,
      0xde798,
      0xde664,
      0xde980
    ].forEach(address => {
      this.setColor(address, dirt2, 1);
    });

    this.setColor(0xde890, treeleaf, 1);

    this.setColor(0xde894, treeleaf, 0);

    this.setColor(0xdea10, water, 4);

    [0xdea16, 0xde924, 0xde668].forEach(address => {
      this.setColor(address, water, 3);
    });

    this.setColor(0xde66a, water, 2);

    [0xdea1a, 0xde92e, 0xde918, 0xde670].forEach(address => {
      this.setColor(address, water, 1);
    });

    [0xde91a, 0xde66c].forEach(address => {
      this.setColor(address, water, 2);
    });

    [0xde76a, 0xde9a8, 0xde98c].forEach(address => {
      this.setColor(address, clouds, 2);
    });

    [0xde76e, 0xde9aa, 0xde8da, 0xde8d8, 0xde8d0, 0xde990].forEach(address => {
      this.setColor(address, clouds, 0);
    });

    [0xde716, 0xde740, 0xde74e, 0xdeac0, 0xdeace, 0xdeadc, 0xdeb24].forEach(
      address => {
        this.setColor(address, dwgrass, 3);
      }
    );

    this.setColor(0xde752, dwgrass, 2);

    [
      0xde718,
      0xde742,
      0xde750,
      0xdeb26,
      0xdeac2,
      0xdead0,
      0xdeade,
      0x5feb3
    ].forEach(address => {
      this.setColor(address, dwgrass, 1);
    });

    this.setColor(0xdeb34, dwtree, 4);

    this.setColor(0xdeb30, dwtree, 3);

    this.setColor(0xdeb32, dwtree, 1);

    [0xde710, 0xde71e, 0xde72c, 0xdead6].forEach(address => {
      this.setColor(address, dwdirt, 5);
    });

    [0xde712, 0xde720, 0xde72e, 0xde660, 0xdead8].forEach(address => {
      this.setColor(address, dwdirt, 4);
    });

    [0xdeada, 0xde714, 0xde722, 0xde730, 0xde732].forEach(address => {
      this.setColor(address, dwdirt, 3);
    });

    [0xde734, 0xde736, 0xde728, 0xde71a, 0xde664, 0xdeae0].forEach(address => {
      this.setColor(address, dwdirt, 2);
    });

    this.setColor(0xde65a, dwwater, 5);

    [0xdeac8, 0xdeaae, 0xdeaac, 0xde65c].forEach(address => {
      this.setColor(address, dwwater, 3);
    });

    [0xdead2, 0xdeabc, 0xdeab6, 0xdea9e, 0xdea98, 0xde662].forEach(address => {
      this.setColor(address, dwwater, 2);
    });

    [0xdeabe, 0xde65e].forEach(address => {
      this.setColor(address, dwwater, 1);
    });

    [
      0xde7bc,
      0xde7a2,
      0xde7be,
      0xde7cc,
      0xde7da,
      0xdeb6a,
      0xde948,
      0xde956,
      0xde964
    ].forEach(address => {
      this.setColor(address, dwdmgrass, 3);
    });

    [
      0xdea1a,
      0xdea16,
      0x67fe1,
      0x67f94,
      0x67fb4,
      0x67fc6,
      0x67fe6,
      0xdd4a0,
      0xde8e6,
      0xdea1c,
      0xde7ce,
      0xde7a4,
      0xdeba2,
      0xdebb0
    ].forEach(address => {
      this.setColor(address, dwdmgrass, 1);
    });

    [
      0xde79a,
      0xde7a8,
      0xde7b6,
      0xdeb60,
      0xdeb6e,
      0xde93e,
      0xde94c,
      0xdeba6
    ].forEach(address => {
      this.setColor(address, dwdmdirt, 6);
    });

    [
      0xde79c,
      0xde7aa,
      0xde7b8,
      0xde7be,
      0xde7cc,
      0xde7da,
      0xdeb70,
      0xdeba8
    ].forEach(address => {
      this.setColor(address, dwdmdirt, 4);
    });

    [
      0xdeb72,
      0xdeb74,
      0xde79e,
      0xde7ac,
      0xdeb6a,
      0xde948,
      0xde956,
      0xde964,
      0xdebaa,
      0xde7a0
    ].forEach(address => {
      this.setColor(address, dwdmdirt, 3);
    });

    [0xdebac, 0xde7ae, 0xde7c2, 0xde7a6, 0xdeb7a, 0xdeb6c, 0xde7c0].forEach(
      address => {
        this.setColor(address, dwdmdirt, 2);
      }
    );

    [0xde644, 0xdeb84].forEach(address => {
      this.setColor(address, dwdmclouds1, 2);
    });

    [0xde648, 0xdeb88].forEach(address => {
      this.setColor(address, dwdmclouds1, 1);
    });

    [0xdebae, 0xde7b0].forEach(address => {
      this.setColor(address, dwdmclouds2, 2);
    });

    [0xde7b4, 0xdeb78, 0xdebb2].forEach(address => {
      this.setColor(address, dwdmclouds2, 0);
    });
  }
}
