<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Venturecraft\Revisionable\Revisionable;

class Provinsi extends Revisionable
{

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
	protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;

    protected $table = 'provinces';

    protected $fillable = [

        'name',

    ];

    // public function users()
    // {
    //     return $this->hasMany('App\User','slug_cabang','slug');
    // }
}
