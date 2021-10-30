<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;


class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();
        $routeNameArray = [
//            'team.index',
            'team.store',
//            'team.show',
            'team.update',
            'team.destroy',
//            'player.index',
            'player.store',
//            'player.show',
            'player.update',
            'player.destroy'
        ];

        if(in_array($routeName, $routeNameArray)) {
            if(isset($_SERVER['HTTP_AUTHORIZATION'])) {
                $email =  $_SERVER['PHP_AUTH_USER'];
                $password = $_SERVER['PHP_AUTH_PW'];
                $isTrue = false;

                if(empty($email) || empty($password)) {
                    return response()->json(["message" => "User Name and Password required.", 401]);
                }
                $user = User::where('email', $email)
                    ->first();
                $validCredentials = Hash::check($password, $user->getAuthPassword());

                if ($validCredentials) {
                    $isTrue = $user->hasRole('admin');
                }

                if($isTrue) {
                    return $next($request);
                }
                else {
                    return response()->json(["message" => "You are not allowed to access this api", 401]);
                }
            }else {
                return response()->json(["message" => "Authentication required.", 401]);
            }
        } else{
            return $next($request);
        }

    }
}
