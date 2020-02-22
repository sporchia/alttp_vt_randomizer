<?php

namespace ALttP\Http\Controllers;

use ALttP\EntranceRandomizer;
use Illuminate\Http\Request;
use ALttP\Jobs\SendPatchToDisk;
use ALttP\Randomizer;
use ALttP\Rom;
use ALttP\Support\WorldCollection;
use ALttP\World;
use Exception;

class MultiworldController extends Controller
{
    public function generateSeed(Request $request)
    {
        if ($request->has('lang')) {
            app()->setLocale($request->input('lang'));
        }

        try {
            $payload = $this->prepSeed($request);
            //$payload['seed']->save();
            //SendPatchToDisk::dispatch($payload['seed']);

            return response($payload, 200)
                ->header('Content-Type', 'application/octet-stream');
        } catch (Exception $exception) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($exception);
            }

            return response($exception->getMessage(), 409);
        }
    }

    protected function prepSeed(Request $request)
    {
        $worlds = [];

        set_time_limit(300);

        foreach ($request->input('worlds') as $config) {
            $crystals_ganon = $config['crystals.ganon'] ?? '7';
            $crystals_ganon = $crystals_ganon === 'random' ? get_random_int(0, 7) : $crystals_ganon;
            $crystals_tower = $config['crystals.tower'] ?? '7';
            $crystals_tower = $crystals_tower === 'random' ? get_random_int(0, 7) : $crystals_tower;
            $logic = [
                'none' => 'NoGlitches',
                'overworld_glitches' => 'OverworldGlitches',
                'major_glitches' => 'MajorGlitches',
                'no_logic' => 'None',
            ][$config['glitches'] ?? 'none'];

            // quick fix for CC and Basic
            if (($config['item.pool'] ?? 'normal') === 'crowd_control') {
                $request->merge(['item_placement' => 'advanced']);
            }

            $worlds[] = World::factory($config['mode'] ?? 'standard', [
                'itemPlacement' => $config['item_placement'] ?? 'basic',
                'dungeonItems' => $config['dungeon_items'] ?? 'standard',
                'accessibility' => $config['accessibility'] ?? 'items',
                'goal' => $config['goal'] ?? 'ganon',
                'crystals.ganon' => $crystals_ganon,
                'crystals.tower' => $crystals_tower,
                'entrances' => $config['entrances'] ?? 'none',
                'mode.weapons' => $config['weapons'] ?? 'randomized',
                'tournament' => $config['tournament'] ?? false,
                'spoilers' => $config['spoilers'] ?? false,
                'spoilers_ongen' => $config['spoilers_ongen'] ?? false,
                'spoil.Hints' => $config['hints'] ?? 'on',
                'logic' => $logic,
                'item.pool' => $config['item.pool'] ?? 'normal',
                'item.functionality' => $config['item.functionality'] ?? 'normal',
                'enemizer.bossShuffle' => 'none',
                'enemizer.enemyShuffle' => 'none',
                'enemizer.enemyDamage' => 'default',
                'enemizer.enemyHealth' => 'default',
                'multiworld' => true,
            ]);
        }


        //if ($world->config('entrances') !== 'none') {
        //    $rand = new EntranceRandomizer([$world]);
        //} else {
        $rand = new Randomizer($worlds);
        //}

        $rand->randomize();

        // E.R. is responsible for verifying winnability of itself
        //if ($world->config('entrances') === 'none') {
        $worlds = new WorldCollection($rand->getWorlds());

        if (!$worlds->isWinnable()) {
            throw new Exception('Game Unwinnable');
        }
        //}

        $spoiler = $worlds->getSpoiler([
            'worlds' => $worlds->count(),
        ]);

        foreach ($spoiler as $worldId => $worldSpoiler) {
            $rom = new Rom(config('alttp.base_rom'));
            $rom->applyPatchFile(Rom::getJsonPatchLocation());

            $worlds->get($worldId)->writeToRom($rom, false);

            $writeLog = patch_merge_minify($rom->getWriteLog());
            $spoiler[$worldId]['writeData'] = $writeLog;
        }

        // the .mw file
        return gzdeflate(json_encode($spoiler));
    }
}
