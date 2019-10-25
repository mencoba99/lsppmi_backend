<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Provinsi extends Model
{
    // use RevisionableTrait;
    use SoftDeletes;
	
	// protected $revisionCreationsEnabled = true;
	
    protected $table = 'provinsi';

    protected $fillable = [
        
        'nm_provinsi',
       
    ];

    // public function users()
    // {
    //     return $this->hasMany('App\User','slug_cabang','slug');
    // }
}
