<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class SoalJenis extends Model
{
     // use RevisionableTrait;
    //  use SoftDeletes;
	
     // protected $revisionCreationsEnabled = true;
     
     protected $table = 'soal_jenis';
 
     protected $fillable = [
         
         'name'
         
        
     ];
}
