<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovePatchesBackToSeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seeds', function (Blueprint $table) {
            $table->json('patch')->nullable();
        });

        if (DB::getDriverName() == 'mysql') {
            DB::update("UPDATE seeds JOIN patches ON patches.id = seeds.patch_id SET seeds.patch = patches.patch;");
        }

        Schema::table('seeds', function (Blueprint $table) {
            $table->dropColumn(['patch_id', 'rules']);
        });

        Schema::dropIfExists('patches');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
            $table->string('rules', 32)->default('numpty');
        });

        if (DB::getDriverName() == 'mysql') {
            DB::update("UPDATE seeds JOIN patches ON patches.sha1 = SHA1(seeds.patch) SET seeds.patch_id = patches.id");
        }

        Schema::table('seeds', function (Blueprint $table) {
            $table->dropColumn(['patch']);
        });
    }
}
