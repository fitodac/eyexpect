<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhasesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('phases', function (Blueprint $table) {
			$table->id();
			$table->string('code');
			$table->string('name');
			$table->foreignId('patient_id');
			// $table->softDeletes();

			$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('phases');
  }
}
