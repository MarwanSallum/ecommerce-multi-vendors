<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
    public function login(){
        return view('dashboard.auth.login');
    }

    public function postLogin(AdminLoginRequest $requst){
        $remember_me = $requst->has('remember_me') ? true : false;
        if(auth() -> guard('admin') -> attempt(['email' => $requst -> input('email'), 'password' => $requst -> input('password')], $remember_me)){
            return redirect() -> route('dashboard');
        }
        return redirect()->back() -> with(['error' => 'هناك خطأ بالبيانات']);
    }
}
