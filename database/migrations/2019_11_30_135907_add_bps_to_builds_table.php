<?php

use ALttP\Build;
use ALttP\Rom;
use ALttP\Support\Flips;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddBpsToBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE `builds` ADD COLUMN `bps` LONGBLOB NULL DEFAULT NULL AFTER `hash`;');
        } else {
            Schema::table('builds', function (Blueprint $table) {
                $table->binary('bps')->nullable()->after('hash');
            });
        }

        // add bps data to DB
        $flips = new Flips;
        $base_rom_location = config('alttp.base_rom');
        Build::each(function ($build) use ($base_rom_location, $flips) {
            $tmp_file = tempnam(sys_get_temp_dir(), "base-{$build->id}-");

            $rom = new Rom($base_rom_location);
            $rom->resize();
            $rom->applyPatch(json_decode($build->patch, true));
            $rom->save($tmp_file);

            $bps_data = $flips->createBpsFromFiles($base_rom_location, $tmp_file, [
                'created' => $build->build,
                'hash' => $build->hash,
            ]);

            $build->bps = $bps_data;
            $build->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('builds', function (Blueprint $table) {
            $table->dropColumn('bps');
        });
    }
}
