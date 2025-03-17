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
    Schema::create('costume_histories', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('actor_id');
      $table->unsignedBigInteger('costume_id');
      $table->float('amount_deposit');
      $table->string('take_condition')->nullable();
      $table->string('return_condition')->nullable();
      $table->float('amount_returned_deposit')->nullable();
      $table->boolean('is_to_be_repaired')->default(false);
      $table->text('comments')->nullable();
      $table->date('returned_at')->nullable();

      $table->softDeletes();
      $table->timestamps();

      $table->foreign('actor_id')
        ->references('id')
        ->on('actors');

      $table->foreign('costume_id')
        ->references('id')
        ->on('costumes');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('costume_histories');
  }
};
