<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\MedicalOfficer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'medical_officer_id',
    ];

    // Patients
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Medical officer
    public function medicalOfficer()
    {
        return $this->belongsTo(MedicalOfficer::class);
    }
}
