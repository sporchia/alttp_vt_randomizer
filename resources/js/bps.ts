import { crc32 } from "@stardazed/crc32";

/**
 * Class to apply and create BPS's.
 *
 * @see https://www.romhacking.net/documents/746/
 */
export default class BPS {
  static readonly ACTION_SOURCE_READ = 0;
  static readonly ACTION_TARGET_READ = 1;
  static readonly ACTION_SOURCE_COPY = 2;
  static readonly ACTION_TARGET_COPY = 3;

  public sourceSize: number;
  public targetSize: number;
  private metaDataString: string;
  public meta: object;
  private actionsOffset: number;
  private patchFile: Uint8Array | null;
  private sourceFile: Uint8Array | null;
  private targetFile: Uint8Array | null;
  private sourceChecksum: number;
  private targetChecksum: number;
  private patchSourceChecksum: number;
  private patchTargetChecksum: number;
  private patchChecksum: number;

  constructor() {
    this.sourceSize = 0;
    this.targetSize = 0;
    this.metaDataString = "";
    this.meta = {};
    this.actionsOffset = 0;
    this.sourceFile = null;
    this.sourceChecksum = 0;
    this.targetFile = null;
    this.targetChecksum = 0;
    this.patchSourceChecksum = 0;
    this.patchTargetChecksum = 0;
    this.patchChecksum = 0;
    this.patchFile = null;
  }

  /**
   * Set the patch file to be used.
   *
   * @param file BPS formatted file.
   */
  setPatch(file: ArrayBuffer) {
    this.patchFile = new Uint8Array(file);

    // Check BPS1 at beginning of patch file
    const checkHeader = new Uint32Array(file.slice(0, 4))[0];
    if (checkHeader !== 827543618) {
      throw new Error("Not a valid patch file");
    }

    let seek = 4; // skip BPS1
    const decodedSourceSize = this.decodeBPS(this.patchFile, seek);
    this.sourceSize = decodedSourceSize.number;
    seek += decodedSourceSize.length;
    const decodedTargetSize = this.decodeBPS(this.patchFile, seek);
    this.targetSize = decodedTargetSize.number;
    seek += decodedTargetSize.length;

    const decodedMetaDataLength = this.decodeBPS(this.patchFile, seek);

    seek += decodedMetaDataLength.length;
    if (decodedMetaDataLength.number) {
      const metaArray = this.patchFile.slice(
        seek,
        seek + decodedMetaDataLength.number
      );
      for (let i = 0; i < metaArray.byteLength; ++i) {
        this.metaDataString += String.fromCharCode(metaArray[i]);
      }
      this.meta = JSON.parse(this.metaDataString);
      seek += decodedMetaDataLength.number;
    }

    this.actionsOffset = seek;

    const buf32 = new Int32Array(file.slice(file.byteLength - 12));

    this.patchSourceChecksum = buf32[0];
    this.patchTargetChecksum = buf32[1];
    this.patchChecksum = buf32[2];

    if (
      this.patchChecksum !==
      crc32(this.patchFile.slice(0, this.patchFile.byteLength - 4))
    ) {
      throw new Error("Patch checksum incorrect");
    }

    return this;
  }

  setSource(file: ArrayBuffer) {
    this.sourceFile = new Uint8Array(file);
    this.sourceChecksum = crc32(file);

    return this;
  }

  setTarget(file: ArrayBuffer) {
    this.targetFile = new Uint8Array(file);
    this.targetChecksum = crc32(file);

    return this;
  }

