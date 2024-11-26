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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->enum('subject', [
                'academic_inquiry',
                'absence_and_attendance',
                'technical_support',
                'academic_feedback',
                'exams',
                'curriculum',
                'payments_and_fees',
                'student_activities',
                'registration_and_admission',
                'job_opportunities',
                'counseling',
                'reports_and_certificates',
                'complaints',
                'professional_development',
                'leave_requests'
            ]);
            $table->text('message');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
