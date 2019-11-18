<?php
namespace App\Models\MasterData;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class Virtual_account extends Revisionable
{
    public $table                       = 'virtual_account';
    public $primaryKey                  = 'va_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
}