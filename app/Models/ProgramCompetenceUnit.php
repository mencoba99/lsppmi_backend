<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramCompetenceUnit extends Pivot
{
	public $incrementing = true;
    protected $table = 'program_competence_unit';

    public function uk()
    {
    	return $this->belongsTo('App\Models\CompetenceUnit', 'competence_unit_id', 'id');
    }
}
