<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Rom;
use ALttP\Randomizer;

class Randomize extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:randomize {input_file} {output_directory} {--spoiler} {--rules=v7} {--seed=}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a randomized rom.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if (!is_readable($this->argument('input_file'))) {
			return $this->error('Source File not readable');
		}

		if (!is_dir($this->argument('output_directory')) || !is_writable($this->argument('output_directory'))) {
			return $this->error('Target Directory not writable');
		}

		$rom = new Rom($this->argument('input_file'));
		$rand = new Randomizer($this->option('rules'));
		$rand->makeSeed($this->option('seed'));

		$rand->writeToRom($rom);

		$output_file = sprintf($this->argument('output_directory') . '/' . $rand->config('output.file.name', 'alttp - p.%s.sfc'), $rand->getSeed());
		$rom->save($output_file);
		if ($this->option('spoiler')) {
			$spoiler_file = sprintf($this->argument('output_directory') . '/' . $rand->config('output.file.spoiler', 'alttp - p.%s.txt'), $rand->getSeed());
			file_put_contents($spoiler_file, json_encode($rand->getSpoiler(), JSON_PRETTY_PRINT));
		}
		$this->info(sprintf('Rom Saved: %s', $output_file));
	}
}
