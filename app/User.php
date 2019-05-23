<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
// use Laratrust\Models\LaratrustRole;
// use Laratrust\Models\LaratrustPermission;
// use Laratrust\Models\LaratrustTeam
;
class User extends Authenticatable
{
    
    use Notifiable , LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type','name', 'company_id', 'department_id' ,'status', 'email','dob_or_orgid','phone','mobile','email_verified_at', 'password',
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

      /**
     * Get the usermeta record associated with the user.
     */
    public function usermeta()
    {
        return $this->hasOne('App\Models\UserMeta');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Models\Languages', 'user_languages', 
        'user_id', 'lang_id');
    }
}
