<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class MemberCertification extends Revisionable
{

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'member_certification';

    protected $guarded = [];
    // protected $fillable = [
    //     'member_id','program_schedule_id','payment_method_id','payment_file','status','is_paid','assessor_id',
    //     'done_assesment','recommendation_asesor','assessor_id','approve_assessor','date_approved_assessor','approved_assessor_by'
    // ];

    /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schedules()
    {
    	return $this->belongsTo('App\Models\ProgramSchedule', 'program_schedule_id', 'id');
    }

    /**
     * Relation to model members
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function members()
    {
    	return $this->belongsTo('App\Models\Member', 'member_id', 'id');
    }

    public function apl01()
    {
    	return $this->hasMany('App\Models\MemberCertificationAPL01');
    }

    public function apl02()
    {
        return $this->hasMany('App\Models\MemberCertificationAPL02');
    }

    public function paap()
    {
        return $this->hasOne('App\Models\MemberCertificationPaap', 'member_certification_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\MemberCertificationPayment');
    }

    public function assessor()
    {
        return $this->belongsTo('App\Models\Assessor');
    }

    public function interview()
    {
        return $this->hasMany('App\Models\MemberCertificationInterview');
    }

    public function rekaman()
    {
        return $this->hasOne('App\Models\MemberCertificationRekaman', 'member_certification_id', 'id');
    }
}
