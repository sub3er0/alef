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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('lecture_id');
            $table->foreign('grade_id')->references('id')->on('grades');
            $table->foreign('lecture_id')->references('id')->on('lectures');
            $table->integer('priority');
            $table->unique(['grade_id', 'lecture_id']);
            $table->unique(['grade_id', 'priority']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
