<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration {

  public function up() {
    Schema::create('products', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('category');
      $table->integer('price');
      $table->integer('discount');
      $table->text('description');
      $table->text('img')->nullable();
      $table->integer('user_id');
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('products');
  }
}
