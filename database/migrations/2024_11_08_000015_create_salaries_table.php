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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');       
            $table->foreignId('role_id');
            $table->string('person_type'); 
            $table->decimal('base_salary', 8, 2);         
            $table->decimal('bonus', 8, 2)->nullable();    
            $table->decimal('deduction', 8, 2)->nullable(); 
            $table->decimal('total_salary', 8, 2);         
            $table->integer('month');                      
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};