<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRandomizedGame;
use App\Jobs\SendPatchToDisk;
use App\Graph\Randomizer;
use App\Models\FeaturedGame;
use App\Models\Seed;
use App\Rom;
use App\Services\RomWriterService;
use App\Services\SpoilerService;
use Exception;
use GrahamCampbell\Markdown\Facades\Markdown;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RandomizerController extends Controller
{
    public function generateSeed(CreateRandomizedGame $request)
    {
        if ($request->has('lang')) {
            app()->setLocale($request->input('lang'));
        }

        try {
            $payload = $this->prepSeed($request);
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

    public function testGenerateSeed(CreateRandomizedGame $request)
    {
        try {
            return response()->json(Arr::except($this->prepSeed($request, false), ['patch', 'seed', 'hash']));
        } catch (Exception $exception) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($exception);
            }

            return response($exception->getMessage(), 409);
        }
    }

    protected function prepSeed(CreateRandomizedGame $request, bool $save = true)
    {
        // until we speed this up...
        set_time_limit(360);
        $seed = get_random_int();
        // $seed = -5183973964395548770;
        mt_srand($seed);
        Log::debug("Seed: $seed");

        $crystals_ganon = $request->input('crystals.ganon', '7');
        $crystals_ganon = $crystals_ganon === 'random' ? get_random_int(0, 7) : (int) $crystals_ganon;
        $crystals_tower = $request->input('crystals.tower', '7');
        $crystals_tower = $crystals_tower === 'random' ? get_random_int(0, 7) : (int) $crystals_tower;


        $tech = match ($request->input('glitches', 'none')) {
            'none' => [],
            'overworld_glitches' => config('logic.overworld_glitches'),
            'major_glitches' => config('logic.major_glitches'),
            'no_logic' => ['*'],
            default => [],
        };

        $spoilers = $request->input('spoilers', 'off');
        if (!$request->input('tournament', true)) {
            $spoilers = "on";
        } else if (!in_array($request->input('spoilers', 'off'), ["on", "off", "generate", "mystery"])) {
            $spoilers = "off";
        }

        // quick fix for CC and Basic
        if ($request->input('item.pool', 'normal') === 'crowd_control') {
            $request->merge(['item_placement' => 'advanced']);
        }

        $rom = new Rom(config('alttp.base_rom'));
        $rom->applyPatchFile(Rom::getJsonPatchLocation());

        $rand = new Randomizer([
            [
                'mode.state' => $request->input('mode', 'standard'),
                'itemPlacement' => $request->input('item_placement', 'basic'),
                'dungeonItems' => $request->input('dungeon_items', 'standard'),
                'accessibility' => $request->input('accessibility', 'items'),
                'goal' => $request->input('goal', 'ganon'),
                'crystals.ganon' => $crystals_ganon,
                'crystals.tower' => $crystals_tower,
                'entrances' => $request->input('custom_entrances') ?? $request->input('entrances', 'none'),
                'mode.weapons' => $request->input('weapons', 'randomized'),
                'tournament' => $request->input('tournament', false),
                'spoilers' => $spoilers,
                'allow_quickswap' => $request->input('allow_quickswap', false),
                'spoil.Hints' => $request->input('hints', 'off'),
                'tech' => $tech,
                'item.pool' => $request->input('item.pool', 'normal'),
                'item.functionality' => $request->input('item.functionality', 'normal'),
                'enemizer.bossShuffle' => $request->input('enemizer.boss_shuffle', 'none'),
                'enemizer.enemyShuffle' => $request->input('enemizer.enemy_shuffle', 'none'),
                'enemizer.enemyDamage' => $request->input('enemizer.enemy_damage', 'default'),
                'enemizer.enemyHealth' => $request->input('enemizer.enemy_health', 'default'),
            ]
        ]);

        $worlds = $rand->randomize();
        $world = $worlds[0];
        $writer = new RomWriterService();
        $writer->writeWorldToRom($world, $rom);

        if (!$rand->collectItems()->has("Triforce:0")) {
            throw new Exception('Game Unwinnable');
        }

        $spoiler_meta = [];
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

        $spoilerService = new SpoilerService();
        $spoiler = $spoilerService->getSpoiler($world, array_merge([
            'entry_crystals_ganon' => $request->input('crystals.ganon', '7'),
            'entry_crystals_tower' => $request->input('crystals.tower', '7'),
            'worlds' => 1,
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
        $seed->spoiler = json_encode($spoiler);
        if ($save) {
            $seed->patch = json_encode($patch);
            $seed->save();

            $feature = $request->input('featured');
            if ($feature instanceof FeaturedGame) {
                $feature->seed_id = $seed->id;
                $feature->description = vsprintf("%s %s %s", [
                    $world->config('goal'),
                    $world->config('mode.weapons'),
                    $world->config('logic'),
                ]);
                $feature->save();
            }
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
