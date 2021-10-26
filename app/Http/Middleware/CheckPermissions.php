<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        DB::enableQueryLog();
        $user =
            DB::table('users')
            ->join('role_user', 'role_user.role_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->select('permissions.slug')->distinct()
            ->where('role_user.user_id', '=', Auth::id())->get()->pluck('slug');
        if ($user->contains($permission)) {
            return $next($request); 
        } else {
            return redirect('error401');
        }
    }
}
