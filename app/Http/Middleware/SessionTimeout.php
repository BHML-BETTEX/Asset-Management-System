<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip check for login/logout routes and API routes
        if ($this->isExempt($request)) {
            return $next($request);
        }

        // Check if user is authenticated
        if (!Auth::check()) {
            return $next($request);
        }

        $timeout = config('session.timeout', 30); // Default 30 minutes if not set
        $lastActivity = Session::get('last_activity');
        $currentTime = time();

        // If no last activity recorded, set it now
        if (!$lastActivity) {
            Session::put('last_activity', $currentTime);
            return $next($request);
        }

        // Check if session has timed out
        $timeDifference = $currentTime - $lastActivity;
        $timeoutInSeconds = $timeout * 60; // Convert minutes to seconds

        if ($timeDifference > $timeoutInSeconds) {
            // Session has timed out
            Auth::logout();
            Session::flush();
            Session::regenerate();

            // Check if it's an AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Session expired due to inactivity',
                    'redirect' => route('login')
                ], 401);
            }

            // For normal requests, redirect to login with message
            return redirect()->route('login')
                ->with('warning', 'Your session has expired due to inactivity. Please login again.');
        }

        // Update last activity time
        Session::put('last_activity', $currentTime);

        return $next($request);
    }

    /**
     * Check if the current route should be exempt from session timeout check
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isExempt(Request $request)
    {
        $exemptRoutes = [
            'login',
            'logout',
            'register',
            'password.*',
            'verification.*',
        ];

        $exemptPaths = [
            'api/*',
            'auth/*',
        ];

        // Check route names
        $routeName = $request->route() ? $request->route()->getName() : '';
        foreach ($exemptRoutes as $exempt) {
            if (fnmatch($exempt, $routeName)) {
                return true;
            }
        }

        // Check paths
        foreach ($exemptPaths as $exempt) {
            if ($request->is($exempt)) {
                return true;
            }
        }

        return false;
    }
}