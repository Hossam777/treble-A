<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    //
    protected $table = 'p_replies';
    protected $fillable = [
        'p_id', 'u_mail', 'r_text',
    ];
}
