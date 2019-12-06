<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class MemberCertificationPaap extends Revisionable
{
    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'member_certification_paap';

    protected $fillable = [
        'member_certification_id','member_id','pa_asesi', 'pa_tujuan_asesmen', 'pa_konteks_asesmen', 'pa_orang_relevan',
        'pa_tolak_ukur', 'metode_asesmen', 'mk_1', 'mk_2', 'mk_3', 'mk_4', 'asesor_id', 'validated_by', 'is_completed'
    ];
}
