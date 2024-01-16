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
        $uri = $request->route()->uri;
        switch ($uri) {
            case 'system-user/login':
                if (Auth::guard('admin')->check()) {
                    return redirect()->route('admin.dashboard.index');
                }
                return $next($request);
                break;
            case 'student/login':
                if (Auth::guard('student')->check()) {
                    return redirect()->route('student.dashboard');
                }
                return $next($request);
                break;
            case 'teacher/login':
                if (Auth::guard('teacher')->check()) {
                    return redirect()->route('teacher');
                }
                return $next($request);
                break;
            default:
                return $next($request);
                break;
        }

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // return $next($request);
    }
}
