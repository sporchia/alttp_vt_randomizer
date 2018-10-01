<?php namespace ALttP;

use Illuminate\Database\Eloquent\Model;

class Patch extends Model {
	protected $fillable = [
		'sha1',
		'patch',
	];

	public function seeds() {
		return $this->hasMany(Seed::class);
	}
}