  /**
   * Apply the currently loaded patch to the currently loaded file and return the patched array buffer.
   */
  applyPatch() {
    if (this.patchFile === null) {
      throw new Error("Patch not set");
    }

    if (this.sourceFile === null) {
      throw new Error("Source not set");
    }

    if (this.patchSourceChecksum !== this.sourceChecksum) {
      throw new Error("Source checksum incorrect");
    }

    let newFileSize = 0;
    let seek = this.actionsOffset;

    // determine target filesize
    while (seek < this.patchFile.byteLength - 12) {
      let data = this.decodeBPS(this.patchFile, seek);
      let action = {
        type: data.number & 3,
        length: (data.number >> 2) + 1
      };

      seek += data.length;

      newFileSize += action.length;

      switch (action.type) {
        case BPS.ACTION_TARGET_READ:
          seek += action.length;
          break;
        case BPS.ACTION_SOURCE_COPY:
        case BPS.ACTION_TARGET_COPY:
          seek += this.decodeBPS(this.patchFile, seek).length;
          break;
      }
    }

    const tempFile = new ArrayBuffer(newFileSize);
    const tempFileView = new Uint8Array(tempFile);

    // patch
    let outputOffset = 0;
    let sourceRelativeOffset = 0;
    let targetRelativeOffset = 0;

    seek = this.actionsOffset;

    while (seek < this.patchFile.byteLength - 12) {
      const data = this.decodeBPS(this.patchFile, seek);
      let data2;
      const action = {
        type: data.number & 3,
        length: (data.number >> 2) + 1
      };

      seek += data.length;

      switch (action.type) {
        case BPS.ACTION_SOURCE_READ:
          for (let i = 0; i < action.length; ++i) {
            tempFileView[outputOffset + i] = this.sourceFile[outputOffset + i];
          }
          outputOffset += action.length;
          break;
        case BPS.ACTION_TARGET_READ:
          for (let i = 0; i < action.length; ++i) {
            tempFileView[outputOffset + i] = this.patchFile[seek + i];
          }
          outputOffset += action.length;
          seek += action.length;
          break;
        case BPS.ACTION_SOURCE_COPY:
          data2 = this.decodeBPS(this.patchFile, seek);
          seek += data2.length;
          sourceRelativeOffset +=
            (data2.number & 1 ? -1 : 1) * (data2.number >> 1);
          while (action.length--) {
            tempFileView[outputOffset] = this.sourceFile[sourceRelativeOffset];
            outputOffset++;
            sourceRelativeOffset++;
          }
          break;
        case BPS.ACTION_TARGET_COPY:
          data2 = this.decodeBPS(this.patchFile, seek);
          seek += data2.length;
          targetRelativeOffset +=
            (data2.number & 1 ? -1 : 1) * (data2.number >> 1);
          while (action.length--) {
            tempFileView[outputOffset] = tempFileView[targetRelativeOffset];
            outputOffset++;
            targetRelativeOffset++;
          }
          break;
      }
    }

    this.setTarget(tempFile);

    if (this.patchTargetChecksum !== this.targetChecksum) {
      throw new Error("Target checksum incorrect");
    }

    return tempFile;
  }

  /**
   * Create a patch from the source and target binaries and return it as an
   * array buffer.
   */
  createPatch() {
    throw new Error("Not Currently Implemented");
  }

  /**
   * Convert BPS number format into number.
   *
   * @todo this is inherrently dangerous with while(true)
   *
   * @param dataBytes
   * @param i
   */
  decodeBPS(dataBytes: Uint8Array, i: number) {
    let number = 0;
    let shift = 1;
    let len = 0;
    while (true) {
      let x = dataBytes[i];
      i++;
      len++;
      number += (x & 0x7f) * shift;
      if (x & 0x80) {
        break;
      }
      shift <<= 7;
      number += shift;
    }
    return {
      number: number,
      length: len
    };
  }

  /**
   * Convert number into BPS number format.
   *
   * @todo this is inherrently dangerous with while(true)
   *
   * @param toEncode
   */
  encodeBPS(toEncode: number) {
    let array = [];

    while (true) {
      let x = toEncode & 0x7f;
      toEncode >>= 7;
      if (toEncode === 0) {
        array.push(0x80 | x);

        break;
      }
      array.push(x);
      toEncode--;
    }

    return Uint8Array.from(array);
  }
}
