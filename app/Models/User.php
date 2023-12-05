<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function liked_posts()
    {
        return $this->morphedByMany(Post::class, 'likable');
    }

    public function liked_tags()
    {
        return $this->morphedByMany(Tag::class, 'likable');
    }

//    public function tags()
//    {
//        return $this->hasManyThrough(Tag::class,
//            Post::class,
//            'user_id',
//            'id',
//            'id',
//            'tag_id'
//        )->distinct();
//    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
