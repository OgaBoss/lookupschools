<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpbasicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ppbasic', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('school_id')->unsigned()->default(0);
			$table->string('average_children_daycare', 400)->nullable()->default('');
			$table->string('average_children_class', 400)->nullable()->default('');
			$table->string('medical_facility', 400)->nullable()->default('');
			$table->string('health_prof', 400)->nullable()->default('');
			$table->string('daycare_locker_type', 400)->nullable()->default('');
			$table->string('boarding_option', 400)->nullable()->default('');
			$table->string('average_child_room', 400)->nullable()->default('');
			$table->string('boarding_locker_type', 400)->nullable()->default('');
			$table->string('daycare_facility', 400)->nullable()->default('');
			$table->string('teacher_student_ratio', 400)->nullable()->default('');
			$table->string('nanny_baby_ratio', 400)->nullable()->default('');
			$table->string('admission_age_limit', 400)->nullable()->default('');
			$table->text('admission_requirement')->nullable()->default('');
			$table->string('ict_room', 400)->nullable()->default('');
			$table->string('vocational_facility', 400)->nullable()->default('');
			$table->string('sport_facility', 400)->nullable()->default('');
			$table->string('subject_offered', 400)->nullable()->default('');
			$table->string('clubs_societies', 400)->nullable()->default('');

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
		Schema::drop('ppbasic');
	}

}
