<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidate_form extends Model
{
    //
    protected $table = 'candidates_form';
    protected $fillable = [
        'v_id', 'u_mail', 'a',
    ];
    
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
