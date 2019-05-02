<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class company extends Authenticatable
{
    //
    use HasApiTokens, Notifiable;
    protected $guard = 'company';
    protected $table = 'companies';
    protected $primaryKey = 'c_mail';
    protected $casts = ['c_mail' => 'string'];
    protected $fillable = [
        'c_mail', 'c_password', 'name','f_o_i_1','f_o_i_2','f_o_i_3','f_o_i_4','f_o_i_5'];
    protected $hidden = [
        'c_password',
    ];
}
