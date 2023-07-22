<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rom;
use Exception;

/**
 * @todo this needs v32 love
 */
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
        $logic = [];
        foreach ($request->input('worlds') as $config) {
            $crystals_ganon = $config['crystals.ganon'] ?? '7';
            $crystals_ganon = $crystals_ganon === 'random' ? get_random_int(0, 7) : $crystals_ganon;
            $crystals_tower = $config['crystals.tower'] ?? '7';
            $crystals_tower = $crystals_tower === 'random' ? get_random_int(0, 7) : $crystals_tower;
            $logic = [
                'none' => 'NoGlitches',
                'overworld_glitches' => 'OverworldGlitches',
                'major_glitches' => 'MajorGlitches',
                'no_logic' => 'NoLogic',
            ][$config['glitches'] ?? 'none'];

            // quick fix for CC and Basic/Entrance
            if (($config['item.pool'] ?? 'normal') === 'crowd_control') {
                $request->merge(['item_placement' => 'advanced']);
                $request->merge(['entrances' => 'none']);
            }

            // @TODO implement this file!
        }

        // the .mw file
        return gzencode(json_encode([$worlds, $logic]));
    }
}
