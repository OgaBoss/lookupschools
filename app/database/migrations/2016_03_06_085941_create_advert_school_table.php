<?php

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateAdvertSchoolTable extends Migration {

		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('advert_school', function(Blueprint $table)
			{
				//
				$table->increments('id');
				$table->integer('advert_id')->unsigned()->default(0);
				$table->integer('school_id')->unsigned()->default(0);
				$table->string('qty', 400)->nullable()->default("");
				$table->string('duration', 400)->nullable()->default("");
				$table->string('name', 400)->nullable()->default("");
				$table->string('type', 400)->nullable()->default("");
				$table->string('payment', 400)->nullable()->default("");
				$table->dateTime('expiry_date');
				$table->integer('canceled')->unsigned()->default(0);
				$table->softDeletes();
				$table->timestamps();

				$table->foreign('school_id')
					->references('id')
					->on('schools');

				$table->foreign('advert_id')
					->references('id')
					->on('adverts');

			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::drop('advert_school');
		}

	}
