<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class MemberCertificationInterview extends Revisionable
{
    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'member_certification_interview';

    protected $fillable = ['member_certification_id', 'pertanyaan_id', 'kesimpulan', 'urutan'];

    public function member_certification()
    {
        return $this->belongsTo('App\Models\MemberCertification');
    }

    public function pertanyaan_lisan()
    {
        return $this->belongsTo('App\Models\DataMaster\Lisan');
    }

    public function pertanyaan_tertulis()
    {
        return $this->belongsTo('App\Models\DataMaster\Tertulis');
    }
}
