<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
