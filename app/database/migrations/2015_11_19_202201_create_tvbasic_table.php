<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvbasicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tvbasic', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->integer('school_id')->unsigned()->default(0);
            $table->string('medical_facility', 400)->nullable()->default('');
            $table->string('health_prof', 400)->nullable()->default('');
            $table->string('accommodation',400)->nullable()->defualt('');
            $table->string('average_student',400)->nullable()->defualt('');
            $table->string('admission_age_limit',400)->nullable()->defualt('');
            $table->string('vocational_facility',400)->nullable()->defualt('');
            $table->string('sport_facility',400)->nullable()->defualt('');
            $table->string('club_society',400)->nullable()->defualt('');
            $table->text('admission_requirement')->nullable()->default('');
            $table->string('vocation_category', 400)->nullable()->default('');
            $table->string('program_offered', 400)->nullable()->default('');


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
		Schema::drop('tvbasic');
	}

}
