<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class MemberCertificationRekaman extends Revisionable
{
    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'member_certification_rekaman';

    protected $fillable = ['member_certification_id', 'rekomendasi_asesor', 'tindak_lanjut', 'komentar_asesor'];

    protected $casts = [
        'tindak_lanjut' => 'json',
        'komentar_asesor' => 'json'
    ];

    public function member_certification()
    {
        return $this->belongsTo('App\Models\MemberCertification');
    }

}
