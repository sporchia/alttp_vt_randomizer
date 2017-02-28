<?php namespace ALttP;

use Illuminate\Database\Eloquent\Model;

class Build extends Model {
	protected $fillable = [
		'build',
		'hash',
	];
}
