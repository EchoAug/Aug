<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use Validator;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use \App\Util\Tree;

    public function index()
    {
        $permissions = AdminPermission::paginate(10);
        return view('/admin/permission/index', compact('permissions'));
    }

    public function create()
    {
        $permissions = AdminPermission::all();
        $permissions = $this->obj2LevelTree($permissions);
        return view('/admin/permission/add',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|min:2',
            'title' => 'required',
            'description' => 'required|max:500',
            'pid' => 'required|numeric'
        ]);

        AdminPermission::create([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'pid' => $request->input('pid'),
        ]);
        return redirect('admin/permissions');
    }

}
