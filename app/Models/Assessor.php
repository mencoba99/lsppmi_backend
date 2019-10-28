<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessor extends Model
{
    use SoftDeletes;

    protected $casts = [
        'assessment_ability' => 'array'
    ];

    protected $fillable = [
        'name', 'email' , 'profile', 'mobile_phone', 'company', 'position', 'status', 'assessment_ability'
    ];
}
