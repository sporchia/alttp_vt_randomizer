<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

/**
 * Seed is a old term back when we had seeded randomization, and the name just
 * stuck.
 */
class Seed extends Model
{
    public static function boot()
    {
        parent::boot();

        $hasher = new Hashids('vt', 10);

        static::created(function ($seed) use ($hasher) {
            $seed->hash = $hasher->encode($seed->id);
            $seed->save();
        });
    }

    /**
     * Hash the Array!
     */
    public function hashArray(): array
    {
        return hash_array($this->id);
    }
}
