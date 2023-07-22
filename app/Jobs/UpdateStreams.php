<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use romanzipp\Twitch\Twitch;

class UpdateStreams implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const DEVS = [
        'veetorp',
        'ChristosOwen',
        'Karkat',
        'Zarby',
        'Myramong',
        'the_synack',
    ];

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $twitch = new Twitch();

        $request = $twitch->getGames(['name' => 'The Legend of Zelda: A Link to the Past']);
        if (!$request->success()) {
            Log::error('Could not retrieve game');
            throw new Exception('Failure connecting to Twitch API: could not get game');
        }
        $game = $request->shift();

        $streams = $twitch->getStreams(['game_id' => $game->id, 'first' => 100]);
        if (!$streams->success()) {
            Log::error('Could not retrieve game');
            throw new Exception('Failure connecting to Twitch API: could not get streams');
        }

        Cache::put('streams', $this->prepStreams($this->filterStreams(collect($streams->data()))), now()->addMinutes(10));

        $dev_streams = $twitch->getStreams(['user_login' => self::DEVS]);
        if (!$dev_streams->success()) {
            Log::error('Could not retrieve dev streams');
            throw new Exception('Failure connecting to Twitch API: could not get dev streams');
        }

        Cache::put('dev_streams', $this->prepStreams(collect($dev_streams->data())), now()->addMinutes(10));
    }

    private function filterStreams(Collection $streams): Collection
    {
        return $streams->filter(static function ($stream) {
            return in_array('randomizer', array_map('strtolower', $stream->tags ?? []));
        });
    }

    /**
     * convert the raw stream data to something we can parse on the front end.
     *
     * @param Collection $streams stream data to convert
     *
     * @return Collection
     */
    private function prepStreams(Collection $streams): Collection
    {
        return $streams->map(static function ($stream) {
            return [
                'href'  => "https://www.twitch.tv/{$stream->user_name}",
                'title' => $stream->title,
                'lang' => $stream->language,
                'imgs' => [
                    '64' => str_replace(['{width}', '{height}'], [64, 36], $stream->thumbnail_url),
                    '128' => str_replace(['{width}', '{height}'], [128, 64], $stream->thumbnail_url),
                    '256' => str_replace(['{width}', '{height}'], [256, 128], $stream->thumbnail_url),
                    '512' => str_replace(['{width}', '{height}'], [512, 256], $stream->thumbnail_url),
                ],
                'name' => $stream->user_name,
            ];
        })->values();
    }
}
