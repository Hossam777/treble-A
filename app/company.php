<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    //
    protected $table = 'companies';
    protected $fillable = [
        'c_mail', 'c_password', 'name','f_o_i_1','f_o_i_2','f_o_i_3','f_o_i_4','f_o_i_5'];
    protected $hidden = [
        'c_password',
    ];
}
