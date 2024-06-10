<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medical_officer_id',
        'doctor_id',
        'role_id',
        'hospital_id',
        'emergency_id',
        'title',
        'description',
        'price',
        'paid',
    ];


    // Medical officer
    public function medicalOfficer()
    {
        return $this->belongsTo(MedicalOfficer::class, 'medical_officer_id');
    }

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

    // Hospital
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }

    // Emergency
    public function emergency(){
        return $this->belongsTo(Emergency::class);
    }


}
