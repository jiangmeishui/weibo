<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function statuses() {
        return $this->hasMany(Status::class);
    }

    public static function boot() {
        parent::boot();
        static::creating(function($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function feed() {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    public function gravatar($size = 100)
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    /**
     * 粉丝
     */
    public function followers() {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * 关注人
     */
    public function followings() {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * 关注
     */
    public function follow($userIds) {
        if ( ! is_array($userIds)) {
            $userIds = compact($userIds);
        }
        $this->followings()->sync($userIds, false);
    }

    /**
     * 取消关注
     */
    public function unFollow($userIds) {
        if ( ! is_array($userIds)) {
            $userIds = compact($userIds);
        }
        $this->followings()->detach($userIds);
    }

    /**
     * 判断是否关注
     */
    public function isFollowing($userId) {
        return $this->followings()->contains($userId);
    }
}
