<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:4', 'max:255'],
            'email' => ['required', 'min:10', 'max:255', 'email'],
            'password' => ['nullable', 'min:8', new PasswordRule]
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()
            ->back()
            ->withSuccess('Berhasil memperbarui profil');
    }
}
