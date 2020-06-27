<?php

namespace ALttP;

use Illuminate\Database\Eloquent\Model;

/**
 * Represent a Build in the databse.
 *
 * @property string  $build  date of build
 * @property string  $hash  unique hash of the build
 * @property string  $patch  json representation of patch
 * @property string  $bps  binary bps representation of patch
 */
class Build extends Model
{
    /** @var array */
    protected $fillable = [
        'build',
        'hash',
    ];
    /** @var array */
    protected $attributes = [
        'patch' => '[]',
    ];
}
