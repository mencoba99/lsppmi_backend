<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class CompetenceUnit extends Revisionable
{
    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $fillable = [
            'code', 'name', 'status', 'type'
        ];

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
