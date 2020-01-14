<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\Revisionable;

class ProgramSchedulePaap extends Revisionable
{
    use SoftDeletes;

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $casts
        = [
            'pa_asesi'           => 'json',
            'pa_konteks_asesmen' => 'json',
            'pa_orang_relevan'   => 'json',
        ];

    protected $table = 'program_schedule_paap';

    protected $fillable
        = [
            'program_schedule_id', 'pa_asesi', 'pa_tujuan_asesmen', 'pa_konteks_asesmen', 'pa_orang_relevan',
            'pa_tolak_ukur', 'metode_asesmen', 'mk_1', 'mk_2', 'mk_3', 'mk_4', 'asesor_id', 'validated_by', 'is_completed'
        ];

    public function program_schedule()
    {
        return $this->belongsTo('App\Models\ProgramSchedule');
    }
}
