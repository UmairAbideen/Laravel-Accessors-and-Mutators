<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|in:male,female',
            'age' => 'required|integer|min:1|max:120',
            'contact' => 'required|string|max:20',
        ]);

        // Create a new user
        User::create($request->all());

        // Redirect to the user index page
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
}
