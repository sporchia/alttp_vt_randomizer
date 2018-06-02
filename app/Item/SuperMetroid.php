<?php namespace ALttP\Item;

use ALttP\Item;

/**
 * SuperMetroid type Item
 */
class SuperMetroid extends Item {
	function getTabletText() {
		switch($this) {
			case Item::get('Grapple'):
				return "Some kind of\nfuturistic\nhookshot?";
			case Item::get('XRay'):
				return "this can see\nthrough walls!";
			case Item::get('Varia'):
				return "Alien armor?";
			case Item::get('SpringBall'):
				return "Super bouncy.";
			case Item::get('Morph'):
				return "roly poly!";
			case Item::get('ScrewAttack'):
				return "it's flying,\nspinning death!";
			case Item::get('Gravity'):
				return "I think this\nwalks under\nthe water?";
			case Item::get('HiJump'):
				return "this would be\ngreat if I\ncould jump.";
			case Item::get('SpaceJump'):
				return "I believe\nI can fly.";
			case Item::get('Bombs'):
				return "bombs from\nthe future.";
			case Item::get('SpeedBooster'):
				return "a machine for\ngoing fast.";
			case Item::get('ChargeBeam'):
				return "something for\na space gun?";
			case Item::get('IceBeam'):
				return "some kind of\nice rod for\naliens?";
			case Item::get('WaveBeam'):
				return "it's all wavy.";
			case Item::get('Spazer'):
				return "even space\nlasers can\nbe sucky.";
			case Item::get('Plasma'):
				return "some kind of\nfire rod for\naliens?";
			case Item::get('ETank'):
				return "a heart from\nthe future?";
			case Item::get('ReserveTank'):
				return "a fairy from\nthe future?";
			case Item::get('Missile'):
				return "some kind of\nflying bomb?";
			case Item::get('Super'):
				return "a really big\nflying bomb!";
			case Item::get('PowerBomb'):
				return "big bang!";
			default:
				return "ERROR\nSM ITEM\nNO DESCRIPTION";
		}
	}
}
