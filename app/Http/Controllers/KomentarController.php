<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function simpanKomentar(Request $request)
    {
        // return $request;
        $data = $request->validate([
            'komentar' => 'max:255'
        ]);

        $data['user_id'] = auth()->user()->id;

        Komentar::create($data);

        return redirect('/')->with('success', 'Komentar Disimpan');
    }
}
