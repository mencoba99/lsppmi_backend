<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class MgtProgram extends Model
{
    // use SoftDeletes;
	
    // protected $revisionCreationsEnabled = true;
    
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
        return $this->hasMany('App\Models\Program','id','program_id');
    }

    public function modul()
    {
        return $this->hasMany('App\Models\Modul','id','modul_id');
    }

    public function submodul()
    {
        return $this->hasMany('App\Models\SubModul','id','submodul_id');
    }

    


}
