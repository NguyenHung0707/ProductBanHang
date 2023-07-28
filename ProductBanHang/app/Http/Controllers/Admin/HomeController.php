<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Const_;

class HomeController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $request){
        $Scredentials =[
            'email'=> $request->email,
            'password' => $request->password,
            'level' => [Constant::user_level_host, Constant::user_level_admin], //Tài khoản cấp độ host hoac admin
        ];

        $remember = $request->remember;

        if(Auth::attempt($Scredentials, $remember)){


            return redirect()->intended('admin'); //Mac dinh la :trang chu

        }else{
            return back()
                    ->with('notification', 'Error: Email or password is wrong ');
        }
    }

    public function logout(){
        Auth::logout();

        return redirect('admin/login');
    }
}
