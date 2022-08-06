export function pctosnes(address: number) {
  return ((address << 1) & 0x7f0000) | (address & 0x7fff) | 0x8000;
}

export function snestopc(address: number) {
  return ((address & 0x7f0000) >> 1) | (address & 0x7fff);
}

export function lz2decompress(compressed: Uint8Array, start = 0, reverse = false) {
  if (compressed.length === 0) {
    throw new Error("Compressed data is empty");
  }

  const DIRECT_COPY = 0;
  const BYTE_FILL = 1;
  const WORD_FILL = 2;
  const INCREASE_FILL = 3;
  const REPEAT = 4;
  const LONG_COMMAND = 7;

  let output = new Uint8Array(0x800);
  let outputPosition = 0;
  let position = start;

  while (true) {
    const commandLength = compressed[position++];
    if (commandLength == 0xff) {
      break;
    }

    let command = commandLength >> 5;
    let length;
    if (command === LONG_COMMAND) {
      length = compressed[position++];
      length |= (commandLength & 3) << 8;
      length++;
      command = (commandLength >> 2) & 7;
    } else {
      length = (commandLength & 0x1f) + 1;
    }

    switch (command) {
      case DIRECT_COPY:
        for (let i = 0; i < length; i++) {
          output[outputPosition++] = compressed[position++];
        }
        break;
      case BYTE_FILL:
        const fillByte = compressed[position++];
        for (let i = 0; i < length; i++) {
          output[outputPosition++] = fillByte;
        }
        break;
      case WORD_FILL:
        const fillByteEven = compressed[position++];
        const fillByteOdd = compressed[position++];
        for (let i = 0; i < length; i++) {
          const thisByte = (i & 1) === 0 ? fillByteEven : fillByteOdd;
          output[outputPosition++] = thisByte;
        }
        break;
      case INCREASE_FILL:
        let increaseFillByte = compressed[position++];
        for (let i = 0; i < length; i++) {
          output[outputPosition++] = increaseFillByte++;
        }
        break;
      case REPEAT:
        let origin = reverse ? (compressed[position++] << 8) | compressed[position++] : compressed[position++] | (compressed[position++] << 8);

        for (let i = 0; i < length; i++) {
          output[outputPosition++] = output[origin++];
        }
        break;
      default:
        throw new Error(`Invalid Lz2 command: ${command}`);
    }
  }

  return output;
}
