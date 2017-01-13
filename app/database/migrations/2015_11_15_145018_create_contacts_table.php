<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->string('website', 400)->nullable()->default('');
			$table->string('info_email', 400)->nullable()->default('');
			$table->string('sale_email', 400)->nullable()->default('');
			$table->string('academic_email', 400)->nullable()->default('');
			$table->string('phone_1', 400)->nullable()->default('');
			$table->string('phone_2', 400)->nullable()->default('');
			$table->string('mobile_1', 400)->nullable()->default('');
			$table->string('mobile_2', 400)->nullable()->default('');
			$table->string('fax', 400)->nullable()->default('');
			$table->string('telex', 400)->nullable()->default('');

			//Add a foreign key
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
			Schema::drop('contacts');

	}

}
