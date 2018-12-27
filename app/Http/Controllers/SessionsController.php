<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SessionsController extends Controller
{
    public function __construct() {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create() {
        return view('sessions.create');
    }

    public function store(Request $request) {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->activated) {
                session()->flash('success', '欢迎回来');
                $path = route('users.show', [Auth::user()]);
                return redirect()->intended($path);
            } else {
                Auth::logout();
                session()->flash('warning', '您的账号尚未激活,请到您的注册邮箱进行确认');
                return redirect('/');
            }

        } else {
            session()->flash('danger', '对不起,您的账号或密码错误');
            return redirect()->back()->withInput();
        }
    }

    public function destroy() {
        Auth::logout();
        session()->flash('success', '退出成功');
        return redirect()->route('login');
    }


}
