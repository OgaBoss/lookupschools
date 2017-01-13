<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('events', function(Blueprint $t){
			$t->increments('id');

			$t->integer('school_id')->unsigned()->default(0);
			$t->text('description')->default('');
			$t->string('title',400)->default('');
			$t->string('startdate',400)->default('');
			$t->string('enddate',400)->default('');
			$t->string('allday',400)->default('');
			$t->timestamps();

			$t->foreign('school_id')
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
		Schema::drop('events');
	}

}
