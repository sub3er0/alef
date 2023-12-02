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
        Schema::create('plan_lectures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('lecture_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('lecture_id')->references('id')->on('lectures');
            $table->integer('priority');
            $table->unique(['plan_id', 'lecture_id']);
            $table->unique(['plan_id', 'priority']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_lectures');
    }
};
