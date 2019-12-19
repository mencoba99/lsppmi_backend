<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// revision log
use Venturecraft\Revisionable\Revisionable;
class Batch_modul_dtl extends Revisionable
{
    public $table       = 'batch_modul_dtl';
    public $primaryKey  = 'batch_modul_dtl_id';
    public $timestamps  = false;
    // revision log
    protected $revisionCreationsEnabled = true;
    public static function boot()
    {
        parent::boot();
    }
}