<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Modul extends Model
{
      // use RevisionableTrait;
    //   use SoftDeletes;
	
      // protected $revisionCreationsEnabled = true;
      
      protected $table = 'modul';
  
      protected $fillable = [
          
          'id',
          'name',
          'price',
          'persentase',
          'sing_eng',
          'description',
          'status'
          
         
      ];

      public function submodul()
      {
          return $this->hasMany('App\Models\SubModul','id_modul','id');
      }

      public function mgt_program()
      {
          return $this->belongsTo('\App\Models\MgtProgram','id','modul_id');
      }

      public function modul_soal()
      {
          return $this->belongsTo('App\Models\Modul_soal','modul_id','id');
      }

      public function soal()
      {
          return $this->belongsTo('App\Models\Soal','id','modul_id');
      }
 }

