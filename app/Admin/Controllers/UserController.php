<?php
/**
 * Created by PhpStorm.
 * User: Valentine.Fang
 * Date: 2018/1/20
 * Time: 12:34
 */

namespace App\Admin\Controllers;


use App\AdminRole;
use Validator;
use App\AdminUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 后台全部管理人员
     */
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin/user/index', compact('users'));
    }

    public function create()
    {
        return view('admin/user/add');
    }

    /**
     * 创建后台管理人员
     */
    public function store()
    {
        //验证
        $this->validate(request(), [
            'name' => 'required|min:3|unique:admin_users,name',
            'password' => 'required|min:4'
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));
        \App\AdminUser::create(compact('name', 'password'));
        return redirect('/admin/users');
    }

    //获取用户信息
    public function edit(AdminUser $user)
    {
        return $user;
    }

    //修改用户信息
    public function update()
    {
        $this->validate(request(), [
            'name' => 'required|min:3|unique:admin_users,name',
            'uid' => 'required'
        ]);
        $user = AdminUser::find(request()->input('uid'));
        $user->name = request()->input('name');
        $user->save();
        return redirect('/admin/users');
    }

    //删除用户
    public function delete(AdminUser $user)
    {
        $user->delete();
        return response()->json([
            'code' => 0,
            'msg' => '删除成功',
            'data' => []
        ],200);
    }

    /**
     * 分配角色（实际上也是权限分配，用户与权限是一个远程关系）
     * @param AdminUser $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function grantRole(AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);
        $roles = AdminRole::find(request('roles'));
        $ownRoles = $user->roles;

        //筛选出需要添加的角色，避免重复添加
        $addRoles = $roles->diff($ownRoles);
        foreach ($addRoles as $role) {
            $user->grantRole($role);
        }

        //筛选出需要删除的角色，此次没有选中的角色
        $deleteRoles = $ownRoles->diff($roles);
        foreach ($deleteRoles as $role) {
            $user->deleteRole($role);
        }
        return redirect('admin/users');
    }

    /**
     * 角色权限
     * @param AdminUser $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function roles(AdminUser $user)
    {
        $roles = AdminRole::all();
        $myRoles = $user->roles;
        return view('admin/user/role', compact('roles', 'myRoles', 'user'));
    }

}