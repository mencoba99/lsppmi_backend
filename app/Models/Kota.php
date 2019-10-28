<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Venturecraft\Revisionable\Revisionable;

class Kota extends Model
{
   
     protected $revisionCreationsEnabled = true;
     
     protected $table = 'regencies';
 
     protected $fillable = [
         
         'name',
         'province_id',
        
     ];

      public function provinsi()
    {
        return $this->belongsTo('\App\Models\Provinsi','province_id','id');
    }
}
