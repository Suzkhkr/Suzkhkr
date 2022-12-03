<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\LikeController;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function record() {
        return $this->hasMany('App\Record');
    }

    public function category() {
        return $this->hasMany('App\Category');
    }

    // public function likes()
    // {
    //     return $this->belongsToMany('App\Record','likes','user_id','record_id')->withTimestamps();
    // }

    // //この投稿に対して既にlikeしたかどうかを判別する
    // public function isLike($postId)
    // {
    //   return $this->likes()->where('record_id',$postId)->exists();
    // }

    // //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    // public function like($postId)
    // {
    //   if($this->isLike($postId)){
    //     //もし既に「いいね」していたら何もしない
    //   } else {
    //     $this->likes()->attach($postId);
    //   }
    // }

    // //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    // public function unlike($postId)
    // {
    //   if($this->isLike($postId)){
    //     //もし既に「いいね」していたら消す
    //     $this->likes()->detach($postId);
    //   } else {
    //   }
    // }

    public function comment() {
        return $this->hasMany('App\Comment');
    }

    public static $rules = [
        'profile_image' => 'image|file'
    ];
    
  /**
    * パスワードリセット通知の送信
    *
    * @param string $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
      $this->notify(new ResetPassword($token));
    }
}
