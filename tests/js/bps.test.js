import BPS from '../../resources/js/bps';
const { test, expect } = global;

test('applyPatch with no change', () => {
  const bps = new BPS();

  bps.setPatch(Uint8Array.of(
    0x42, 0x50, 0x53, 0x31, 0x88, 0x88, 0x80, 0x9C,
    0x9F, 0x68, 0xAA, 0x88, 0x9F, 0x68, 0xAA, 0x88,
    0xE2, 0x8A, 0xB0, 0x48
  ).buffer);

  bps.setSource(Uint8Array.of(
    0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07
  ).buffer);

  expect(bps.applyPatch()).toEqual(Uint8Array.of(
    0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07
  ).buffer);
});

test('applyPatch to throw error when no source is set', () => {
  const bps = new BPS();

  bps.setPatch(Uint8Array.of(
    0x42, 0x50, 0x53, 0x31, 0x88, 0x88, 0x80, 0x9C,
    0x9F, 0x68, 0xAA, 0x88, 0x9F, 0x68, 0xAA, 0x88,
    0xE2, 0x8A, 0xB0, 0x48
  ).buffer);

  expect(() => {
    bps.applyPatch();
  }).toThrow('Source not set');
});

test('applyPatch source checksum fail', () => {
  const bps = new BPS();

  bps.setPatch(Uint8Array.of(
    0x42, 0x50, 0x53, 0x31, 0x88, 0x88, 0x80, 0x9C,
    0x9F, 0x68, 0xAA, 0x88, 0x9F, 0x68, 0xAA, 0x88,
    0xE2, 0x8A, 0xB0, 0x48
  ).buffer);

  bps.setSource(Uint8Array.of(
    0x00, 0x02, 0x01, 0x03, 0x04, 0x05, 0x06, 0x07
  ).buffer);

  expect(() => {
    bps.applyPatch();
  }).toThrow('Source checksum incorrect');
});

test('applyPatch to throw error when no patch is set', () => {
  const bps = new BPS();

  expect(() => {
    bps.applyPatch();
  }).toThrow('Patch not set');
});

test('decodeBPS with 0', () => {
  const bps = new BPS();

  expect(bps.decodeBPS(Uint8Array.of(0x80), 0)).toEqual({
    number: 0,
    length: 1,
  });
});

test('decodeBPS with large number', () => {
  const bps = new BPS();

  expect(bps.decodeBPS(Uint8Array.of(0x3F, 0x03, 0xBC), 0)).toEqual({
    number: 999999,
    length: 3,
  });
});

test('encodeBPS with large number', () => {
  const bps = new BPS();

  expect(bps.encodeBPS(999999)).toEqual(Uint8Array.of(0x3F, 0x03, 0xBC));
});

test('encodeBPS with 0', () => {
  const bps = new BPS();

  expect(bps.encodeBPS(0)).toEqual(Uint8Array.of(0x80));
});
