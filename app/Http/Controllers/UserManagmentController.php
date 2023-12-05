<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UserManagmentController extends Controller
{
    // Display user table
    public function index(){
        $user_table = User::all();
        return view('usermanagement.usertable', compact('user_table'));
    }

    // Edit user
    public function editUser($id){
        $user = User::find($id);
        return view('usermanagement.edituser', compact('user'));
    }

    // Update user
    public function updateUser(Request $request, $id){
        $user = User::find($id);
        $user->update($request->all());
        // You might want to add validation and error handling here
        return redirect()->route('userTable')->with('success', 'User updated successfully');
    }

    // Archive user
    public function archiveUser($id){
        $user = User::find($id);
        $user->delete();
        // You might want to add confirmation and error handling here
        return redirect()->route('userTable')->with('success', 'User archived successfully');
    }
    public function showAddUserForm(){
        return view('usermanagement.adduserform');
    }
    public function storeUser(Request $request){
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:6',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the file type and size as needed
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('profile_pictures', 'public');
        } else {
            $picturePath = null;
        }

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'picture' => $picturePath,
            'created_at' => now(),
        ]);

        return redirect()->route('userTable')->with('success', 'User added successfully');
    }

}
