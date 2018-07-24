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
				return "THIS LENS OF\nTRUTH IS MADE\nIN ZEBES!";
			case Item::get('Varia'):
				return "Alien armor?";
			case Item::get('SpringBall'):
				return "Bouncy bouncy\nbouncy bouncy\nbounce.";
			case Item::get('Morph'):
				return "Why can't\nMetroid crawl?";
			case Item::get('ScrewAttack'):
				return "U spin me right\nround baby\nright round";
			case Item::get('Gravity'):
				return "No more water\nphysics.";
			case Item::get('HiJump'):
				return "this would be\ngreat if I\ncould jump.";
			case Item::get('SpaceJump'):
				return "I believe\nI can fly.";
			case Item::get('Bombs'):
				return "bombs from\nthe future.";
			case Item::get('SpeedBooster'):
				return "THE GREEN\nBOOMERANG IS\nTHE FASTEST!";
			case Item::get('Charge'):
				return "IM'A CHARGIN\nMA LAZER!";
			case Item::get('Ice'):
				return "some kind of\nice rod for\naliens?";
			case Item::get('Wave'):
				return "Trigonometry gun.";
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
				return "Big bada boom!";
			default:
				return "ERROR\nSM ITEM\nNO DESCRIPTION";
		}
	}
}
