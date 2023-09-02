<?php

declare(strict_types=1);

namespace Tests\Unit\Graph;

use App\Graph\Graph;
use App\Graph\Vertices;
use Illuminate\Support\Arr;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Tests\TestCase;

/**
 * Basic Graph testing, this still move to appropo places later.
 *
 * @group graph
 */
final class NewGraphTest extends TestCase
{
    public function testMerge(): void
    {
        $a = new Graph();
        $a1 = $a->newVertex();
        $a2 = $a->newVertex();
        $a3 = $a->newVertex();
        $a->addDirected($a1, $a2, 'test');

        $b = new Graph();
        $b->addVertex($a2);
        $b->addVertex($a3);
        $b->addDirected($a2, $a3, 'test');

        $this->assertNotContains($a3, $a->search($a1));

        $c = $a->merge($b);
        $this->assertContains($a3, $c->search($a1));

        $d = $b->merge($a);
        $this->assertContains($a3, $d->search($a1));
    }

    public function testGetSubgraph(): void
    {
        $a = new Graph();
        $a1 = $a->newVertex();
        $a2 = $a->newVertex();
        $a3 = $a->newVertex();
        $a->addDirected($a1, $a2, 'red');
        $a->addDirected($a2, $a3, 'blue');

        $this->assertEqualsCanonicalizing([$a1, $a2], $a->getSubgraph('red')->getVertices());
        $this->assertEqualsCanonicalizing([$a2, $a3], $a->getSubgraph('blue')->getVertices());
        $this->assertContains($a3, $a->getSubgraph('blue')->search($a2));
    }

    public function testBasicTraversal(): void
    {
        $this->markTestSkipped();
        $graph = new Graph();
        $start = $graph->newVertex([
            'name' => 'start',
            'type' => 'meta',
        ]);

        $max_worlds = 1;

        for ($world_id = 0; $world_id < $max_worlds; $world_id++) {

            $world_start = $graph->newVertex([
                'name' => 'start:' . $world_id,
                'type' => 'meta',
            ]);
            $graph->addDirected($start, $world_start, 'fixed');

            $meta = $graph->newVertex([
                'name' => 'Meta:' . $world_id,
                'type' => 'meta',
            ]);
            $graph->addDirected($world_start, $meta, 'fixed');

            $vertex_files = glob(app_path('Graph/data/Vertices/**/*.php'));

            $vertices = array_map(static function ($v) use ($world_id) {
                if (isset($v['itemset'])) {
                    $v['itemset'] = array_map(fn ($set) => "$set:$world_id", $v['itemset']);
                }
                if (isset($v['key'])) {
                    $v['key'] = $v['key'] . ":$world_id";
                }

                return array_merge($v, [
                    'name' => "{$v['name']}:$world_id",
                ]);
            }, Arr::flatten(array_map(function ($filename) {
                return require($filename);
            }, $vertex_files), 1));

            $vertices = collect($graph->getVertices())->filter(static function ($vertex) use ($world_id) {
                return $vertex->name === 'start' || strpos($vertex->name, ":$world_id") !== false;
            })->keyBy(static function ($vertex) {
                return $vertex->name;
            });

            $edges = $this->getForWorld($world_id);
            foreach ($edges as $group => $data) {
                foreach ($data['directed'] as $edge_data) {
                    $graph->addDirected($vertices[$edge_data[0]], $vertices[$edge_data[1]], $group);
                }
                foreach ($data['undirected'] as $edge_data) {
                    $graph->addDirected($vertices[$edge_data[0]], $vertices[$edge_data[1]], $group);
                    $graph->addDirected($vertices[$edge_data[1]], $vertices[$edge_data[0]], $group);
                }
            }
        }

        //for ($i = 0; $i < 800 * $max_worlds; $i++) {
        $graph2 = $graph->merge($graph);
        //}
        for ($i = 0; $i < 250 * $max_worlds; $i++) {
            $graph2->search($start);
        }
        echo "COUNT: " . count($graph2->search($start)) . "\n";
        $this->doesNotPerformAssertions();
        //        dd(new Inventory($graph2->getItems()));
        //$this->display($graph);
    }

    public function getForWorld(int $world_id = 0): array
    {
        $edges_data = $this->readDir(app_path('Graph/data/Edges/base'));


        $edges_data = array_merge_recursive(
            $edges_data,
            $this->readDir(app_path('Graph/data/Edges/normal')),
            $this->readDir(app_path('Graph/data/Edges/open'))
        );
        $edges_data['fixed']['directed'][] = ["start", "Link's House - Bedroom"];
        $edges_data['fixed']['directed'][] = ["start", "Sanctuary Hall"];
        // $edges_data['OldManFound']['directed'][] = ["start", "Old Man Cave"];


        // localize to world
        $return_data = [];
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

    private function readDir(string $dir): array
    {
        $edges_data = [];
        $finder = new Finder();
        foreach ($finder->in($dir)->files()->name('*.yml')->size('!= 0') as $file) {
            $edges_data = array_merge_recursive($edges_data, $this->readFile($file->getPathName()));
        }

        return $edges_data;
    }

    private function readFile(string $file): array
    {
        $data = file_get_contents($file);

        return ($data !== false) ? Yaml::parse($data) ?? [] : [];
    }
}
