<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetenceKUK extends Model
{
    protected $table = 'competence_kuk';

    public function element()
    {
        return $this->belongsTo('App\Models\CompetenceElement','competence_element_id','id');
    }

    // public function mgt()
    // {
    //     return $this->belongsToMany('App\Models\MgtProgram','id','submodul_id');
    // }

    public function mgt()
    {
        return $this->hasMany('App\Models\MgtProgram','id','submodul_id');
    }
}
