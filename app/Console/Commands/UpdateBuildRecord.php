<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Rom;

class UpdateBuildRecord extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:updatebuildrecord';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'update the rom build in DB';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$patch_left = $patch_right = [];

		if (is_readable(public_path('js/base2current.json'))) {
			$patch_left = json_decode(file_get_contents(public_path('js/base2current.json')), true);
		}
		if (is_readable(public_path('js/romreset.json'))) {
			$patch_right = json_decode(file_get_contents(public_path('js/romreset.json')), true);
		}

		Rom::saveBuild(patch_merge_minify($patch_left, $patch_right));

		$this->info(sprintf('record updated'));
	}
}
