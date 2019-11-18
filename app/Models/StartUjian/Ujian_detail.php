<?php
namespace App\Models\StartUjian;
use Venturecraft\Revisionable\Revisionable;
class Ujian_detail extends Revisionable
{
    protected $table                    = 'ujian_detail';
    public $primaryKey                  = 'ujian_detail_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}