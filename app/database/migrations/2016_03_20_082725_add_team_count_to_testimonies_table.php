<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamCountToTestimoniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('testimonies', function(Blueprint $table)
		{
			//
			$table->string('count',400)->nullable()->default("");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('testimonies', function(Blueprint $table)
		{
			//
			$table->dropColumn('count');
		});
	}

}
