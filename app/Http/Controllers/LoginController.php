<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.form_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::attempt($infologin))
        {
            //dd(Auth::user()->usr_role);

            if(Auth::user()->usr_role == 'admin'){
                return redirect('/dashboardAdmin');
            } elseif(Auth::user()->usr_role == 'karyawan'){
                return redirect('/dashboardKaryawan');
            }
                  
        }else{
                   
            return redirect('')->withErrors('Username n password tidak sesuai')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}
