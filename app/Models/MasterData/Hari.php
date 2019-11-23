<?php
namespace App\Models\MasterData;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;
class Hari extends Revisionable
{
    public $table                       = 'hari';
    public $primaryKey                  = 'hari_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}