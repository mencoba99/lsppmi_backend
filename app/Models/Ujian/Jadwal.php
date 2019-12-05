<?php
namespace App\Models\Ujian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Jadwal extends Revisionable
{
    public $table                       = 'perdana_jadwal';
    public $primaryKey                  = 'perdana_jadwal_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    public function perdana()
    {
        return $this->belongsTo('App\Models\Ujian\Perdana', 'perdana_id', 'perdana_id');
    }

    // public function ujian_batch()
    // {
    //     return $this->hasMany('App\Models\ujian\Ujian_batch', 'perdana_jadwal_id', 'perdana_jadwal_id');
    // }
    public function pengawas()
    {
        return $this->belongsTo('App\User', 'emp_id', 'id');
    }
    public function hari()
    {
        return $this->belongsTo('App\Models\MasterData\Hari', 'hari_id', 'hari_id');
    }
    public function jam()
    {
        return $this->belongsTo('App\Models\MasterData\Jam_kelas', 'jam_id', 'jam_id');
    }
}