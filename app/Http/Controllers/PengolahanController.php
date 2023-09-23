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

    public function updateTagihan(Pengolahan $pengolahan)
    {
        $olah_id = $pengolahan->id;
        return view('adminPage.components.updateTagihan', [
            'olah_id' => $olah_id,
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

    public function simpanUpdateTagihan(Request $request)
    {
        $data = $request->validate([
            'tagihan_insenator' => 'required',
        ]);

        $olah = Pengolahan::where('id', $request->olah_id)->first();

        $total = $olah->tagihan_insenator + $request->tagihan_insenator;

        $olah->update([
            'tagihan_insenator' => $total,
        ]);

        return redirect('/data-pengolahan')->with('success', 'Data tagihan berhasil ditambahkan');
    }

    public function hapusTagihan(Pengolahan $pengolahan)
    {
        Pengolahan::destroy($pengolahan->id);
        return redirect('/data-pengolahan')->with('success', 'Tagihan berhasil dihapus');
    }
}
