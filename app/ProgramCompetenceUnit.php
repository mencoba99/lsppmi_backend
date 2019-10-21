<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramCompetenceUnit extends Pivot
{
	public $incrementing = true;
    protected $table = 'program_competence_unit';
}
