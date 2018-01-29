<?php namespace ALttP;

use ALttP\Rom;

/**
 * Shop related features.
 * this is very much a work in progress
 */
class Shop {
	// Shop Items
	// 0x07 is red goo 150 rupees
	// 0x08 Blue Shield 50 rupees
	// 0x09 Red Shield 500 rupees
	// 0x0A small heart 10 rupees
	// 0x0B 10x arrows 30 rupees
	// 0x0C bombs 50 rupees
	// 0x0D Gold Bee 10 rupees

	// GFX of numbers when changing cost
	// 0x2D: '+'
	// 0x30: '0'
	// 0x31: '1'
	// 0x02: '2'
	// 0x03: '3'
	// 0x12: '4'
	// 0x13: '5'
	// 0x22: '6'
	// 0x23: '7'
	// 0x32: '8'
	// 0x33: '9'

	public function writeShopItemsToRom(Rom $rom) {
		$rom->write(0x30C34, pack('C*', 0x07)); // Dark World Kakariko Left
		$rom->write(0x30C3C, pack('C*', 0x08)); // Dark World Kakariko Center
		$rom->write(0x30C44, pack('C*', 0x0C)); // Dark World Kakariko Right

		$rom->write(0x30C4D, pack('C*', 0x09)); // Dark World East of Kakariko Left
		$rom->write(0x30C55, pack('C*', 0x0D)); // Dark World East of Kakariko Center
		$rom->write(0x30C5D, pack('C*', 0x0B)); // Dark World East of Kakariko Right

		$rom->write(0x30C8C, pack('C*', 0x07)); // North Hylia/Kakariko/Death Mountain Shop Left
		$rom->write(0x30C84, pack('C*', 0x0A)); // North Hylia/Kakariko/Death Mountain Shop Center
		$rom->write(0x30C9C, pack('C*', 0x0C)); // North Hylia/Kakariko/Death Mountain Shop Right
	}
}
