<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetenceUnit extends Model
{
    public function programs()
    {
    	return $this->belongsToMany('App\Program', 'program_competence_unit')->using('App\ProgramCompetenceUnit');
    }

    public function elements()
    {
    	return $this->hasMany('App\CompetenceElement');
    }

    public function kuk()
    {
    	return $this->hasManyThrough(
    		'App\CompetenceKUK', 
    		'App\CompetenceElement',
    		'competence_unit_id',
    		'competence_element_id',
    		'id',
    		'id'
    	);
    }
}
