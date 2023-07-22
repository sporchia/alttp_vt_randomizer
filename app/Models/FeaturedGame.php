<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represent a Featured Game (daily) in the databse.
 *
 * @property int  $id  primary key
 * @property Carbon  $day  which date the feature is for
 * @property int  $seed_id  which game is featured
 * @property string  $description  text description of the featured game
 * @property Carbon  $created_at  when the record was created
 * @property Carbon  $updated_at  last updated time
 */
class FeaturedGame extends Model
{
    protected $casts = [
        'day' => 'datetime',
    ];
    protected $fillable = [
        'day',
    ];

    /**
     * The current featured game for today.
     * @todo do we need this?
     */
    public static function today(): self
    {
        return static::where('day', Carbon::today()->toDateString())->first();
    }

    /**
     * The featured game record.
     */
    public function seed(): BelongsTo
    {
        return $this->belongsTo(Seed::class, 'seed_id');
    }
}
