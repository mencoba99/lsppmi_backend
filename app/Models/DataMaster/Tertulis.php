<?php
namespace App\Models\DataMaster;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class Tertulis extends Revisionable
{
    public $table                       = 'pertanyaan_tertulis';
    public $primaryKey                  = 'id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }

    protected $fillable
        = [
            'id', 'unit_id', 'tuk_id','element_id','kuk_id', 'pertanyaan', 'jawaban','status'
        ];

   
    public function unit()
    {
    	return $this->belongsTo('App\Models\CompetenceUnit', 'unit_id', 'id');
    }

    public function element()
    {
    	return $this->belongsTo('App\Models\Element', 'element_id', 'id');
    }

    public function kuk()
    {
    	return $this->belongsTo('App\Models\KUK', 'kuk_id', 'id');
    }

    public function tuk()
    {
    	return $this->belongsTo('App\Models\TUK', 'tuk_id', 'id');
    }
}