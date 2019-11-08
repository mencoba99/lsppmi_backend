<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Venturecraft\Revisionable\RevisionableTrait;

class ProgramCompetenceUnit extends Pivot
{
    use RevisionableTrait;

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

	public $incrementing = true;

    protected $table = 'program_competence_unit';

    protected $fillable = [
        'program_id', 'competence_unit_id', 'is_required'
    ];
}
