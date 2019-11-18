<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Venturecraft\Revisionable\Revisionable;

class Element extends Revisionable
{
   
     protected $revisionCreationsEnabled = true;
     
     protected $table = 'competence_elements';

     public function units()
     {
         return $this->belongsTo('\App\Models\Units','competence_unit_id','id');
     }
 
}
