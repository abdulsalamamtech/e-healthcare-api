<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tracking_no',
        'transaction_id',
        'session_id',
        'total_price',
        'payment_method',
        'status',
    ];
}
