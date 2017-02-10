<?php namespace ALttP;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class Seed extends Model {
	public static function boot() {
		parent::boot();

		$hasher = new Hashids('vt', 10);

		static::created(function($seed) use ($hasher) {
			$seed->hash = $hasher->encode($seed->id);
			$seed->save();
		});
	}
}
