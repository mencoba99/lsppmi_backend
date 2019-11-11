<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCertificationAPL01 extends Model
{
    protected $table = 'member_certification_apl_01';

    public function puk()
    {
    	return $this->belongsTo('App\Models\ProgramCompetenceUnit', 'program_competence_unit_id', 'id');
    }
}
