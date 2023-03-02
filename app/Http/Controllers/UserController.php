<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changeDataUser(Request $request, User $user)
    {
        // return $request;
        $user = User::findOrFail($user->id);
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255',
            'no_hp' => 'required|numeric',
            'picture_profile' => 'nullable|image|max:2048',
        ]);

        if ($request->file('picture_profile')) {
            if (file_exists(storage_path('app/public/' . $user->picture_profile))) {
                unlink(storage_path('app/public/' . $user->picture_profile));
            }
            $data['picture_profile'] = $request->file('picture_profile')->store('profilePicture', 'public');
        } else {
            $data['picture_profile'] = $user->picture_profile;
        }

        $user->update($data);

        return back()->with('success', 'Data berhasil diubah');
    }

    public function changePassword(Request $request, User $user)
    {
        // return $request;
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
            'konf_pass' => 'required'
        ]);

        $pass = User::findorFail($user->id);

        if (Hash::check($request->old_pass, $pass->password)) {
            if ($request->new_pass == $request->konf_pass) {
                User::find($user->id)->update([
                    'password' => Hash::make($request->new_pass)
                ]);
                return redirect('/dashboard-admin')->with('success', 'Password Berhasil di ubah');
            } else {
                return redirect('/dashboard-admin')->with('error', 'Konfirmasi Password tidak sama');
            }
        } else {
            return redirect('/dashboard-admin')->with('error', 'Password Lama salah');
        }
    }

    public function deleteUser(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->delete($user->id);
        return back()->with('success', 'Barang berhasil dihapus!');
    }

    public function editUser(User $user)
    {
        return view('adminPage.components.editUser', [
            'user' => $user
        ]);
    }
}
