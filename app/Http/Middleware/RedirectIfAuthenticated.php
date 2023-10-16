<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (auth()->user()->role == 'admin')
                {
                    return redirect()->route('admin.home');
                }
                else if (auth()->user()->role == 'manager')
                {
                    return redirect()->route('manager.home');
                }
                else if (auth()->user()->role == 'team')
                {
                    return redirect()->route('team.home');
                }
                else if (auth()->user()->role == 'owner')
                {
                return redirect()->route('owner.home');
                }
                else
                {
                    Auth::logout();
                    return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
