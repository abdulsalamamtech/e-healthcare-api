<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_comment_id',
        'content',
        'active',
    ];

    // User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Post
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    // Sub comments
    public function subComments()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id', 'id');
    }
}
