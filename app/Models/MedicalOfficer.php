<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalOfficer extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'name',
        'specialization',
        'address',
    ];

    // Patients
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    // Treatments
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    // Appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Emergencies
    public function emergencies()
    {
        return $this->hasMany(Emergency::class);
    }

    // Prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }


}
