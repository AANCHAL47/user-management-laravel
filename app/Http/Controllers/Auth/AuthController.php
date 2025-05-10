<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            // If the user is authenticated, check their role and redirect accordingly
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login');
    }

    public function login() {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard'); // Or user.dashboard if user is logged in
        }
        
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
        
        try {
            // Check credentials
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // If user is authenticated, check their role
                $user = Auth::user();
                
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (AuthorizationException $e) {
            return back()->with('error', 'You do not have permission to perform this action.');
        } catch (Exception $e) {
            // General error
            return back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
        
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        try {
            // Log the user out
            Auth::logout();

            // Invalidate the session to prevent session fixation attacks
            $request->session()->invalidate();

            // Regenerate the session ID to prevent session hijacking
            $request->session()->regenerateToken();

        } catch (Exception $e) {
            // General error
            return back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
        
        // Redirect the user to the login page or home page after logout
        return redirect()->route('login');
    }

}
