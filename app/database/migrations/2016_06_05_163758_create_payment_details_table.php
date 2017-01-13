<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('advert_school_id')->unsigned()->default(0);
			$table->string('reference', 400)->default("");
			$table->string('amount', 400)->default("0");
			$table->string('transaction_date', 400)->default("");
			$table->string('authorization_code', 400)->default("");
			$table->string('card_type', 400)->default("");
			$table->string('card_last4', 400)->default("");
			$table->string('exp_month', 400)->default("");
			$table->string('exp_year', 400)->default("");
			$table->string('bank', 400)->default("");
			$table->timestamps();

			$table->foreign('advert_school_id')
				->references('id')
				->on('advert_school');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payment_details');
	}

}
