<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnapshotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snapshots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id');
			$table->integer('backlog_~')->default(0);
			$table->integer('backlog_s')->default(0);
			$table->integer('backlog_m')->default(0);
			$table->integer('backlog_l')->default(0);
			$table->integer('backlog_xl')->default(0);
			$table->integer('current_~')->default(0);
			$table->integer('current_s')->default(0);
			$table->integer('current_m')->default(0);
			$table->integer('current_l')->default(0);
			$table->integer('current_xl')->default(0);
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
		Schema::drop('snapshots');
	}

}