<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCertificationPayment extends Model
{
    protected $table = 'member_certification_payments';
    protected $guarded = [];

    public function certification()
    {
    	return $this->belongsTo('App\Models\MemberCertification', 'member_certification_id', 'id');
    }
}
