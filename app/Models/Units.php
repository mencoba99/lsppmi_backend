<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Venturecraft\Revisionable\Revisionable;

class Units extends Revisionable
{
   
     protected $revisionCreationsEnabled = true;
     
     protected $table = 'competence_units';

     public function type()
     {
         return $this->belongsTo('\App\Models\Kategori','type','id');
     }

    //  public function units()
    //  {
    //      return $this->hasMany('\App\Models\Units','competence_unit_id','id');
    //  }
 
}
