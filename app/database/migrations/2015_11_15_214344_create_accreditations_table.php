<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccreditationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('accreditations', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->string('accreditations_1', 400)->nullable()->deafault('');
			$table->string('accreditations_2', 400)->nullable()->deafault('');
			$table->string('accreditations_3', 400)->nullable()->deafault('');
			$table->string('accreditations_4', 400)->nullable()->deafault('');
			$table->string('accreditations_5', 400)->nullable()->deafault('');

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
		//
		Schema::drop('accreditations');
	}

}
