<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('admin_id')->unsigned()->index('admin_id');
			$table->integer('category_id')->unsigned()->index('category_id');
			$table->string('title');
			$table->string('slug')->default('');
			$table->text('content', 65535);
			$table->string('image')->nullable();
			$table->enum('status', array('PUBLISHED','DRAFT'))->default('PUBLISHED');
			$table->date('date');
			$table->boolean('featured')->default(0);
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
		Schema::drop('articles');
	}

}
