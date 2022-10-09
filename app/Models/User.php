<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\BareMail;
use App\Notifications\PasswordResetNotification;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password','prof_image_path','provider_id','provider_name','prof_text'
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
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function likes()
    {
        return $this->belongsToMany('App\Models\Post', 'likes')->withTimestamps();
    }
    public function likesOfUser()
    {
        return $this->hasManyThrough( 'App\Models\Like','App\Models\Post');
    }
    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }
    public function followings()
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }
    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }
    public function getCountFollowersAttribute(): int
    {
        return $this->followers->count();
    }

    public function getCountFollowingsAttribute(): int
    {
        return $this->followings->count();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }
}

