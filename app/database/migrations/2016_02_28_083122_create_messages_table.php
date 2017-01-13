<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->integer('sender')->unsigned()->default(0);
            $table->string('sender_identity', 400)->default('');
            $table->integer('receiver')->unsigned()->default(0);
            $table->string('receiver_identity', 400)->default('');
            $table->string('subject', 1500)->default('');
            $table->string('body', 400)->default('');
            $table->boolean('read')->default(1);
            $table->timestamps();

            $table->foreign('sender')
                ->references('id')
                ->on('users');

            $table->foreign('receiver')
                ->references('id')
                ->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('messages');

    }

}
