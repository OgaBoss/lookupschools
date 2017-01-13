<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlToAdvertSchoolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('advert_school', function(Blueprint $table)
		{
			//
			$table->string('video_url', '400')->nullable()->default("");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('advert_school', function(Blueprint $table)
		{
			//
			$table->dropColumn('video_url');
		});
	}

}
