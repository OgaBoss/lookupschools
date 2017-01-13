<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultySchoolCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('faculty_school_course', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('faculty_school_id')->unsigned()->default(0);
            $table->string('course', 400)->default('');
            $table->timestamps();

            $table->foreign('faculty_school_id')
                ->references('id')
                ->on('faculty_school')
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
		//
        Schema::drop('faculty_school_course');
	}

}
