<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('results', function(Blueprint $table)
		{
			$table->foreign('exam_id', 'results_ibfk_1')->references('id')->on('exams')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('student_id', 'results_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('results', function(Blueprint $table)
		{
			$table->dropForeign('results_ibfk_1');
			$table->dropForeign('results_ibfk_2');
		});
	}

}
