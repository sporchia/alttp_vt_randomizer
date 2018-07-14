<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Rom;
use ALttP\Text;

class MakeTranslation extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:i18n'
		. ' {output_file : where to write translated rom}'
		. ' {--i|input_file= : rom to translate}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'generate i18n bin file for patching';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if ($this->option('input_file') && !is_readable($this->option('input_file'))) {
			return $this->error('Source File not readable');
		}

		if ((file_exists($this->argument('output_file')) && !is_writable($this->argument('output_file')))
			|| (!file_exists($this->argument('output_file')) && !is_writable(dirname($this->argument('output_file'))))) {
			return $this->error('Target file not writable');
		}

		$i18n = new Text;
		$i18n->removeUnwanted();

		if ($this->option('input_file')) {
			$rom = new Rom($this->option('input_file'));
			$rom->write(0xE0000, pack('C*', ...$i18n->getByteArray()));
		} else {
			$rom = new Rom;
			$rom->write(0x0, pack('C*', ...$i18n->getByteArray()));
		}

		$rom->save($this->argument('output_file'));
		$this->info("File written");
	}
}
