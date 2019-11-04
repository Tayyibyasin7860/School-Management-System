<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStudentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_details', function(Blueprint $table)
		{
			$table->foreign('student_id', 'student_details_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('class_id', 'student_details_ibfk_2')->references('id')->on('classes')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_details', function(Blueprint $table)
		{
			$table->dropForeign('student_details_ibfk_1');
			$table->dropForeign('student_details_ibfk_2');
		});
	}

}
