<?php
namespace App\Models\Ujian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Ujian_modul extends Revisionable
{
    public $table                       = 'ujian_modul';
    public $primaryKey                  = 'ujian_modul_id';
    public $timestamps                  = false;
    protected $guarded                  = [''];
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    public function ujian_batch()
    {
        return $this->belongsTo('App\Models\ujian\Ujian_batch', 'ujian_batch_id', 'ujian_batch_id');
    }
    
    public function batch_modul()
    {
    	return $this->belongsTo('App\Models\Ujian\Batch_modul_dtl', 'modul_id', 'modul_id');
    }

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'modul_id', 'id');
    }
    public function submodul()
    {
        return $this->belongsTo('App\Models\SubModul', 'submodul_id', 'id');
    }
    
}