<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = AdminRole::paginate(10);
        return view('/admin/role/index', compact('roles'));
    }

    public function create()
    {
        return view('/admin/role/add');
    }

    /**
     * 创建新的角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required',
        ]);

        \App\AdminRole::create(request(['name', 'description']));
        return redirect('/admin/roles');
    }

    public function edit(AdminRole $role)
    {
        return $role;
    }

    public function update()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required',
            'id' => 'required'
        ]);
        $role = AdminRole::find(\request()->input('id'));
        $role->update(\request()->input());
        return redirect('admin/roles');
    }

    /**
     * 全部权限与该角色拥有权限
     * @param AdminRole $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function permission(AdminRole $role)
    {
        $permissions = AdminPermission::all();
        $myPermissions = $role->permissions;
        return view('admin/role/permission', compact('permissions', 'myPermissions', 'role'));
    }

    /**
     * 赋予角色权限
     * @param AdminRole $role (array)$permissions
     * @return \Illuminate\Http\JsonResponse
     */
    public function grantPermission(AdminRole $role)
    {
        $this->validate(request(), [
            'permissions' => 'required|array'
        ]);
        $permissions = AdminPermission::find(request('permissions'));
        $ownPermissions = $role->permissions;

        //筛选出需要添加进去的权限
        $addPermissions = $permissions->diff($ownPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }

        //筛选出需要删除的权限
        $deletePermissions = $ownPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return redirect('admin/roles');
    }

}
