<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function units()
    {
    	return $this->belongsToMany('App\CompetenceUnit', 'program_competence_unit')->using('App\ProgramCompetenceUnit');
    }

    /**
     * Scope untuk ambil semua program yang aktif
     * Usage : $program = Program::active()->get();
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status',1);
    }
}
