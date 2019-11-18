<?php
namespace App\Models\StartUjian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Soal_peserta extends Revisionable
{
    protected $table = 'soal_peserta';
    public $primaryKey = 'soal_peserta_id';
    public $timestamps = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    
    public function ujian_modul()
    {
    	return $this->belongsTo('App\Models\Ujian\Ujian_modul', 'ujian_modul_id', 'ujian_modul_id');
    }
}