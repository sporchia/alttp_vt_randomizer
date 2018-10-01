<?php namespace ALttP\Console\Commands;

use ALttP\Jobs\SendPatchToDisk;
use ALttP\Patch;
use Illuminate\Console\Command;

class PushOldPatchesToDisk extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:patchtodisk';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Queue patches in DB to be sent off to boarding school';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		Patch::orderBy('id', 'desc')->chunk(100, function($patches) {
			foreach ($patches as $patch) {
				$seed = $patch->seeds()->first();
				if (!$seed) {
					$patch->delete();
					continue;
				}
				SendPatchToDisk::dispatch($seed);
			}
			sleep(10);
		});
	}
}
