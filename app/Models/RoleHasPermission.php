<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    protected $connection = 'mysql1';
    protected $collection = 'role_has_permissions';

    protected $fillable = [
        'permission_id', 'role_id'
    ];

}
