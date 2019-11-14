<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Venturecraft\Revisionable\RevisionableTrait;

class ProgramScheduleAssessor extends Pivot
{
    use RevisionableTrait;

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'program_schedule_assessor';

    public $incrementing = true;

    protected $fillable = [
        'program_schedule_id', 'assessor_id'
    ];
}
