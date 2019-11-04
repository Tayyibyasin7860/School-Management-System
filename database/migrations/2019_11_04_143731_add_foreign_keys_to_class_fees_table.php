<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassFeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('class_fees', function(Blueprint $table)
		{
			$table->foreign('fee_type_id', 'class_fees_ibfk_2')->references('id')->on('fee_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('class_id', 'class_fees_ibfk_3')->references('id')->on('classes')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('class_fees', function(Blueprint $table)
		{
			$table->dropForeign('class_fees_ibfk_2');
			$table->dropForeign('class_fees_ibfk_3');
		});
	}

}
