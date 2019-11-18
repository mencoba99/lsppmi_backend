<?php
namespace App\Models\MasterData;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Venturecraft\Revisionable\Revisionable;
class Jam_kelas extends Revisionable
{
    public $table                       = 'jam';
    public $primaryKey                  = 'jam_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    public static function keIndonesia($tgl)
    {
        $dt = new Carbon($tgl);
        setlocale(LC_TIME, 'IND');
        
        return $dt->formatLocalized('%d %B %Y %H:%M:%S');
        // return $dt->diffForHumans(); for Humman
    }
}