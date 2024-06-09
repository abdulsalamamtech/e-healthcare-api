<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'medical_officer_id',
        'guidance_user_id',
        'hospital_id',
        'emergency_no',
        'name',
        'sex',
        'address',
        'age',
        'allergies',
        'phone_number',
        'guidance_nin',
        'guidance_phone_number',
        'details',
    ];

    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Guidance User
    public function guidanceUser()
    {
        return $this->belongsTo(User::class, 'guidance_user_id', 'id');
    }

    // Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    // Medical officer
    public function medicalOfficer()
    {
        return $this->belongsTo(MedicalOfficer::class);
    }

}
