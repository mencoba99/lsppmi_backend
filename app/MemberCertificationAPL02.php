<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberCertificationAPL02 extends Model
{
	public $table = 'member_certification_apl_02';
    protected $fillable = [
    	'member_certification_id',
    	'competence_kuk_id',
    	'is_competent',
    	'proof',
    	'status',
    ];
}
