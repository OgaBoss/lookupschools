<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebpageimagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('webpageimages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->string('publicID', 400)->nullable()->default("");
			$table->string('openURL', 400)->nullable()->default("");
			$table->string('secureURL', 400)->nullable()->default("");

			$table->foreign('school_id')->references('id')->on('schools');
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
		Schema::drop('webpageimages');
	}

}
