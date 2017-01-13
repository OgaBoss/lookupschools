<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billings', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->integer('advert_id')->unsigned()->default(0);
			$table->string('school_slug')->nullable()->default("");
			$table->string('advert_name')->nullable()->default("");
			$table->string('payments')->nullable()->default("");
			$table->string('duration')->nullable()->default("");
			$table->string('qty')->nullable()->default("");
			$table->date('date_canceled');
			$table->date('date_end');
			$table->softDeletes();
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
		Schema::drop('billings');
	}

}
