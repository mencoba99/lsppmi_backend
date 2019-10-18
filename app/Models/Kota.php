<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Kota extends Model
{
     // use RevisionableTrait;
     use SoftDeletes;
	
     // protected $revisionCreationsEnabled = true;
     
     protected $table = 'kota';
 
     protected $fillable = [
         
         'nm_kota',
         'id_provinsi',
        
     ];

      public function provinsi()
    {
        return $this->belongsTo('\App\Models\Provinsi','id_provinsi','id');
    }
}
