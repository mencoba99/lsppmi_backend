<?php
namespace App\Models\Ujian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Jenis extends Revisionable
{

    use SoftDeletes;
    public $table                       = 'ujian_jenis';
    public $primaryKey                  = 'ujian_jenis_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    
    public static function boot()
    {
        parent::boot();
    }
    public function ujian_plan()
    {
        return $this->hasOne('App\Models\ujian\Ujian_plan', 'ujian_jenis_id', 'ujian_jenis_id');
    }
}