<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Kategori extends Model
{
     // use RevisionableTrait;
    //  use SoftDeletes;
	
     // protected $revisionCreationsEnabled = true;
     
     protected $table = 'program_types';
 
     protected $fillable = [
         
         'code',
         'name',
         'description',
         'status',
         
        
     ];

     public function program()
     {
         return $this->belongsTo('\App\Models\Kategori','program_type_id','id');
     }
}
