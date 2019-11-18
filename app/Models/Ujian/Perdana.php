<?php
namespace App\Models\Ujian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Perdana extends Revisionable
{
    public $table                       = 'perdana';
    public $primaryKey                  = 'perdana_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    public function perdana_jadwal()
    {
        return $this->hasMany('App\Models\Ujian\Perdana_jadwal', 'perdana_id', 'perdana_id');
    }
    public function ruang()
    {
        return $this->belongsTo('App\Models\TUK', 'tuk_id', 'id');
    }
}