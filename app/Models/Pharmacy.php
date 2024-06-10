<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
    ];


    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Drugs
    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }
}
