<?php


namespace App\Http\Middleware;

use App\Http\Controllers\LoginController;
use App\User;
use Closure;

class HAuth
{
    public function handle($request, Closure $next)
    {
//        $user = User::find(session('user'));
//
//        if(empty($user)) return route('home');
//
//        $token = $user->refreshToken();
//
//        if($token->expires()) {
//            app(LoginController::class)->refreshToken();
//        }

        return $next($request);
    }

}
