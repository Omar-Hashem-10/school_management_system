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
        Schema::create('course_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('level_subject_id')->constrained('level_subjects')->cascadeOnDelete();
            $table->enum('semester', ['first', 'second']);
            $table->timestamps();
        });

        // قم بإنشاء قيد فريد مركب على الأعمدة (code و level_subject_id)
        DB::statement('ALTER TABLE course_codes ADD CONSTRAINT unique_course_codes UNIQUE (code, level_subject_id)');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_codes');
    }
};
