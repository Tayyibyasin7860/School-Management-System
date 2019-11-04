<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeeReceiptsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_receipts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('student_id')->unsigned()->index('student_id');
			$table->bigInteger('fee_type_id')->unsigned()->index('fee_id');
			$table->integer('amount');
			$table->integer('submitted_amount')->nullable();
			$table->dateTime('due_date')->nullable();
			$table->dateTime('submission_date')->nullable();
			$table->enum('status', array('pending','paid'))->default('pending');
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
		Schema::drop('fee_receipts');
	}

}
