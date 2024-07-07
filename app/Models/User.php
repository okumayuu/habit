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
        'category_id',
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
    
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    public function todos(){
        return $this->hasMany(User::class);
        
    }
    
    public function posts(){
        return $this->hasMany(Post::class,);
        
    }
    
    public function targets(){
        return $this->hasMany(User::class,);
        
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function follower(){
    return $this->belongsToMany(User::class, 'follows', 'followee_user_id','follower_user_id');
    }
    
    // 自分 (繋ぎ先) をフォローしているユーザー = フォロワー (繋ぎ元) をリレーション
    // フォロワー -> 自分
    public function followee(){
        return $this->belongsToMany(User::class, 'follows', 'follower_user_id','followee_user_id',);
    }
    
    public function isFollowing($user_id)
    {
        return $this->follower()->where('follower_user_id',$user_id)->exists();
    }
    
   
}
