<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionModel extends Permission
{
    public function children()
    {
        return $this->hasMany('App\Models\PermissionModel', 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Permission', 'parent_id', 'id');
    }
}
