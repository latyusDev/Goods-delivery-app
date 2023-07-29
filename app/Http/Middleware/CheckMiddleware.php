<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = User::whereEmail($request->email)
                    ->first();
        if($user == null){
            return back()->withErrors(['email'=>'User credentials not found'])
            ->onlyInput('email');
        }
        if($user->status){
            return back()->withErrors(['email'=>'Your account was banned on '
            .$user->updated_at->toDayDateTimeString().' contact the admin for more info'])
                         ->onlyInput('email');
        }        
        return $next($request);
    }
}
