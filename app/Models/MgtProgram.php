<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class MgtProgram extends Model
{
    use SoftDeletes;
	
    // protected $revisionCreationsEnabled = true;
    
    protected $table = 'program_type';

    protected $fillable = [
        
        'code',
        'name',
        'description',
        
       
    ];
}