<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\Revisionable;

class ProgramSchedule extends Revisionable
{
    use SoftDeletes;

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'program_schedules';

    protected $fillable = [
        'token', 'program_id', 'competence_place_id', 'price', 'min_participants', 'max_participants', 'training_duration',
        'exam_duration', 'started_at', 'is_hidden', 'is_approve', 'date_approve', 'approved_by', 'is_publish', 'date_publish',
        'status', 'date_closed', 'closed_by', 'remark','ujian_parameter_id', 'registration_closed', 'date_registration_closed'
    ];

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approve', 1);
    }

    public function programs()
    {
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    }

    public function assessor()
    {
        return $this->belongsToMany('App\Models\Assessor','program_schedule_assessor','program_schedule_id','assessor_id')->using('App\Models\ProgramScheduleAssessor');
    }

    public function tuk()
    {
        return $this->belongsTo('App\Models\TUK', 'competence_place_id', 'id');
    }

    public function pendaftar()
    {
        return $this->hasMany('App\Models\MemberCertification');
    }

    public function paap()
    {
        return $this->hasOne('App\Models\ProgramSchedulePaap');
    }
}
