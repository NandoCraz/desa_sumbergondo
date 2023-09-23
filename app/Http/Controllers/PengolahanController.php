<?php

namespace App\Http\Controllers;

use App\Models\Pengolahan;
use App\Models\Warga;
use Illuminate\Http\Request;

class PengolahanController extends Controller
{
    public function index()
    {
        $tagihans = Pengolahan::with(['tetangga', 'warga'])->get();
        return view('adminPage.components.dataPengolahan', [
            'tagihans' => $tagihans,
        ]);
    }

    public function tambahTagihan()
    {
        $wargas = Warga::all();

        return view('adminPage.components.tambahTagihan', [
            'wargas' => $wargas,
        ]);
    }

    public function simpanTagihan(Request $request)
    {
        $data = $request->validate([
            'rw_id' => 'required',
            'rt_id' => 'required',
            'tagihan_insenator' => 'required',
        ]);

        Pengolahan::create($data);
        return redirect('/data-pengolahan')->with('success', 'Data tagihan berhasil ditambahkan');
    }
}
