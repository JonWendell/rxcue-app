<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && password_verify($credentials['password'], $user->password)) {
            // Manual login
            session(['user' => $user]);

            // Redirect based on the user's role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.home');
                case 'cashier':
                    return redirect()->route('cashier.show');
                case 'client':
                    return redirect()->route('client.home');
                default:
                    return redirect()->route('dashboard');
            }
        }

        // Redirect back to the login form if authentication fails
        return redirect()->route('login.form')->with('error', 'Invalid credentials');
    }
    public function logout()
    {
        // Terminate the session
        Session::flush();

        // Redirect to the login form with a success message
        return redirect()->route('login.form')->with('success', 'You have been logged out successfully.');
    }
}