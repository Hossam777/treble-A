<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    //
    protected $table = 'quizez_resolved';
    protected $fillable = [
        'u_mail', 'q_id',
    ];
}
