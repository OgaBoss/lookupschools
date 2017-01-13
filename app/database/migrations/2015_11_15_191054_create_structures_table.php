<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('structures', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->string('dob', 400)->nullable()->default('');
			$table->string('school_head', 400)->nullable()->default('');
			$table->string('ownership', 400)->nullable()->default('');
			$table->string('sex', 400)->nullable()->default('');
			$table->string('public', 400)->nullable()->default('');
			$table->string('private', 400)->nullable()->default('');
			$table->string('religion', 400)->nullable()->default('');
			$table->string('school_type', 400)->nullable()->default('');
			$table->string('tertiary', 400)->nullable()->default('');
			$table->string('preschool', 400)->nullable()->default('');
			$table->string('military', 400)->nullable()->default('');

			$table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
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
		Schema::drop('structures');
	}

}
