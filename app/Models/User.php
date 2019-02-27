<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Auth;
class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmailTrait;
    use Notifiable{
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        if($this->id==Auth::id()){
            return;
        }

        if(method_exists($instance,'toDatabase')){
            $this->increment('notification_count');
        }
        $this->laravelNotify($instance);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function topics(){
        return $this->hasMany(Topic::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
