<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('publicID', 400)->nullable()->default("");
            $table->string('openURL', 400)->nullable()->default("");
            $table->string('secureURL', 400)->nullable()->default("");
            $table->integer('imageable_id')->unsigned()->default(0);
            $table->string('imageable_type', '200')->default('');
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
        Schema::drop('photos');
	}

}
