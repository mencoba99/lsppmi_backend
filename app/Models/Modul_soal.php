<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Modul_soal extends Revisionable
{
    public $table                       = 'modul_soal';
    public $primaryKey                  = 'modul_soal_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    
    public function soal_get_id($id)
    {
        $Pembuatan_soal = Pembuatan_soal::where('soal_id', $id)->get();
        return $Pembuatan_soal;
    }

    public function soal()
    {
        return $this->belongsTo('App\Models\Soal','soal_id','soal_id');
    }

    public function modul()
    {
        return $this->hasMany('App\Models\Modul','id','modul_id');
    }

    public function submodul()
    {
        return $this->hasMany('App\Models\SubModul','submodul_id','id');
    }

    
}