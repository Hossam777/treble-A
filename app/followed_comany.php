<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followed_comany extends Model
{
    //
    protected $table = 'folloewed_companies';
    protected $fillable = [
        'u_mail', 'f_mail',
    ];
}
