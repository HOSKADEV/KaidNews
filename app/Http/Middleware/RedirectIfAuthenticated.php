<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Traits\AuthTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    use AuthTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        $guard = $this->checkGuard();
        if($guard){
            return $this->redirectTo($guard);
        }
        // if (auth()->guard('student')->check()) {
        //     // return redirect('/student');
        //     return $this->redirectTo('student');
        // } else if (auth()->guard('admin')->check()) {
        //     // return redirect('/dashboard');
        //     return $this->redirectTo('admin');
        // } else if (auth()->guard('teacher')->check()) {
        //     // return redirect('/teacher');
        //     return $this->redirectTo('teacher');
        // }

        return $next($request);
    }
}
