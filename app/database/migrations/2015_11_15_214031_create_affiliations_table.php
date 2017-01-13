<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliations', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->string('affiliations_1', 400)->nullable()->deafault('');
			$table->string('affiliations_2', 400)->nullable()->deafault('');
			$table->string('affiliations_3', 400)->nullable()->deafault('');
			$table->string('affiliations_4', 400)->nullable()->deafault('');
			$table->string('affiliations_5', 400)->nullable()->deafault('');
			$table->string('affiliations_6', 400)->nullable()->deafault('');

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
		Schema::drop('affiliations');
	}

}
