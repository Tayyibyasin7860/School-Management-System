<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exams', function(Blueprint $table)
		{
			$table->foreign('exam_session_id', 'exams_ibfk_2')->references('id')->on('exam_sessions')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('subject_id', 'exams_ibfk_4')->references('id')->on('subjects')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('class_id', 'exams_ibfk_5')->references('id')->on('classes')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exams', function(Blueprint $table)
		{
			$table->dropForeign('exams_ibfk_2');
			$table->dropForeign('exams_ibfk_4');
			$table->dropForeign('exams_ibfk_5');
		});
	}

}
