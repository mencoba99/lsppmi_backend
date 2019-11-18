<?php
namespace App\Models\StartUjian;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Waktu_persoal extends Revisionable
{
    protected $table                    = 'waktu_persoal';
    public $primaryKey                  = 'waktu_persoal_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}