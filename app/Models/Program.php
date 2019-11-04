<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Venturecraft\Revisionable\Revisionable;

class Program extends Revisionable
{

     protected $revisionCreationsEnabled = true;

     protected $table = 'programs';

     protected $fillable = [

         'code',
         'name',
         'description',
         'type',
         'status',
         'program_type_id',
         'sing_ind',
         'sing_int',
         'harga',
         'level',


     ];

     public function kategori()
    {
        return $this->belongsTo('\App\Models\Kategori','program_type_id','id');
    }

     public function mgt_program()
    {
        return $this->belongsTo('\App\Models\MgtProgram','id','program_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

}
