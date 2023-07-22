<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

/**
 * Controller to handle requests for active twitch streams.
 */
class StreamsController extends Controller
{
    /**
     * Get cached streams.
     *
     * @return array
     */
    public function streams(): array
    {
        return [
            'streams' => Cache::get('streams', []),
            'dev_streams' => Cache::get('dev_streams', []),
        ];
    }
}
