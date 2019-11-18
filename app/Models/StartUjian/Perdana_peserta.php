<?php
namespace App\Models\StartUjian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Perdana_peserta extends Revisionable
{
    protected $table = 'perdana_peserta';
    public $primaryKey = 'perdana_peserta_id';
    public $timestamps = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    
    public function ujian_batch()
    {
    	return $this->belongsTo('App\Models\Ujian_batch', 'ujian_batch_id', 'ujian_batch_id');
    }
}