<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class application_form extends Model
{
    //
    protected $table = 'application_form';
    protected $fillable = [
        'v_id', 'q', 
    ];
}
