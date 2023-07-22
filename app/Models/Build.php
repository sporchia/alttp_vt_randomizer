<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Represent a ROM Build in the databse.
 *
 * @property int  $id  primary key
 * @property string  $build  date of build
 * @property string  $hash  unique hash of the build
 * @property string  $patch  json representation of patch
 * @property string  $bps  binary bps representation of patch
 * @property Carbon  $created_at  when the record was created
 * @property Carbon  $updated_at  last updated time
 */
class Build extends Model
{
    protected $fillable = [
        'build',
        'hash',
    ];
    protected $attributes = [
        'patch' => '[]',
    ];
}
