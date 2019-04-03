<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    //
    protected $table = 'companies';
    protected $fillable = [
        'u_mail', 'username', 'password','f_name','l_name','age','gender','f_o_i_1','f_o_i_2','f_o_i_3','f_o_i_4','f_o_i_5',
    ];
    protected $hidden = [
        'password',
    ];
}
