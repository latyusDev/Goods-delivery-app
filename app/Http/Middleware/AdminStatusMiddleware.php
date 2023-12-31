<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Admin::whereEmail(Auth::guard('admin')->user()->email)
                      ->first();
        if($admin->status)
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->withErrors(['email'=>'Your account was banned on '
                   .$admin->updated_at-> toDayDateTimeString().
                   ' contact the Manager for more info'])
                          ->onlyInput('email');
         
        }

        return $next($request);
         
    }
}
