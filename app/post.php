<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = [
        'p_id', 'u_mail', 'p_text','privacy','vote',
    ];
}
