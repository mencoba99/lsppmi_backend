<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class Komposisi_soal extends Revisionable
{
    public $table                       = 'komposisi_soal';
    public $primaryKey                  = 'komposisi_soal_id';
    public $timestamps                  = false;
    protected $guarded                  = [''];
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    public function program_dtl()
    {
        return $this->hasOne('App\Models\program_management\MgtProgram', 'program_dtl_id', 'id')->where('status', 1);
    }

    
    public function jenis_Soal()
    {
        return $this->hasOne('App\Models\management_materi\SoalJenis', 'jenis_soal_id', 'id');
    }
}