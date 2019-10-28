<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramSchedule extends Model
{
    protected $table = 'program_schedules';

    public function programs()
    {
    	return $this->belongsTo('App\Program', 'program_id', 'id');
    }
}
