<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adverts', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->string('name', 400)->nullable()->default("");
			$table->string('type', 400)->nullable()->default("");
			$table->string('validity', 400)->nullable()->default("");
			$table->string('description', 1500)->nullable()->default("");
			$table->string('price', 400)->nullable()->default("");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adverts');
	}

}
