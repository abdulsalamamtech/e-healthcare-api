<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
