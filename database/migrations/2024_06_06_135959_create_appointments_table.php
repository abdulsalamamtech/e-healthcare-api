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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients');
            $table->foreignId('medical_officer_id')->nullable()->constrained('medical_officers');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors');
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('paid')->default('false');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
