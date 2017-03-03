<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('models', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('brand_id')->unsigned();
      $table->string('name', 80);
      $table->text('description')->nullable()->default(null);

      $table->foreign('brand_id')->references('id')->on('brands');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {

    Schema::dropIfExists('models');
  }
}
