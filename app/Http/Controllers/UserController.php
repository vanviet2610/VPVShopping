<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRegisRequest;
use App\Models\Roles;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function index()
    {
        return $this->userService->indexViewLoginUser();
    }

    function create()
    {
        return view('auth.user-register');
    }

    public function login(LoginRegisRequest $req)
    {
        return $this->userService->LoginAccountUser($req);
    }
    function logOut(Request $req)
    {
        return $this->userService->LogoutAcoountUser($req);
    }

    function adminIndex()
    {
        $users = User::oldest()->paginate(10);
        return view('admin.user.index-user', compact('users'));
    }
    function adminViewsAddRole($id)
    {
        $users =  User::find($id);
        $roles = Roles::all();
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
