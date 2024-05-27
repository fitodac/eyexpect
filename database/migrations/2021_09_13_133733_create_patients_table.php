<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('patients', function (Blueprint $table) {
      $table->id();
      $table->foreignId('look');
      $table->foreignId('age');
      $table->string('gender', 1);
      $table->foreignId('treatment');
      $table->timestamps();
			// $table->softDeletes();

	    $table->foreign('look')->references('id')->on('looks')->onDelete('cascade');
	    $table->foreign('age')->references('id')->on('ages')->onDelete('cascade');
	    $table->foreign('treatment')->references('id')->on('treatments')->onDelete('cascade');

//	    $table->foreign('look')->references('id')->on('looks');
//	    $table->foreign('age')->references('id')->on('ages');
//	    $table->foreign('treatment')->references('id')->on('treatments');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('patients');
  }
}
