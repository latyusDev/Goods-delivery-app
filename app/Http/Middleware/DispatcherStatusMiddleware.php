<?php

namespace App\Http\Middleware;

use App\Models\Dispatcher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DispatcherStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dispatcher = Dispatcher::whereEmail(Auth::guard('dispatcher')->user()->email)
                                ->first();

        if($dispatcher->status)
        {
            Auth::guard('dispatcher')->logout();
            return redirect()->route('dispatcher.login')->withErrors(['email'=>'Your account was banned on '
                   .$dispatcher->updated_at-> toDayDateTimeString().
                   ' contact the Admin for more info'])
                          ->onlyInput('email');
        }

        return $next($request);
    }
}
