<?php

declare(strict_types=1);

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Read and parse all Yaml files in a directory recursively.
 * 
 * @param string $dir the directory to search
 */
function ymlReadDir(string $dir): array
{
    $edges_data = [];
    $finder = new Finder();
    foreach ($finder->in($dir)->files()->name('*.yml')->size('!= 0') as $file) {
        $edges_data = array_merge_recursive($edges_data, ymlReadFile($file->getPathName()));
    }

    return $edges_data;
}

/**
 * Read Yaml file and return array of data.
 * 
 * @param string $file file to parse
 */
function ymlReadFile(string $file): array
{
    $data = file_get_contents($file);

    return ($data !== false) ? Yaml::parse($data) ?? [] : [];
}
