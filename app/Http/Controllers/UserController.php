<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        return Inertia('User/Index',['user' => $user]);
    }
    public function edit(User $user)
    {
        return Inertia('User/Edit',['user' => $user]);
    }
    public function update(Request $request , User $user )
    {
        $validate = $request->validate([
            'height' => 'required',
            'weight' => 'required',
            'male' => 'required',
            'mets' => 'required', 
        ]);

        $user->update($validate);

        return redirect()->route('users.index');
    }
}
