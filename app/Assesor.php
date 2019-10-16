<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assesor extends Model
{
    protected $table = 'assesor';

    protected $fillable = ['name', 'email', 'telephone', 'institution', 'position', 'photo'];
}
