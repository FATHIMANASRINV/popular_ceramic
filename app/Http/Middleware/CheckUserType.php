<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {

        if (!Auth::check()) {
            return redirect()->route('custom.login'); 
        }
        $user = Auth::user();
        if ($user->user_type !== $role) {
            Auth::logout();
            return redirect()->route('custom.login')->with('error', 'Unauthorized access.');
        }
        return $next($request);
    }
}
