<?php namespace ALttP;

use ALttP\World;

abstract class Filler {
	protected $world;

	/**
	 * Returns a Filler of a specified type.
	 *
	 * @param string|null $type type of Filler requested
	 *
	 * @return self
	 */
	public static function factory($type = null, World $world = null) : self {
		if (!$world) {
			$world = new World;
		}

		switch ($type) {
			case 'Distributed':
				return new Filler\Distributed($world);
			case 'Beatable':
				return new Filler\RandomBeatable($world);
			case 'Random':
			default:
				return new Filler\Random($world);
		}
	}

	public function __construct(World $world) {
		$this->world = $world;
	}

	abstract public function fill(array $required, array $nice, array $extra);
}
