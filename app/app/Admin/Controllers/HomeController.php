<?php
/**
 * Created by PhpStorm.
 * User: Valentine.Fang
 * Date: 2018/3/10
 * Time: 11:12
 */

namespace App\Admin\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return view('/admin/home/index');
    }
}