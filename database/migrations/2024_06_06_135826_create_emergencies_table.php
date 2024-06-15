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
        Schema::create('emergencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('patient_id')->nullable()->constrained('patients');
            $table->foreignId('medical_officer_id')->nullable()->constrained('medical_officers');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors');
            $table->foreignId('guidance_user_id')->nullable()->constrained('users');
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals');
            $table->string('emergency_no');
            $table->string('name');
            $table->string('sex');
            $table->string('address');
            $table->integer('age')->nullable();
            $table->string('allergies')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('guidance_nin')->nullable();
            $table->string('guidance_phone_number')->nullable();
            $table->text('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergencies');
    }
};
