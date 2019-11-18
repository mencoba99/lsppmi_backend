<?php
namespace App\Models\StartUjian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Peserta_lulus extends Revisionable
{
    protected $table                    = 'peserta_lulus';
    public $primaryKey                  = 'peserta_lulus_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}