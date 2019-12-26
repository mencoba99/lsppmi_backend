<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Venturecraft\Revisionable\RevisionableTrait;

class MgtProgramKUK extends Pivot
{
    use RevisionableTrait;

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    public $incrementing = true;
    protected $primaryKey = 'id';

    protected $table = 'program_mgt_kuk';

    protected $fillable = [
        
        'name',
        'program_id',
        'modul_id',
        'submodul_id',
        'user_created',
        'status',
        
        
       
    ];


    public function kuk()
    {
    	return $this->belongsTo('App\Models\CompetenceKUK', 'submodul_id', 'id');
    }
}
