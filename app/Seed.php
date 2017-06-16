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

	public function setPatchAttribute($value) {
		$sha1 = sha1($value);
		$patch = Patch::firstOrCreate([
			'sha1' => $sha1
		]);
		$patch->patch = $value;
		$patch->save();

		$this->attributes['patch'] = "[]";

		$this->patch()->associate($patch);
	}

	public function getPatchAttribute() {
		return $this->patch()->first()->patch;
	}

	public function patch() {
		return $this->belongsTo(Patch::class, 'patch_id');
	}
}
