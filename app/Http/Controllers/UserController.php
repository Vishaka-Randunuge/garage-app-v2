<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create'); // Form for admin to add user
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|in:user,admin'
    ]);

    $user->update($request->only('name', 'email', 'role'));

    return redirect()->route('users.index')->with('success', 'User updated successfully');
}

public function show($id)
{
    $user = User::findOrFail($id);
    return view('users.show', compact('user'));
}

    public function index()
    {
        // List all users
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // Default role
        ]);

        return redirect()->route('users.create')->with('success', 'User created successfully');
    }
    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully');
}
}
