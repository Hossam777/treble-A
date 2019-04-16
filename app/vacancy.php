<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vacancy extends Model
{
    //
    protected $table = 'vacancies';
    
    protected $fillable = [
        'v_id', 'c_mail', 'title','description','requirments','benifits','salary','type',
    ];
}
