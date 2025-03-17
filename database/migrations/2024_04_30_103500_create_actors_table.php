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
    Schema::create('actors', function (Blueprint $table) {
      $table->id();
      $table->string('lastname');
      $table->string('firstname');
      $table->string('email');
      $table->string('tel');
      $table->string('address');
      $table->string('zip_code');
      $table->string('city');
      $table->boolean('is_volunteer')->default(true);
      $table->string('size')->nullable();
      $table->string('shoe_size')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('actors');
  }
};
