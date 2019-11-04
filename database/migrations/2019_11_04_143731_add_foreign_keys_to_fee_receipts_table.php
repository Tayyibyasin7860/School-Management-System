<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFeeReceiptsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fee_receipts', function(Blueprint $table)
		{
			$table->foreign('fee_type_id', 'fee_receipts_ibfk_1')->references('id')->on('fee_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('student_id', 'fee_receipts_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fee_receipts', function(Blueprint $table)
		{
			$table->dropForeign('fee_receipts_ibfk_1');
			$table->dropForeign('fee_receipts_ibfk_2');
		});
	}

}
