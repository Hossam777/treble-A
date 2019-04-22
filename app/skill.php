<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skill extends Model
{
    //
    protected $table = 'u_skills';
    protected $fillable = [
        'u_mail', 'skill', 'score',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
