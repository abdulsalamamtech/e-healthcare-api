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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients');
            $table->foreignId('medical_officer_id')->nullable()->constrained('medical_officers');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors');
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals');
            $table->foreignId('emergency_id')->nullable()->constrained('emergencies');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
