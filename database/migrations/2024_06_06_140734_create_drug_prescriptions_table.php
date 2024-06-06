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
        Schema::create('drug_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drug_id')->constrained('drugs');
            $table->foreignId('prescription_id')->constrained('prescriptions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drug_prescriptions');
    }
};
