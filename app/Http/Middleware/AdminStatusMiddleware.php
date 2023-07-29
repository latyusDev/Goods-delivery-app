<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
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
        $admin = Admin::whereEmail($request->email)
                      ->first();
        if($admin == null){
            return back()->withErrors(['email'=>'Admin credentials not found'])
            ->onlyInput('email');
        }
        if($admin->status){
             return back()->withErrors(['email'=>'Your account was banned on '
                   .$admin->updated_at-> toDayDateTimeString().
                   ' contact the Manager for more info'])
                          ->onlyInput('email');
         }     
        return $next($request);
    }
}
