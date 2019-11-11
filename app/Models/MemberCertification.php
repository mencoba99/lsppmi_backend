<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCertification extends Model
{
    protected $table = 'member_certification';

    public function schedules()
    {
    	return $this->belongsTo('App\Models\ProgramSchedule', 'program_schedule_id', 'id');
    }

    public function members()
    {
    	return $this->belongsTo('App\Models\Member', 'member_id', 'id');
    }

    public function apl01()
    {
    	return $this->hasMany('App\Models\MemberCertificationAPL01');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\MemberCertificationPayment');
    }
}
