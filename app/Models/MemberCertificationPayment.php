<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class MemberCertificationPayment extends Revisionable
{
    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'member_certification_payments';
    protected $guarded = [];

    public function certification()
    {
    	return $this->belongsTo('App\Models\MemberCertification', 'member_certification_id', 'id');
    }
}
