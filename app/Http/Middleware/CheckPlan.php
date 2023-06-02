<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $redirectRoute=null)
    {
        $user = $request->user();
        if(!$user || !$user->plan_is_active) {
            if(!$redirectRoute) {
                abort(404, 'Store is disabled.');
            }
            return redirect()->route($redirectRoute);
        }
        return $next($request);
    }
}
