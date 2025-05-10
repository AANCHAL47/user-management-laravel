<?php

namespace App\Http\Controllers\User;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('user.index');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:5|confirmed',
            'phone' => 'nullable|regex:/^\+?[0-9]{6,11}$/',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'pincode' => 'required|string|max:10|min:6',
            'country' => 'required|string|max:100',
        ]);

        try {
            // ✅ Updating user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
    
            // ✅ Updating or creating user details
            $user->details()->updateOrCreate(
                ['user_id' => $user->id],
                $request->only('phone', 'address', 'city', 'pincode', 'country')
            );
    
            return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'An unexpected error occurred. Please try again later.' . $e->getMessage());
        }
    }

}
