<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repair_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('costume_id');
            $table->text('repair_comment')->nullable();
            $table->text('resolved_comment')->nullable();
            $table->text('condition_before_repair')->nullable();
            $table->text('condition_after_repair')->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('repair_histories');
    }
};
