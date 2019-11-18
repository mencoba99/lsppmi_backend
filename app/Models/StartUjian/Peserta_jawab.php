<?php
namespace App\Models\StartUjian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Peserta_jawab extends Revisionable
{
    protected $table   = 'peserta_jawab';
    public $primaryKey = 'peserta_jawab_id';
    public $timestamps = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    
    public function soalUjian()
    {
    	return $this->belongsTo('App\Models\Soal', 'soal_id', 'soal_id');
    }
}