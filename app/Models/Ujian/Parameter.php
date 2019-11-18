<?php
namespace App\Models\Ujian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Parameter extends Revisionable
{

    use SoftDeletes;
    public $table                       = 'ujian_parameter';
    public $primaryKey                  = 'ujian_parameter_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    
    public static function boot()
    {
        parent::boot();
    }
   
    public function batch()
    {
        return $this->hasOne('App\Models\ProgramSchedule', 'id', 'program_schedule_id');
    }
}