<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->integer('school_id')->unsigned()->default(0);
            $table->string('type', 100)->nullable()->default("");
            $table->string('publicID', 400)->nullable()->default("");
            $table->string('openURL', 400)->nullable()->default("");
            $table->string('secureURL', 400)->nullable()->default("");
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
		Schema::drop('image');
	}
}
