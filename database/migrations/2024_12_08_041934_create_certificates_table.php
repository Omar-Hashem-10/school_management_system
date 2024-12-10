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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->integer('total_marks');
            $table->integer('obtained_marks');
            $table->decimal('percentage', 5, 2);
            $table->enum('grade', ['A+', 'A', 'A-', 'B+','B', 'B-', 'C+','C', 'C-', 'D+', 'D', 'D-']);
            $table->timestamps();

            $table->foreignId('level_id')->constrained('levels')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
