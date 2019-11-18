<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Modul extends Model
{
    public $table                       = 'modul';
    public $primaryKey                  = 'id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }

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

