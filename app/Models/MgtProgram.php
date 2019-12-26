<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class MgtProgram extends Model
{
    use SoftDeletes;
	
    protected $revisionCreationsEnabled = true;
    
    protected $table = 'program_mgt';

    protected $fillable = [
        
        'name',
        'program_id',
        'modul_id',
        'submodul_id',
        'user_created',
        
        
       
    ];

    public function program()
    {
        return $this->belongsTo('App\Models\Program','program_id','id');
    }

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul','modul_id','id');
    }

    public function submodul()
    {
        return $this->hasMany('App\Models\SubModul','id','submodul_id');
    }

    // public function submodul()
    // {
    //     return $this->belongsTo('App\Models\CompetenceKUK','id','submodul_id');
    // }

    public function mgt_kuk()
    {
        return $this->belongsToMany('App\Models\CompetenceKUK', 'program_mgt_kuk','program_id','submodul_id')->using('App\Models\MgtProgramKUK');

    }

    
    


}
