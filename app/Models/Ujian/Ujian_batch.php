<?php
namespace App\Models\Ujian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class Ujian_batch extends Revisionable
{
    public $table                       = 'ujian_batch';
    public $primaryKey                  = 'ujian_batch_id';
    public $timestamps                  = false;
    protected $guarded                  = [''];
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    public function batch()
    {
        return $this->belongsTo('App\Models\batch\Batch', 'batch_id', 'batch_id');
    }
    
    public function perdana_jadwal()
    {
        return $this->hasOne('App\Models\ujian\Perdana_jadwal', 'perdana_jadwal_id', 'perdana_jadwal_id');
    }
    
}