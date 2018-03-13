<?php
/**
 * Created by PhpStorm.
 * User: Valentine.Fang
 * Date: 2018/1/20
 * Time: 10:55
 */

namespace App\Admin\Controllers;


use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('/admin/login/index');
    }

    /**
     * 登录操作
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'password' => 'required|min:6|max:30',
        ]);

        $user = \request(['name', 'password']);
        if (true == Auth::guard('admin')->attempt([
                'name' => $request->input('name'), 'password' => $request->input('password')
            ])
        ) {
            return redirect('admin/home');
        }

        return \Redirect::back()->withErrors("用户名密码错误");
    }

    /**
     * 登出操作
     * @return string
     */
    public function logout()
    {
        Auth::guard("admin")->logout();
        return redirect('/admin/login');
    }
}