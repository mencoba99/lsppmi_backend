<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class TUK extends Revisionable
{
    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'competence_places';

    protected $fillable
        = [
            'regency_id', 'name', 'description', 'address', 'contact', 'latitude', 'longitude', 'status'
        ];

    public function regency()
    {
        return $this->hasOne('App\Models\Kota', 'id', 'regency_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }
}
