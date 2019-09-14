<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DailySeedAndCleanup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_games', function (Blueprint $table) {
            $table->increments('id');
            $table->date('day')->unique();
            $table->integer('seed_id');
            $table->string('description')->default('');
            $table->timestamps();
        });

        Schema::table('seeds', function (Blueprint $table) {
            $table->dropColumn(['patch']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seeds', function (Blueprint $table) {
            $table->json('patch');
        });

        Schema::dropIfExists('featured_games');
    }
}
