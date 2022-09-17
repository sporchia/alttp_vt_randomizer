<?php

declare(strict_types=1);

namespace App\Graph;

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
        $edges_data = ymlReadDir(app_path('Graph/data/Edges/base'));

        switch ($world->config('mode.state')) {
            case 'standard':
                $edges_data = array_merge_recursive(
                    $edges_data,
                    ymlReadDir(app_path('Graph/data/Edges/normal')),
                    ymlReadDir(app_path('Graph/data/Edges/standard'))
                );
                $edges_data['fixed']['directed'][] = ["start", "Rain - Link's House"];
                $edges_data['RescueZelda']['directed'][] = ["start", "Sanctuary Hall"];
                // $edges_data['OldManFound']['directed'][] = ["start", "Old Man Cave"];

                break;
            case 'inverted':
                $edges_data = array_merge_recursive(
                    $edges_data,
                    ymlReadDir(app_path('Graph/data/Edges/inverted'))
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
                    ymlReadDir(app_path('Graph/data/Edges/normal')),
                    ymlReadDir(app_path('Graph/data/Edges/open'))
                );
                $edges_data['fixed']['directed'][] = ["start", "Link's House - Bedroom"];
                $edges_data['fixed']['directed'][] = ["start", "Sanctuary Hall"];
                // $edges_data['OldManFound']['directed'][] = ["start", "Old Man Cave"];
        }

        foreach ($world->config('tech', []) as $tech) {
            $edges_data = array_merge_recursive(
                $edges_data,
                ymlReadFile(app_path("Graph/data/Edges/tech/$tech.yml"))
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
}
