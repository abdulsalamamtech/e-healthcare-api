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
            $table->foreignId('user_id')->nullable()->constrained('user');
            $table->foreignId('patient_id')->nullable()->constrained('patients');
            $table->foreignId('guide_id')->nullable()->constrained('patients');
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals');
            $table->string('emergency_no');
            $table->string('name');
            $table->string('sex');
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
