<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\Revisionable;

class Soal extends Revisionable
{
    public $table                       = 'soal';
    public $primaryKey                  = 'soal_id';
    public $timestamps                  = false;
    protected $revisionCreationsEnabled = true;
    
    public static function boot()
    {
        parent::boot();
    }
    
    public function select_by_parent($id)
    {
    	$data = $this::where('parent',$id)->get();
    	
    	return $data;
    }
    public function select_id($id)
    {
    	return $this::where('soal_id', $id)->first();
    }
    public function induk()
    {
    	$data = $this->parent;
    	if(!empty($data))
    		return true;
    	return false;
    }
    public function anak($id)
    {
    	return $this::where('parent', $id)->get();
    }
    public function paparent()
    {
    	$ortu = $this->parent;
    	if($ortu)
    	{
    		return $ortu;
    	}
    	else
    	{
    		return false;
    	}
    }
    public function ortu($id)
    {
    	$data = $this::where('parent', $id)->get();
    	return $data;
    }
    public function bapak($id)
    {
    	$data = $this::where('soal_id', $id)->first();
    	return $data;
    }

    public function modul_soal()
    {
        return $this->hasMany('App\Models\Modul_soal','soal_id','soal_id');
    }

    public function modul()
    {
        return $this->hasMany('App\Models\Modul','id','modul_id');
    }

    public function submodul()
    {
        return $this->hasMany('App\Models\SubModul','id','submodul_id');
    }

    
    
}
