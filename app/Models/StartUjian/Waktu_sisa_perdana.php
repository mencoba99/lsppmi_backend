<?php
namespace App\Models\StartUjian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Waktu_sisa_perdana extends Revisionable
{
    protected $table                    = 'waktu_sisa_perdana';
    public $primaryKey                  = 'waktu_sisa_perdana_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}