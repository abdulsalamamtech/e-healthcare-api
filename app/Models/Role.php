<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
    ];


    // - 'user' - view posts and manage their own comments
    // - 'super-admin' - manage the entire website
    // - 'admin', - manage other users
    // - 'editor' - manage entire posts
    // - 'author', - mange their own post
    // - 'viewer' - inspection only
    

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
