<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function units()
    {
    	return $this->belongsToMany('App\CompetenceUnit', 'program_competence_unit')->using('App\ProgramCompetenceUnit');
    }
}
