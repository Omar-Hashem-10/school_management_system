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
        Schema::create('certificate_courses', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_marks');
            $table->timestamps();

            $table->foreignId('course_code_id')->constrained('course_codes')->cascadeOnDelete();
            $table->foreignId('certificate_id')->constrained('certificates')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_subjects');
    }
};
