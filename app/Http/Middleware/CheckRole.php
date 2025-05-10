<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(Auth::check()) {
            if(Auth::user()->role == $role) {
                return $next($request);
            }

            // Redirect based on user role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect admin to the admin dashboard
            } else {
                return redirect()->route('user.dashboard'); // Redirect user to their dashboard
            }
            // Default redirect if the role is neither 'admin' nor 'user'
            return redirect()->route('login')->withErrors(['role' => 'Unauthorized access']);
        }
        
        // If the user is not logged in
        return redirect()->route('login');
    }
}
