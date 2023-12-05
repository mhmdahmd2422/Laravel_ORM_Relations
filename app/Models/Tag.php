<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'likable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
