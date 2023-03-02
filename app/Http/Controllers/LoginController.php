<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $authentication = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (auth()->attempt($authentication)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard-admin')->with('success', 'Login Berhasil, Halo ' . auth()->user()->name);
            }
            return redirect('/')->with('success', 'Login Berhasil, Halo ' . auth()->user()->name);
        }


        return back()->with('error', 'Login Gagal');
    }


    public function resetPassword()
    {
        return view('Reset.reset');
    }

    public function reset(Request $request)
    {
        $user = User::where('email', $request->email)->where('created_at', 'LIKE', '%' . $request->waktu_buat . '%')->first();

        if ($user !== null) {
            return view('Reset.gantiPass', [
                'user' => $user
            ]);
        } else {
            return back()->with('error', 'Email atau waktu buat tidak sesuai');
        }
    }

    public function ubahPass(Request $request)
    {
        // return $request->all();
        // dd(User::where('id', $request->id)->first());


        if ($request->new_pass == $request->konf_pass) {
            User::where('id', $request->id)->update([
                'password' => bcrypt($request->new_pass)
            ]);
            return redirect('/login')->with('success', 'Password berhasil diubah');
        } else {
            return back()->with('error', 'Konfirmasi Password tidak sama');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
