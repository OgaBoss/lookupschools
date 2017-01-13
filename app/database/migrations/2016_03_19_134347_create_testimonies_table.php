<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimoniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testimonies', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->string('name', 400)->default("");
			$table->string('image_url', 400)->default("");
			$table->text('testimony')->default("");
			$table->timestamps();

			$table->foreign('school_id')
				->references('id')
				->on('schools');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testimonies');
	}

}
