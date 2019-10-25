<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class SubModul extends Model
{
     // use RevisionableTrait;
     use SoftDeletes;
	
     // protected $revisionCreationsEnabled = true;
     
     protected $table = 'submodul';
 
     protected $fillable = [
         
         'id_modul',
         'name',
         'description',
         'status'
         
        
     ];

     public function modul()
    {
        return $this->belongsTo('App\Models\Modul','id_modul','id');
    }

    public function program_mgt()
    {
        return $this->belongsTo('App\Models\MgtProgram','submodul_id','id');
    }

    public function modul_soal()
    {
        return $this->belongsTo('App\Models\Modul_soal','submodul_id','id');
    }
}
