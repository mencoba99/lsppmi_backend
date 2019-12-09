<?php
namespace App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
use App\Models\Members;

class Pendaftaran_trx extends Revisionable
{
    public $table                       = 'pendaftaran_trx';
    public $primaryKey                  = 'pendaftaran_trx_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    public function namaPeserta($id)
    {
    	$data = Members::where('peserta_id', $id)->first();
    	return $data->nama;
    }
    public function email($id)
    {
    	$data = Members::where('peserta_id', $id)->first();
    	return $data->email;
    }
}