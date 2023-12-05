<?php

namespace App\Http\Controllers;

use App\Models\User; // Update the namespace
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('logins.register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required|string|max:50',
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'middleName' => 'nullable|string|max:50',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer',
            'email' => 'required|email|max:50',
            'role' => 'required|in:admin,cashier,client',
            'password' => 'required|string|max:255',
        ]);

        // Create a new user using the User model
        User::create($validatedData);

        // Add any additional registration logic here (e.g., sending emails, etc.)

        return redirect()->route('login.form');
    }

    public function showLoginForm()
    {
        return view('logins.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication was successful

            // Get the authenticated user
            $user = Auth::user();

            // Check the user's role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.home');
                    break;

                // Add other roles as needed

                default:
                    return redirect()->route('dashboard');
            }
        }

        // Authentication failed
        return redirect()->route('login.form')->with('error', 'Invalid credentials');
    }
}
