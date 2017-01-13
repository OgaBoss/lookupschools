<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddClassificationToSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schools', function(Blueprint $table)
		{
            $table->string('classification', '200')->default('');
            $table->string('sex', '200')->default('');
            $table->string('religion', '200')->default('');
            $table->string('religion_type', '200')->default('');
            $table->string('extra', '200')->default('');
            $table->string('preschool', '200')->default('');
            $table->string('tertiary', '200')->default('');
            $table->string('military', '200')->default('');
            $table->string('military_level', '200')->default('');
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
			$table->dropColumn('classification', 'sex', 'religion', 'religion_type', 'extra', 'preschool', 'tertiary', 'military', 'military_level' );
		});
	}

}
