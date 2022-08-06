<?php

declare(strict_types=1);

namespace App\Graph;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Pull data files to create all edges for a given world configuration.
 */
class EdgeCollector
{
    /**
     * Given a particular world (configuration), read all the edge data files
     * and create edges based on the world to connect the vertices.
     *
     * @param World $world world to attach preset items to
     */
    public function getForWorld(World $world): array
    {
        $edges_data = $this->readDir(app_path('Graph/data/Edges/base'));

        switch ($world->config('mode.state')) {
            case 'standard':
                $edges_data = array_merge_recursive(
                    $edges_data,
                    $this->readDir(app_path('Graph/data/Edges/normal')),
                    $this->readDir(app_path('Graph/data/Edges/standard'))
                );
                $edges_data['fixed']['directed'][] = ["start", "Rain - Link's House"];
                $edges_data['RescueZelda']['directed'][] = ["start", "Sanctuary Hall"];
                // $edges_data['OldManFound']['directed'][] = ["start", "Old Man Cave"];

                break;
            case 'inverted':
                $edges_data = array_merge_recursive(
                    $edges_data,
                    $this->readDir(app_path('Graph/data/Edges/inverted'))
                );
                // @todo move these once we have the nodes made
                $edges_data['fixed']['directed'][] = ["start", "Link's House - Bedroom"];
                $edges_data['fixed']['directed'][] = ["start", "Dark Sanctuary"];
                // $edges_data['OldManFound']['directed'][] = ["start", "Old Man Cave"];

                break;
            case 'open':
            default:
                $edges_data = array_merge_recursive(
                    $edges_data,
                    $this->readDir(app_path('Graph/data/Edges/normal')),
                    $this->readDir(app_path('Graph/data/Edges/open'))
                );
                $edges_data['fixed']['directed'][] = ["start", "Link's House - Bedroom"];
                $edges_data['fixed']['directed'][] = ["start", "Sanctuary Hall"];
                // $edges_data['OldManFound']['directed'][] = ["start", "Old Man Cave"];
        }

        foreach ($world->config('tech', []) as $tech) {
            $edges_data = array_merge_recursive(
                $edges_data,
                $this->readFile(app_path("Graph/data/Edges/tech/$tech.yml"))
            );
        }

        // localize to world
        $return_data = [];
        $world_id = $world->id;
        foreach ($edges_data as $group => $edges) {
            $name = "$group:$world_id";
            if (strpos($group, '|') !== false) {
                [$name, $count] = explode('|', $group);
                $name = "$name:$world_id|$count";
            }

            $return_data[$name] = array_map(fn ($es) => array_map(fn ($v) => [
                "{$v[0]}:$world_id",
                "{$v[1]}:$world_id",
            ], $es), $edges);
        }

        return $return_data;
    }

    /**
     * Read and parse all Edge Yaml files in a directory recursively.
     * 
     * @param string $dir the directory to search
     */
    private function readDir(string $dir): array
    {
        $edges_data = [];
        $finder = new Finder();
        foreach ($finder->in($dir)->files()->name('*.yml')->size('!= 0') as $file) {
            $edges_data = array_merge_recursive($edges_data, $this->readFile($file->getPathName()));
        }

        return $edges_data;
    }

    /**
     * Read Yaml file and parse all edges within it.
     * 
     * @param string $file file to parse
     */
    private function readFile(string $file): array
    {
        $data = file_get_contents($file);

        return ($data !== false) ? Yaml::parse($data) ?? [] : [];
    }
}
