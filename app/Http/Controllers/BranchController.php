<?php

// app/Http/Controllers/BranchController.php

// app/Http/Controllers/BranchController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    // Show the form for creating a new branch
    public function createForm()
    {
        return view('create_branch');
    }

    // Store a newly created branch in the database
    public function create(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'contact' => 'required',
            'status' => 'required',
        ]);

        // Create a new branch using Eloquent
        Branch::create($request->all());

        // Redirect back to the create form with a success message
        return redirect()->route('branch.create.form')->with('success', 'Branch created successfully');
    }

    public function view()
    {
        // Retrieve all branches from the database
        $branches = Branch::all();

        // Pass the branches data to the view
        return view('view_branches')->with('branches', $branches);
    }

    public function archive($id)
    {
        // Find the branch by ID
        $branch = Branch::find($id);

        if ($branch) {
            // Delete the branch from the database
            $branch->delete();

            // Redirect back to the view with a success message
            return redirect()->route('branch.view')->with('success', 'Branch deleted successfully');
        }

        // Redirect back with an error message if the branch is not found
        return redirect()->route('branch.view')->with('error', 'Branch not found');
    }
    public function editForm($id)
    {
        // Find the branch by ID
        $branch = Branch::find($id);

        if ($branch) {
            // Display the edit form or redirect to the form with the branch data
            return view('edit_branch', compact('branch'));
        }

        // Redirect back with an error message if the branch is not found
        return redirect()->route('branch.view')->with('error', 'Branch not found');
    }
    public function update(Request $request, $id)
    {
        // Find the branch by ID
        $branch = Branch::find($id);

        if ($branch) {
            // Validate the request data
            $request->validate([
                'name' => 'required',
                'location' => 'required',
                'contact' => 'required',
                'status' => 'required',
            ]);

            // Update the branch with the new data
            $branch->update($request->all());

            // Redirect back to the view with a success message
            return redirect()->route('branch.view')->with('success', 'Branch updated successfully');
        }

        // Redirect back with an error message if the branch is not found
        return redirect()->route('branch.view')->with('error', 'Branch not found');
    }

}


