<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followed_user extends Model
{
    //
    protected $table = 'followed_users';
    protected $fillable = [
        'u_mail', 'f_mail',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
