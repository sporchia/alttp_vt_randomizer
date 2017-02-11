<?php namespace ALttP;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class Build extends Model {
	protected $fillable = [
		'build',
		'hash',
	];
}
