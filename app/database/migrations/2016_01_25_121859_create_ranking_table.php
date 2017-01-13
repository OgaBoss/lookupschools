<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('school_rank', function(Blueprint $table){
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->integer('rank')->unsigned()->default(0);
			$table->integer('count')->unsigned()->default(0);
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
		//
		Schema::drop('school_rank');
	}

}
