<?php

namespace App\Service;

use App\Http\Requests\LoginRegisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{

    public function indexViewLoginUser()
    {
        if (Auth::check()) {
            return redirect()->route('customer.home');
        }
        return view('auth.user_login');
    }

    public function LoginAccountUser(LoginRegisRequest $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password], true)) {
            return response()->json(
                [
                    'code' => 200,
                    'url' => route('customer.home'),
                ],
            );
        }
    }

    public function LogoutAcoountUser(Request $req)
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
