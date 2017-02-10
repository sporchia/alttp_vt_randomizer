<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('seeds', function (Blueprint $table) {
			$table->increments('id');
			$table->char('hash', 10)->nullable();
			$table->bigInteger('seed');
			$table->string('rules', 32);
			$table->integer('logic');
			$table->string('game_mode', 32);
			$table->json('patch');
			$table->json('spoiler')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('seeds');
	}
}
