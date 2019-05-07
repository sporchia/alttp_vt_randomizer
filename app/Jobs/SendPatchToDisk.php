<?php namespace ALttP\Jobs;

use ALttP\Seed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

class SendPatchToDisk implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $seed;
	protected $clear_record;

	public function __construct(Seed $seed, bool $clear_record = true) {
		$this->seed = $seed;
		$this->clear_record = $clear_record;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		if (!$this->seed->patch) {
			logger()->error('Trying to send an empty patch: ' . $this->seed->id);
			return;
		}

		$spoiler = json_decode($this->seed->spoiler, true);

		if ($spoiler['meta']['tournament'] ?? false) {
			if ($spoiler['meta']['_meta']['spoilers'] ?? false) {
				$return_spoiler = array_except($spoiler, ['playthrough']);
			} else {
				$return_spoiler = array_except(array_only($spoiler, ['meta']), ['meta.seed']);
			}
		} else {
			$return_spoiler = $spoiler;
		}
		logger()->info("Sending file seed: {$this->seed->id}");

		$save_data = json_encode([
			'logic' => $this->seed->logic,
			'difficulty' => $this->seed->rules,
			'patch' => json_decode($this->seed->patch),
			'spoiler' => array_except($return_spoiler, ['meta._meta']),
			'hash' => $this->seed->hash,
			'size' => $spoiler['meta']['_meta']['size'] ?? 2,
			'generated' => $this->seed->created_at ? $this->seed->created_at->toIso8601String() : now()->toIso8601String(),
		]);

		Storage::put("{$this->seed->hash}.json", gzencode($save_data), ['ContentEncoding' => 'gzip', 'ContentType' => 'application/json']);
		cache(['hash.' . $this->seed->hash => $save_data], now()->addDays(7));

		if ($this->clear_record) {
			$this->seed->clearPatch();
		}
	}
}
