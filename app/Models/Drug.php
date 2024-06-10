<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pharmacy;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'name',
        'description',
        'price',
    ];

    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pharmacy
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }


    // Prescriptions
    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'drug_prescriptions');
    }
}
