<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
	->files()
	->name('*.php')
	->exclude('in')
	->exclude('out')
	->exclude('vendor')
	->exclude('docs')
    ->exclude('tests')
    ->exclude('database')
	->in('.');

return new Sami($iterator, [
    'title'                => 'ALttP PHP Randomizer API',
    'build_dir'            => __DIR__.'/docs',
    'cache_dir'            => __DIR__.'/docs/cache',
    'default_opened_level' => 2,
]);
