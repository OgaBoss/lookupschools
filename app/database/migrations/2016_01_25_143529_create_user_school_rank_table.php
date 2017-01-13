<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSchoolRankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('user_school_rank', function(Blueprint $table){
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->integer('user_id')->unsigned()->default(0);
			$table->integer('rank')->unsigned()->default(0);
			$table->integer('count')->unsigned()->default(0);
			$table->timestamps();

			$table->foreign('school_id')
				->references('id')
				->on('schools');

			$table->foreign('user_id')
				->references('id')
				->on('users');
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
		Schema::drop('user_school_rank');

	}

}
