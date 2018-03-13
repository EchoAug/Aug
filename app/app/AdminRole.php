<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdminPermission;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    protected $guarded = [];

    /**
     * 获取当前角色所有权限
     */
    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_permission_role', 'permission_id', 'role_id')
            ->withPivot(['permission_id', 'role_id']);
    }

    /**
     * 针对角色进行授权
     * @param $permission
     * @return bool
     */
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * 删除角色与权限的关联
     * @param $permission
     * @return mixed
     */
    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    /**
     * 检测用户是否拥有权限
     * @param $permission
     * @return mixed
     */
    public function hasPermission($permission)
    {
        return $this->hasPermission($permission);
    }
}
