<?php

namespace App\Models;

use App\Models\User;
use App\Models\LabTest;
use App\Models\Patient;
use App\Models\Emergency;
use App\Models\Treatment;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'specialization',
        'address',
    ];

    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Patients
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    // Emergencies
    public function emergencies()
    {
        return $this->hasMany(Emergency::class, 'hospital_id');
    }

    // Treatments
    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'hospital_id');
    }

    // Prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'hospital_id');
    }

    // Lab test
    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }
}
