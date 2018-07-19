<?php namespace ALttP;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class Seed extends Model {
	protected $stored_patch;

	public static function boot() {
		parent::boot();

		$hasher = new Hashids('vt', 10);

		static::saved(function($seed) {
			if ($seed->stored_patch) {
				$sha1 = sha1($seed->stored_patch);
				$patch = Patch::firstOrCreate([
					'sha1' => $sha1,
				]);
				$patch->patch = $seed->stored_patch;
				$patch->save();

				$seed->stored_patch = null;
				$seed->patch()->associate($patch);
				$seed->save();
			}
		});

		static::created(function($seed) use ($hasher) {
			$seed->hash = $hasher->encode($seed->id);
			$seed->save();
		});
	}

	public function hashArray() {
		return hash_array($this->id);
	}

	public function setPatchAttribute($value) {
		$this->stored_patch = $value;
	}

	public function getPatchAttribute() {
		return $this->patch()->first()->patch;
	}

	public function patch() {
		return $this->belongsTo(Patch::class, 'patch_id');
	}
}
