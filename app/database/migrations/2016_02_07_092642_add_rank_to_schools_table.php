<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRankToSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('schools', function(Blueprint $table)
		{
			//
			$table->string('rank', 400)->default('');
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
		Schema::table('schools', function(Blueprint $table)
		{
			//
			$table->dropColumn('rank');
		});
	}

}
