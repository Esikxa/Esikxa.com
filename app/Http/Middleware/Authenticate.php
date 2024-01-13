<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        $middleware = $request->route()->middleware();

        foreach ($middleware as $middlewareItem) {
            if (strpos($middlewareItem, 'auth:') === 0) {
                $guard = substr($middlewareItem, 5);
                switch ($guard) {
                    case 'admin':
                        return route('admin.auth.login');
                        break;
                    case 'student':
                        return route('student.login');
                        break;
                    default:
                        return route('customer.login');
                        break;
                }
            }
        }

        return route('customer.login.view');
    }
}