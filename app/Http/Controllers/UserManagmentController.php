<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class UserManagmentController extends Controller
{
    // Display user table
    public function index(){
        $user_table = Admin::all();
        return view('usermanagement.usertable', compact('user_table'));
    }

    // Edit user
    public function editUser($id){
        $user = Admin::find($id);
        return view('usermanagement.edituser', compact('user'));
    }

    // Update user
    public function updateUser(Request $request, $id){
        $user = Admin::find($id);
        $user->update($request->all());
        // You might want to add validation and error handling here
        return redirect()->route('userTable')->with('success', 'User updated successfully');
    }

    // Archive user
    public function archiveUser($id){
        $user = Admin::find($id);
        $user->delete();
        // You might want to add confirmation and error handling here
        return redirect()->route('userTable')->with('success', 'User archived successfully');
    }
}
