<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRegisRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginRegisterController extends Controller
{
    private $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    function index()
    {
        return view('auth.user_login');
    }

    function create()
    {
        return view('auth.user-register');
    }

    function store(LoginRegisRequest $req)
    {
        try {
            $this->user->create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => bcrypt($req->password),
            ]);
            return redirect('register')->with('msg', 'Đăng ký thành công ');
        } catch (\Exception $err) {
            Log::error("Register Add => " . $err->getMessage() . " Line => " . $err);
        }
    }

    function account(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'password.required' => 'Vui lòng nhập password'
            ]
        );
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect()->route('menu.index');
        } else {
            return redirect('login')->with('msg', 'Đăng nhập thất bại');
        }
    }

    function logOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
