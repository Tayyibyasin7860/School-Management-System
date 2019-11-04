<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('student_id')->unsigned()->unique('student_id');
			$table->bigInteger('class_id')->unsigned()->index('class_id');
			$table->string('photo')->nullable();
			$table->string('father_name');
			$table->enum('gender', array('Male','Female'));
			$table->bigInteger('phone_number');
			$table->date('date_of_birth');
			$table->text('address', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_details');
	}

}
