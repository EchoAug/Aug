<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdminRole;

class AdminPermission extends Model
{
    protected $guarded = [];

    /**
     * 拥有此权限的角色
     * @return $this
     */
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_permission_role', 'role_id', 'permission_id')
            ->withPivot(['permission_id', 'role_id']);
    }
}
