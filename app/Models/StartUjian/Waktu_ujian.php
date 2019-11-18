<?php
namespace App\Models\StartUjian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Waktu_ujian extends Revisionable
{
    protected $table                    = 'waktu_ujian';
    public $primaryKey                  = 'waktu_ujian_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}