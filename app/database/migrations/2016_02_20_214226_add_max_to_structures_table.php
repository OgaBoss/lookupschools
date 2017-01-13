<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxToStructuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('structures', function(Blueprint $table)
		{
			//
			$table->string('max', 400)->default('NULL');
			$table->string('min', 400)->default('NULL');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('structures', function(Blueprint $table)
		{
			//
			$table->dropColumn('max');
			$table->dropColumn('min');
		});
	}

}
