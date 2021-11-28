<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRegisRequest;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user, $role;

    function __construct(User $user, Roles $role)
    {
        $this->user = $user;
        $this->role = $role;
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
            return redirect('')->with('msg', 'Đăng nhập thất bại');
        }
    }

    function logOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    function adminIndex()
    {
        $users = $this->user->oldest()->paginate(10);
        return view('admin.user.index-user', compact('users'));
    }
    function adminViewsAddRole($id)
    {
        $users = $this->user->find($id);
        $roles = $this->role->get();
        return view('admin.user.profile-user', compact('users', 'roles'));
    }
    function adminCreateRole($id, Request $req)
    {
        $validate = Validator::make(
            $req->all(),
            [
                'role' => 'required',
            ],
            [
                'role.required' => 'Vui lòng nhập quyền user'
            ]
        );
        if ($validate->fails()) {
            return response()->json(
                [
                    'code' => 412,
                    'message' => $validate->errors()->toArray()
                ],
            );
        }

        try {
            $user = User::findOrFail($id);
            $user->roleuser()->sync($req->role);
            DB::commit();
            return response()->json(
                [
                    'code' => 200,
                    'message' =>  'Thêm vai trò người dùng thành công'
                ]
            );
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("message create Role_user =>>> " . $err->getMessage() . ' ==  Line ==>>  ' . $err->getLine());
            return response()->json(
                [
                    'code' => 404,
                    'message' => 'Thêm vai trò người dùng thất bại',
                ]
            );
        }
    }
}
