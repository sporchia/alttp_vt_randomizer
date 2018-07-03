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

	public function __construct(Seed $seed) {
		$this->seed = $seed;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		$spoiler = json_decode($this->seed->spoiler, true);
		$return_spoiler = ($spoiler['meta']['tournament'] ?? false)
			? array_except(array_only($spoiler, ['meta']), ['meta.seed'])
			: $spoiler;

		Storage::put("{$this->seed->hash}.json", json_encode([
			'logic' => $this->seed->logic,
			'difficulty' => $this->seed->rules,
			'patch' => json_decode($this->seed->patch),
			'spoiler' => $return_spoiler,
			'hash' => $this->seed->hash,
			'generated' => $this->seed->created_at->diffForHumans(),
		]));
	}
}
