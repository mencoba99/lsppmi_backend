<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetenceElement extends Model
{
    public function kuk()
    {
        return $this->hasMany('App\Models\CompetenceKUK');
	}

}
