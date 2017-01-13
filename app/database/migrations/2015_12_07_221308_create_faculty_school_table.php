<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultySchoolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty_school', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('school_id')->unsigned()->default(0);
            $table->integer('faculty_id')->unsigned()->default(0);
			$table->timestamps();

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onDelete('cascade');

            $table->foreign('faculty_id')
                ->references('id')
                ->on('faculty')
                ->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faculty_school');
	}

}
