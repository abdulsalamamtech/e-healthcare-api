<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Note;
use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Get all users with specific role
    public function scopeWhereRole($query, $role){
        return $query->whereHas('roles', function($q) use ($role) {
            $q->where('role', $role);
        });
    }

    // check if user has a specific role
    public function roleHas($roleName)
    {
        if($roleName == 'user'){ return true;}
        return $this->roles()->where('role', $roleName)->exists();
    }

    // Get user roles
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    // Any one
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }


    // Users
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user-id', 'id');
    }

    // Admin
    public function categories()
    {
        return $this->hasMany(Category::class, 'created_by', 'id');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'created_by', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'created_by', 'id');
    }

}
