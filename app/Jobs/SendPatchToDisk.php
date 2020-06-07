<?php

namespace ALttP\Jobs;

use ALttP\Seed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Storage;

class SendPatchToDisk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $seed;
    protected $clear_record;

    public function __construct(Seed $seed, bool $clear_record = true)
    {
        $this->seed = $seed;
        $this->clear_record = $clear_record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->seed->patch) {
            Log::error('Trying to send an empty patch: ' . $this->seed->id);

            return;
        }

        $spoiler = Arr::except(json_decode($this->seed->spoiler, true), [
            'meta.crystals_ganon',
            'meta.crystals_tower',
        ]);

        if ($spoiler['meta']['tournament'] ?? false) {
            switch ($spoiler['meta']['spoilers']) {
                case "on":
                    $return_spoiler = Arr::except($spoiler, ['playthrough']);
                    break;
                case "mystery":
                    $return_spoiler = Arr::only($spoiler, ['meta']);
                    $return_spoiler['meta'] = Arr::only($spoiler['meta'], [
                        'logic',
                        'build',
                        'tournament',
                        'spoilers',
                        'size',
                        'special',
                        'allow_quickswap'
                    ]);
                    break;
                case "generate":
                case "off":
                default:
                    $return_spoiler = Arr::except(Arr::only($spoiler, ['meta']), ['meta.seed']);
                    break;
            }
        } else {
            $return_spoiler = $spoiler;
        }
        Log::info("Sending file seed: {$this->seed->id}");

        $json = json_encode([
            'logic' => $this->seed->logic,
            'patch' => json_decode($this->seed->patch),
            'spoiler' => $return_spoiler,
            'hash' => $this->seed->hash,
            'size' => $spoiler['meta']['size'] ?? 2,
            'generated' => $this->seed->created_at ? $this->seed->created_at->toIso8601String() : now()->toIso8601String(),
        ]);

        if ($json !== false) {
            $zipped = gzencode($json);

            if ($zipped !== false) {
                Storage::put("{$this->seed->hash}.json", $zipped, [
                    'ContentEncoding' => 'gzip',
                    'ContentType' => 'application/json',
                ]);
            }
        }

        if ($this->clear_record) {
            $this->seed->patch = null;
            $this->seed->save();
        }
    }
}
