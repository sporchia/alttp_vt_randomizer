<?php

namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Rom;
use ALttP\Text;

class MakeTranslation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alttp:i18n'
        . ' {output_file : where to write translated ROM}'
        . ' {--i|input_file= : ROM to translate}';

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
    public function handle()
    {
        if (
            $this->hasOption('input_file')
            && trim($this->option('input_file')) !== ''
            && (!is_string($this->option('input_file')) || !is_readable($this->option('input_file')))
        ) {
            $this->error('Source File not readable: ' . $this->option('input_file'));

            return 1;
        }

        if (
            !is_string($this->argument('output_file'))
            || (file_exists($this->argument('output_file')) && !is_writable($this->argument('output_file')))
            || (!file_exists($this->argument('output_file')) && !is_writable(dirname($this->argument('output_file'))))
        ) {
            $this->error('Target file not writable');

            return 2;
        }

        $i18n = new Text;
        $i18n->removeUnwanted();

        if (
            $this->hasOption('input_file')
            && trim($this->option('input_file')) !== ''
            && is_string($this->option('input_file'))
        ) {
            $rom = new Rom($this->option('input_file'));
            $rom->write(0xE0000, pack('C*', ...$i18n->getByteArray(true)));
        } else {
            $rom = new Rom;
            $rom->write(0x0, pack('C*', ...$i18n->getByteArray(true)));
        }

        $rom->save($this->argument('output_file'));
        $this->info("File written");
    }
}
