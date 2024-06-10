<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Hospital;
use App\Models\Emergency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'emergency_id',
        'hospital_id',
        'title',
        'description',
        'result',
        'amount',
        'paid',
    ];


    // Patients
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Emergencies
    public function emergency()
    {
        return $this->belongsTo(Emergency::class);
    }

    // Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
