<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_id',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'phone_number',
        'nin',
        'dob',
        'blood_group',
        'genotype',
        'address',
        'lga',
        'state',
        'country',
        'active',
    ];


    // User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // User profile image
    public function profileImage()
    {
        return $this->hasOne(Image::class, 'image_id', 'id');
    }
}
