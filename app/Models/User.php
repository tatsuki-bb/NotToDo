<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Mainlist;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image',
        'search_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mainLists() {
        return $this->hasMany(Mainlist::class,'user_id','id');
    }

    public function followings() //フォローしている人を取得
    {
        return $this->belongsToMany(User::class, 'followings', 'user_id', 'follow_id')->withTimestamps();;
    }

    public function followers() //フォローされている人を取得
    {
        return $this->belongsToMany(User::class, 'followings', 'follow_id','user_id' )->withTimestamps();;
    }

    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id','<>',$user_id)->paginate(5);
    }

   public function follow_each()
   {
       $userIds = $this->followings()->pluck('users.id')->toArray();  //pluck　配列内の指定したものをすべて取得
       //follow_idを取得し、それと紐づいているusersテーブルのレコードを取得

       $follow_each = $this->followers()->whereIn('users.id',$userIds)->pluck('users.id')->toArray();
                                         //第一引数から、第二引数を探す
       return $follow_each;
   }

   public function follow()
   {
    $userIds = $this->followings()->pluck('users.id')->toArray();

    return $userIds;
    //フォローしている人のみ取得
   }

   public function followed()
   {
    $userIds = $this->followers()->pluck('users.id')->toArray();

    return $userIds;
    //フォローされている人のみ取得
   }

   public function unfollow()
   {
       $userIds = $this->followers()->pluck('followings.user_id')->toArray();  //pluck　配列内の指定したものをすべて取得
       //follow_idを取得し、それと紐づいているusersテーブルのレコードを取得

       $follow_each = Auth::users()->id()->whereIn('users.id',$userIds)->pluck('followings.id');
                                         //第一引数から、第二引数を探す
       return $follow_each;
   }

}

