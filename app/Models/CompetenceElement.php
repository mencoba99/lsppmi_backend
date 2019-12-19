<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetenceElement extends Model
{
    public function kuk()
    {
        return $this->hasMany('App\Models\CompetenceKUK');
    }
    
    public function units()
    {
        return $this->hasMany('App\Models\CompetenceUnit');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\CompetenceUnit','competence_unit_id','id');
    }


}
