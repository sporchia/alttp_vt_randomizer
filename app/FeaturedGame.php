<?php namespace ALttP;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FeaturedGame extends Model {
	protected $dates = [
		'day',
	];
	protected $fillable = [
		'day',
	];

	public static function today() {
		return static::where('day', Carbon::today()->toDateString())->first();
	}

	public function seed() {
		return $this->belongsTo(Seed::class, 'seed_id');
	}
}
