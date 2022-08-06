<?php

namespace App\Http\Controllers;

use App\Graph\Item;
use App\Jobs\SendPatchToDisk;
use App\Graph\Randomizer;
use App\Models\Seed;
use App\Rom;
use App\Services\RomWriterService;
use App\Services\SpoilerService;
use App\Sprite;
use Exception;
use GrahamCampbell\Markdown\Facades\Markdown;
use HTMLPurifier_Config;
use HTMLPurifier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CustomizerController extends Controller
{
    public function generateSeed(Request $request)
    {
        if ($request->has('lang')) {
            app()->setLocale($request->input('lang'));
        }

        try {
            $payload = $this->prepSeed($request, true);
            $payload['seed']->save();
            SendPatchToDisk::dispatch($payload['seed']);

            $return_payload = Arr::except($payload, [
                'seed',
                'spoiler.meta.crystals_ganon',
                'spoiler.meta.crystals_tower',
            ]);

            if ($payload['spoiler']['meta']['tournament'] ?? false) {
                switch ($payload['spoiler']['meta']['spoilers']) {
                    case "on":
                    case "generate":
                        $return_payload = Arr::except($return_payload, [
                            'spoiler.playthrough',
                        ]);
                        break;
                    case "mystery":
                        $return_payload['spoiler'] = Arr::only($return_payload['spoiler'], ['meta']);
                        $return_payload['spoiler']['meta'] = Arr::only($return_payload['spoiler']['meta'], [
                            'name',
                            'notes',
                            'logic',
                            'build',
                            'tournament',
                            'spoilers',
                            'size',
                            'special',
                            'allow_quickswap'
                        ]);
                        break;
                    case "off":
                    default:
                        $return_payload['spoiler'] = Arr::except(Arr::only($return_payload['spoiler'], [
                            'meta',
                        ]), ['meta.seed']);
                }
            }

            $cached_payload = $return_payload;
            if ($payload['spoiler']['meta']['spoilers'] === 'generate') {
                // ensure that the cache doesn't have the spoiler, but the original return_payload still does
                $cached_payload['spoiler'] = Arr::except(Arr::only($return_payload['spoiler'], [
                    'meta',
                ]), ['meta.seed']);
            }
            $save_data = json_encode(Arr::except($cached_payload, [
                'current_rom_hash',
            ]));
            Cache::put('hash.' . $payload['hash'], $save_data, now()->addDays(7));

            return response()->json($return_payload);
        } catch (Exception $exception) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($exception);
            }

            return response($exception->getMessage(), 409);
        }
    }

    public function testGenerateSeed(Request $request)
    {
        try {
            return response()->json(Arr::except($this->prepSeed($request), ['patch', 'seed', 'hash']));
        } catch (Exception $exception) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($exception);
            }

            return response($exception->getMessage(), 409);
        }
    }

    protected function prepSeed(Request $request, bool $save = false)
    {
        $crystals_ganon = $request->input('crystals.ganon', '7');
        $crystals_ganon = $crystals_ganon === 'random' ? get_random_int(0, 7) : $crystals_ganon;
        $crystals_tower = $request->input('crystals.tower', '7');
        $crystals_tower = $crystals_tower === 'random' ? get_random_int(0, 7) : $crystals_tower;
        $tech = match ($request->input('glitches', 'none')) {
            'none' => [],
            'overworld_glitches' => config('logic.overworld_glitches'),
            'major_glitches' => config('logic.major_glitches'),
            'no_logic' => ['*'],
        };

        $spoilers = $request->input('spoilers', 'off');
        if (!$request->input('tournament', true)) {
            $spoilers = "on";
        } else if (!in_array($request->input('spoilers', 'off'), ["on", "off", "generate", "mystery"])) {
            $spoilers = "off";
        }

        $spoiler_meta = [];

        $custom_data = Arr::dot($request->input('custom'));
        $placed_item_count = array_count_values($request->input('l', []));
        // some simple validation
        // @TODO: move to validator type classes later
        if (
            $request->input('goal', 'ganon') === 'triforce-hunt'
            && ($custom_data['item.Goal.Required'] ?? 0)
            > ($custom_data['item.count.TriforcePiece'] ?? 0) + ($placed_item_count['TriforcePiece:1'] ?? 0)
        ) {
            throw new Exception("Not enough Triforce Pieces for the hunt");
        }

        $purifier_settings = HTMLPurifier_Config::create(config("purifier.default"));
        $purifier_settings->loadArray(config("purifier.default"));
        $purifier = new HTMLPurifier($purifier_settings);
        if ($request->filled('name')) {
            $markdowned = Markdown::convertToHtml(substr($request->input('name'), 0, 100));
            $spoiler_meta['name'] = strip_tags($purifier->purify($markdowned));
        }
        if ($request->filled('notes')) {
            $markdowned = Markdown::convertToHtml(substr($request->input('notes'), 0, 300));
            $spoiler_meta['notes'] = $purifier->purify($markdowned);
        }

        // Fix for hints option not working in Customizer. We overwrite any potential stale
        // spoil.Hints value in custom data because it's not hooked up to the Hints dropdown.
        $custom_data['spoil.Hints'] = $request->input('hints', 'on');
        $custom_data['item.require.Lamp'] = $custom_data['item.require.Lamp'] ? 0 : 1;
        if ($custom_data['rom.freeItemMenu']) {
            $custom_data['rom.freeItemMenu'] = 0x00
                | ($custom_data['region.wildCompasses'] << 3)
                | ($custom_data['region.wildMaps'] << 2)
                | ($custom_data['region.wildBigKeys'] << 1)
                | $custom_data['region.wildKeys'];
        }
        if ($custom_data['rom.freeItemText']) {
            $custom_data['rom.freeItemText'] = 0x10
                | ($custom_data['region.wildBigKeys'] << 3)
                | ($custom_data['region.wildMaps'] << 2)
                | ($custom_data['region.wildCompasses'] << 1)
                | $custom_data['region.wildKeys'];
        }

        $rand = new Randomizer([
            array_merge([
                'mode.state' => $request->input('mode', 'standard'),
                'itemPlacement' => $request->input('item_placement', 'basic'),
                'dungeonItems' => $request->input('dungeon_items', 'standard'),
                'accessibility' => $request->input('accessibility', 'items'),
                'goal' => $request->input('goal', 'ganon'),
                'crystals.ganon' => $crystals_ganon,
                'crystals.tower' => $crystals_tower,
                'entrances' => $request->input('entrances', 'none'),
                'mode.weapons' => $request->input('weapons', 'randomized'),
                'tournament' => $request->input('tournament', false),
                'spoilers' => $spoilers,
                'allow_quickswap' => $request->input('allow_quickswap', false),
                'spoil.Hints' => $request->input('hints', 'off'),
                'tech' => $tech,
                'item.pool' => $request->input('item.pool', 'normal'),
                'item.functionality' => $request->input('item.functionality', 'normal'),
                'entrances' => $request->input('entrances', 'none'),
                'enemizer.bossShuffle' => $request->input('enemizer.boss_shuffle', 'none'),
                'enemizer.enemyShuffle' => $request->input('enemizer.enemy_shuffle', 'none'),
                'enemizer.enemyDamage' => $request->input('enemizer.enemy_damage', 'default'),
                'enemizer.enemyHealth' => $request->input('enemizer.enemy_health', 'default'),
                'enemizer.potShuffle' => $request->input('enemizer.pot_shuffle', 'off'),
                'ignoreCanKillEscapeThings' => array_key_exists("Link's Uncle:0", $request->input('l')),
                'customPrizePacks' => true,
                'equipment' => array_map(fn ($item) => "$item:0", $request->input('eq')),
            ], $custom_data)
        ]);

        foreach ($request->input('l', []) as $location_name => $item) {
            $location = $rand->getLocation($location_name);
            if ($location) {
                if ($item === 'BottleWithRandom') {
                    $place_item = Item::get('Bottle', 0);
                } else {
                    $place_item = Item::get(preg_replace('/:\d+$/', '', $item), 0);
                }
                $location->setAttribute('item', $place_item);
            }
        }

        foreach ($request->input('drops', []) as $pack => $items) {
            foreach ($items as $place => $item) {
                if ($item == 'auto_fill') {
                    continue;
                }

                $drop = Sprite::get($item);

                if (!$drop instanceof \App\Sprite\Droppable) {
                    continue;
                }

                $rand->getWorld(0)->setDrop($pack, $place, $drop);
            }
        }

        $rom = new Rom(config('alttp.base_rom'));
        $rom->applyPatchFile(Rom::getJsonPatchLocation());

        $rand->randomize();
        $world = $rand->getWorld(0);
        $writer = new RomWriterService();
        $writer->writeWorldToRom($world, $rom);

        if (!$rand->collectItems()->has("Triforce:0")) {
            throw new Exception('Game Unwinnable');
        }

        $spoilerService = new SpoilerService();
        $spoiler = $spoilerService->getSpoiler($rand, array_merge([
            'entry_crystals_ganon' => $request->input('crystals.ganon', '7'),
            'entry_crystals_tower' => $request->input('crystals.tower', '7'),
            'worlds' => 1,
            'difficulty' => 'custom',
        ], $spoiler_meta));

        if ($request->input('tournament', false)) {
            $rom->setTournamentType('standard');
            $rom->rummageTable();
        }
        $patch = $rom->getWriteLog();

        $seed = new Seed();
        $seed->logic = 32;
        $seed->game_mode = $request->input('glitches', 'none');
        $seed->build = Rom::BUILD;
        if ($save) {
            $seed->patch = json_encode($patch);
            $seed->save();
        }

        return [
            'logic' => $world->config('logic'),
            'patch' => patch_merge_minify($patch),
            'spoiler' => $spoiler,
            'hash' => $seed->hash,
            'generated' => ($seed->created_at ?? now())->toIso8601String(),
            'seed' => $seed,
            'size' => 2,
            'current_rom_hash' => Rom::HASH,
        ];
    }
}
