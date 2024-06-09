<?php

namespace App\Models;

use App\Models\User;
use App\Models\Emergency;
use App\Models\Treatment;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emergency_id',
        'name',
        'allergies',
        'phone_number',
        'nin',
        'guidance_nin',
        'guidance_phone_number',
    ];

    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Emergency
    public function emergency()
    {
        return $this->belongsTo(Emergency::class, 'emergency_id');
    }

    // Emergency
    public function emergencies()
    {
        return $this->hasMany(Emergency::class);
    }

    // Treatments
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    // Prescription
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    // Appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
