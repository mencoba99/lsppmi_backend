<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberCertification extends Model
{
    protected $table = 'member_certification';

    public function schedules()
    {
    	return $this->belongsTo('App\ProgramSchedule', 'program_schedule_id', 'id');
    }
}
