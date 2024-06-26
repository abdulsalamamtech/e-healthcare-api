<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugPrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_id',
        'prescription_id',
    ];
}
