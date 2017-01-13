<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMotoToSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schools', function(Blueprint $table)
		{
			//
			$table->string('moto', 400)->default('');
			$table->string('mission', 400)->default('');
			$table->string('vision', 400)->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('schools', function(Blueprint $table)
		{
			//
			$table->dropColumn('moto');
			$table->dropColumn('mission');
			$table->dropColumn('vision');
		});
	}

}
