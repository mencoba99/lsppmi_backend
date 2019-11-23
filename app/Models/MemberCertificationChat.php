<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class MemberCertificationChat extends Revisionable
{

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'member_certification_chat';

    public function scopeApl02Chat($query, $member_certification_id, $member_id = null)
    {
//        $result = $query->where('member_certification_id', $member_certification_id);
        if (!empty($member_id)) {
            return $query->where(function ($q) use ($member_certification_id, $member_id) {
                $q->where('member_certification_id', $member_certification_id)->where('member_id', $member_id);
            });
        }

        return $query->where('member_certification_id', $member_certification_id);
    }

    public function asesor()
    {
        return $this->belongsTo('App\Models\Assessor');
    }
}
