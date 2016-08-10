<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = last(explode('\\', request()->route()->getActionName()));

        if (!Auth::guard('backend')->user()->missingPermission($action)) {
            return redirect('/');
        }

        return $next($request);
    }
}
