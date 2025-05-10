<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class AdminController extends Controller
{
    public function index(Request $request) {
        $sortBy = $request->get('sort_by', 'created_at'); // default sort column
        $sortDirection = $request->get('sort_direction', 'desc'); // default direction

        $users = User::orderBy($sortBy, $sortDirection)->paginate(5);

        return view('admin.index', compact('users', 'sortBy', 'sortDirection'));
    }

    public function create(Request $request) {
        $role = $request->query('role', 'user');
        return view('admin.add', compact('role'));
    }

    public function store(Request $request)
    {
        $role = $request->input('role', 'user');

        // Validate common fields
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:10|confirmed',
            'role' => 'required|in:admin,user',
        ];

        // Additional rules for 'user' role
        if ($role === 'user') {
            $rules['address'] = 'nullable|string|max:255';
            $rules['phone'] = 'nullable|regex:/^\+?[0-9]{6,11}$/';
            $rules['city'] = 'required|string|max:255'; // Make city required
            $rules['country'] = 'required|string|max:255'; // Make country required
            $rules['pincode'] = 'required|numeric|min:6'; // Make pincode required
        }
        
        $validated = $request->validate($rules);

        try {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            // Save additional user details if role is 'user'
            if ($role === 'user') {
                $user->details()->create([
                    'address' => $validated['address'],
                    'phone' => $validated['phone'],
                    'city' => $validated['city'],
                    'country' => $validated['country'],
                    'pincode' => $validated['pincode'],
                ]);
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // General error
            return back()->with('error', 'An unexpected error occurred. Please try again later.' . $e->getMessage());
        }

        return redirect()->route('admin.dashboard')->with('success', ucfirst($role) . ' created successfully!');
    }

    // Show the form to edit a user
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $userDetails = $user->details; // Get related user details

        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Data not found.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (AuthorizationException $e) {
            return back()->with('error', 'You do not have permission to perform this action.');
        } catch (Exception $e) {
            // General error
            return back()->with('error', 'An unexpected error occurred. Please try again later.' . $e->getMessage());
        }
        
        return view('admin.edit', compact('user', 'userDetails'));
    }

    // Update the user and user details
    public function update(Request $request)
    {
        $user = User::findOrFail($request->user_id);
            
        // Validate input
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'password' => 'nullable|min:5|confirmed',
            'role' => 'required|in:admin,user',
        ];

        // Additional rules for 'user' role
        if ($request->role === 'user') {
            $rules['address'] = 'required|string';
            $rules['phone'] = 'required|regex:/^\+?[0-9]{6,11}$/';
            $rules['city'] = 'required|string';
            $rules['pincode'] = 'required|numeric';
            $rules['country'] = 'required|string';
        }

        $validated = $request->validate($rules);
            
        try {

            // Update the user
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
                'role' => $validated['role'],
            ]);

            // If the role is 'user', update the additional user details
            if ($validated['role'] === 'user') {
                $user->details()->update([
                    'address' => $validated['address'],
                    'phone' => $validated['phone'],
                    'city' => $validated['city'],
                    'pincode' => $validated['pincode'],
                    'country' => $validated['country'],
                ]);
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Data not found.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (AuthorizationException $e) {
            return back()->with('error', 'You do not have permission to perform this action.');
        } catch (Exception $e) {
            // General error
            return back()->with('error', 'An unexpected error occurred. Please try again later.' . $e->getMessage());
        }

        return redirect()->route('admin.dashboard')->with('success', ucfirst($request->role) . ' updated successfully!');
    }

    // Delete the user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->details()->delete();  // Delete user details first
            $user->delete();  // Then delete the user

        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Data not found.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (AuthorizationException $e) {
            return back()->with('error', 'You do not have permission to perform this action.');
        } catch (Exception $e) {
            // General error
            return back()->with('error', 'An unexpected error occurred. Please try again later.' . $e->getMessage());
        }
        
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
    }

}
