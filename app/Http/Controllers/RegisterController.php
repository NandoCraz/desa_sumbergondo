<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register Page',
        ]);
    }

    public function register(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|numeric',
            'password' => 'required|min:5',
        ]);

        $validasi['password'] = bcrypt($validasi['password']);
        $validasi['role'] = 'user';

        User::create($validasi);

        return redirect('/login')->with('berhasil', 'Registrasi berhasil, Silahkan login!');
    }
}
