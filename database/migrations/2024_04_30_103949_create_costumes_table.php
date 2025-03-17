<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('costumes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('period_id')->nullable();
      $table->unsignedBigInteger('costumes_category_id');
      $table->unsignedBigInteger('size_id')->nullable();
      $table->string('img_url')->nullable();
      $table->string('number')->unique();
      $table->string('name');
      $table->string('description');
      $table->string('condition');
      $table->string('gender')->nullable();
      $table->string('type');
      $table->float('deposit');
      $table->boolean('is_to_be_repaired')->default(false);
      $table->float('price')->nullable();
      $table->softDeletes();
      $table->timestamps();

      $table->foreign('period_id')
        ->references('id')
        ->on('periods');

      $table->foreign('costumes_category_id')
        ->references('id')
        ->on('costumes_categories');

      $table->foreign('size_id')
        ->references('id')
        ->on('sizes');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('costumes');
  }
};
