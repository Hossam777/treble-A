<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'u_mail';
    protected $fillable = [
        'u_mail', 'username', 'password','f_name','l_name','age','gender','f_o_i_1','f_o_i_2','f_o_i_3','f_o_i_4','f_o_i_5',
    ];

    protected $hidden = [
        'password','remember_token',
    ];

}
