<?php

namespace App\Models;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel

{
    public $guarded = [];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
