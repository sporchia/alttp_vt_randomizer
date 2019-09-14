<?php

namespace ALttP\Jobs;

use ALttP\Seed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

        $spoiler = array_except(json_decode($this->seed->spoiler, true), [
            'meta.crystals_ganon',
            'meta.crystals_tower',
        ]);

        if ($spoiler['meta']['tournament'] ?? false) {
            if ($spoiler['meta']['spoilers'] ?? false) {
                $return_spoiler = array_except($spoiler, ['playthrough']);
            } else {
                $return_spoiler = array_except(array_only($spoiler, ['meta']), ['meta.seed']);
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
