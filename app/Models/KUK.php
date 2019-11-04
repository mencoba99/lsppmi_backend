<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Venturecraft\Revisionable\Revisionable;

class KUK extends Revisionable
{
   
     protected $revisionCreationsEnabled = true;
     
     protected $table = 'competence_kuk';

     public function element()
     {
         return $this->belongsTo('\App\Models\Element','competence_element_id','id');
     }
 
}
