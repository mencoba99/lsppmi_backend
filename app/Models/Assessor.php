<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\Revisionable;

class Assessor extends Revisionable
{
    use SoftDeletes;

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'assessors';

    protected $casts = [
        'assessment_ability' => 'array'
    ];

    protected $fillable = [
        'name', 'email' , 'profile', 'mobile_phone', 'company', 'position', 'status', 'assessment_ability'
    ];

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }
}
