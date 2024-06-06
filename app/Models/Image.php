<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $fillable = [
        'path',
        'file_id',
        'url',
        'size',
        'hosted_at',
        'active',
    ];

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'image_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'image_id', 'id');
    }
}
