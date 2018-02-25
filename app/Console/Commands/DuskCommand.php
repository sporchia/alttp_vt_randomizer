<?php namespace ALttP\Console\Commands;

use Laravel\Dusk\Console\DuskCommand as BaseCommand;
use Symfony\Component\Process\ProcessBuilder;

class DuskCommand extends BaseCommand {
	public function handle() {
		return $this->withDuskEnvironment(function () {
			$url = parse_url(env('APP_URL'));

			chdir(public_path());

			$webserver = (new ProcessBuilder())
				->setTimeout(null)
				->add('exec')
				->add(PHP_BINARY)
				->add('-S')
				->add(sprintf('%s:%s', $url['host'], $url['port']))
				->add(base_path().'/server.php')
				->getProcess();

			$webserver->start();

			chdir(base_path());

			return tap(parent::handle(), function () use ($webserver) {
				$webserver->stop(0, 15);
			});
		});
	}
}
