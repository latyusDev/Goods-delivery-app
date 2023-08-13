<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::whereEmail(auth()->user()->email)
                    ->first();
        if($user->status)
        {
            Auth::guard('web')->logout();
            return redirect()->route('user.login')->withErrors(['email'=>'Your account was banned on '
                   .$user->updated_at-> toDayDateTimeString().
                   ' contact the Manager for more info'])
                          ->onlyInput('email');
         
        }
        return $next($request);
    }
}
