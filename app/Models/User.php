<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
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

    public function isAdmin(){
        return $this->role;
    }

    public function avatar($preview=true){
        if(!empty($this->avatar)){
            $avatar = Media::find($this->avatar);
            if (!empty($avatar->id)) {
                if($preview == true){
                    return $avatar->preview;
                }
                return $avatar->url;
            }
        }
        return config('app.avatar');
    }
}
