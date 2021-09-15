<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('base_rom/settings', 'SettingsController@rom');

Route::get('customizer/settings', 'SettingsController@customizer');

Route::get('randomizer/settings', 'SettingsController@item');

Route::get('sprites', 'SettingsController@sprites');

Route::any('hash/{hash}', static function ($hash) {
    $cache_hash = 'hash.' . $hash;
    $payload = cache($cache_hash);
    if (!$payload) {
        try {
            $stored = Storage::get($hash . '.json');
            if (mb_strpos($stored, "\x1f\x8b") === 0) {
                $stored = gzdecode($stored);
            }
            cache([$cache_hash => $stored], now()->addDays(7));
            return $stored;
        } catch (\Exception $e) {
            try {
                cache([$cache_hash => Storage::get($hash . '.json')], now()->addDays(7));
                return cache($cache_hash);
            } catch (\Exception $e2) {
                logger()->error($e2->getMessage());
            }
        }
        abort(404);
    }

    return $payload;
});

// @TODO: perhaps a front end page that checks their localStorage for prefered locale?
Route::get('h/{hash}', static function ($hash) {
    return redirect(config('app.locale') . '/h/' . $hash);
});

Route::prefix('{lang?}')->middleware('locale')->group(function () {
    Route::view('/', 'about');

    Route::view('about', 'about');

    Route::view('calendar', 'calendar');

    Route::view('contribute', 'contribute');

    Route::view('customize{r?}', 'customizer');

    Route::redirect('entrance/randomize{r?}', 'randomizer', 301);

    Route::redirect('game_modes', 'options', 301);

    Route::redirect('game_logics', 'options', 301);

    Route::redirect('game_difficulties', 'options', 301);

    Route::redirect('game_variations', 'options', 301);

    Route::redirect('game_enemizer', 'options', 301);

    Route::redirect('game_entrance', 'options', 301);

    Route::view('help', 'start');

    Route::redirect('info', 'help', 301);

    // Route::view('multiworld', 'multiworld');

    Route::view('options', 'options');

    Route::view('races', 'races');

    Route::view('randomize{r?}', 'randomizer');

    Route::view('resources', 'resources');

    Route::redirect('special', '/');

    Route::view('sprite_preview', 'sprite_preview');

    Route::view('start', 'start');

    Route::view('updates', 'updates');

    Route::view('watch', 'watch');

    Route::view('cookies', 'cookie');

    Route::get('daily', static function () {
        $featured = ALttP\FeaturedGame::today();
        if (!$featured) {
            $exitCode = Artisan::call('alttp:dailies', ['days' => 1]);
            $featured = ALttP\FeaturedGame::today();
        }
        $seed = $featured->seed;
        if ($seed) {
            $build = ALttP\Build::where('build', $seed->build)->first();
            if (!$build) {
                abort(404);
            }
            return view('daily', [
                'hash' => $seed->hash,
                'md5' => $build->hash,
                'bpsLocation' => sprintf(
                    '/bps/%s.bps',
                    $build->hash
                ),
                'daily' => $featured->day,
            ]);
        }
        abort(404);
    });

    Route::get('h/{hash}', static function ($lang, $hash) {
        $seed = ALttP\Seed::where('hash', $hash)->first();
        if ($seed) {
            $build = ALttP\Build::where('build', $seed->build)->first();
            if (!$build) {
                abort(404);
            }
            return view('patch_from_hash', [
                'hash' => $hash,
                'md5' => $build->hash,
                'seed' => $seed,
                'bpsLocation' => sprintf(
                    '/bps/%s.bps',
                    $build->hash
                ),
                'spoiler' => json_decode($seed->spoiler),
            ]);
        }
        abort(404);
    });
});
