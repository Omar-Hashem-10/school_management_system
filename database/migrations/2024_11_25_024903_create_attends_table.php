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
        Schema::create('attends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendable_id');
            $table->string('attendable_type');
            $table->enum('status', ['present', 'absent', 'excused'])->default('absent');
            $table->foreignId('date_id')->constrained('dates')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attends');
    }
};