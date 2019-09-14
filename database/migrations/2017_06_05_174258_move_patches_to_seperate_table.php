<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovePatchesToSeperateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sha1', 40)->unique();
            $table->json('patch')->nullable();
            $table->timestamps();
        });

        if (DB::getDriverName() == 'mysql') {
            DB::statement("INSERT IGNORE INTO patches (sha1, patch, created_at, updated_at)
				SELECT SHA1(patch) AS sha1, patch, created_at, updated_at FROM seeds;");
        }

        Schema::table('seeds', function (Blueprint $table) {
            $table->integer('patch_id')->default(0);
        });

        Schema::table('seeds', function (Blueprint $table) {
            $table->dropColumn(['vt_complexity', 'complexity']);
        });

        if (DB::getDriverName() == 'mysql') {
            DB::update("UPDATE seeds JOIN patches ON patches.sha1 = SHA1(seeds.patch) SET seeds.patch_id = patches.id");
            DB::update("UPDATE seeds SET seeds.patch = '[]'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() == 'mysql') {
            DB::update("UPDATE seeds JOIN patches ON patches.id = seeds.patch_id SET seeds.patch = patches.patch;");
        }

        Schema::table('seeds', function (Blueprint $table) {
            $table->dropColumn('patch_id');
        });

        Schema::table('seeds', function (Blueprint $table) {
            $table->integer('complexity')->default(0);
            $table->integer('vt_complexity')->default(0);
        });

        Schema::dropIfExists('patches');
    }
}
