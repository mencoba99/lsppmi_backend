<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class Pendaftaran_trx extends Revisionable
{
    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table                    = 'pendaftaran_trx';
    public    $primaryKey               = 'pendaftaran_trx_id';
    public    $timestamps               = false;

    protected $fillable = [
        'pendaftaran_id', 'peserta_aktivasi_id', 'batch_id', 'nama_batch', 'no_batch', 'peserta_id',
        'nama_peserta', 'tgl_daftar', 'harga_pendaftaran'
    ];
}
