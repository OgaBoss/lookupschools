<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schools', function(Blueprint $table)
		{
			$table->increments('id');

            //user's id
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('name',400)->default('');
            $table->string('local_gov',400)->default('');
            $table->string('state',400)->default('');
            $table->string('area',400)->default('');
            $table->text('address')->default('');
            $table->string('school_type', '100')->default('');
            $table->string('school_head', '200')->default('');
            $table->string('phone_num_1', '200')->default('');
            $table->string('phone_num_2', '200')->default('');
            $table->string('email', '200')->default('');
            $table->string('url_slug', '200')->default('');
            $table->string('website_url', '400')->default('');
            $table->string('facebook_page', '400')->default('');

            //Added this new columns

            //Add a foreign key
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::drop('schools');
	}

}
