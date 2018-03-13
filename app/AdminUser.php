<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\AdminRole;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    protected $rememberTokenName = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 用户拥有的角色
     */
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_role_user', 'user_id', 'role_id')
            ->withPivot(['user_id', 'role_id']);
    }

    /**
     * 检测是否拥有某个角色
     * @param $roles
     * @return bool
     */
    public function isOwnRoles($roles)
    {
        return !!$roles->intersect($this->roles)->count();
    }

    /**
     * 检测是否拥有权限
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->isOwnRoles($permission->roles);
    }

    /**
     * 针对用户分配角色
     * @param $role
     * @return bool
     */
    public function grantRole($role)
    {
        return $this->roles()->save($role);
    }

    /**
     * 删除用户角色关联
     * @param $role
     * @return mixed
     */
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }
}
