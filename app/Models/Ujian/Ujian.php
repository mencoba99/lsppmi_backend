<?php
namespace App\Models\Ujian;
use Venturecraft\Revisionable\Revisionable;
class Ujian extends Revisionable
{
    protected $table                    = 'ujian';
    public $primaryKey                  = 'ujian_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}