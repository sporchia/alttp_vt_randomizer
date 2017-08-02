<?php namespace ALttP;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class Seed extends Model {
	protected $stored_patch;

	public static function boot() {
		parent::boot();

		$hasher = new Hashids('vt', 10);

		static::saved(function($seed) {
			if ($this->stored_patch) {
				$sha1 = sha1($this->stored_patch);
				$patch = Patch::firstOrCreate([
					'sha1' => $sha1
				]);
				$patch->patch = $this->stored_patch;
				$patch->save();

				$this->patch()->associate($patch);
			}
		});

		static::created(function($seed) use ($hasher) {
			$seed->hash = $hasher->encode($seed->id);
			$seed->save();
		});
	}

	public function setPatchAttribute($value) {
		$this->stored_patch = $value;

		$this->attributes['patch'] = "[]";
	}

	public function getPatchAttribute() {
		return $this->patch()->first()->patch;
	}

	public function patch() {
		return $this->belongsTo(Patch::class, 'patch_id');
	}
}
