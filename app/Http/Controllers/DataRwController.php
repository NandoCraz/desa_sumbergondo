<?php

namespace App\Http\Controllers;

use App\Models\Tetangga;
use App\Models\Warga;
use Illuminate\Http\Request;

class DataRwController extends Controller
{
    public function dataRw()
    {
        $data_rw = Warga::all();
        return view('adminPage.components.dataRw.index', [
            'data_rw' => $data_rw,
        ]);
    }

    public function hapusDataRw(Warga $warga)
    {
        Warga::destroy($warga->id);
        return redirect('/master/data-rw')->with('success', 'Data RW berhasil dihapus');
    }

    public function tambahDataRw()
    {
        return view('adminPage.components.dataRw.tambahDataRw');
    }

    public function simpanDataRw(Request $request)
    {
        $data = $request->validate([
            'nomor_rw' => 'required|numeric',
        ]);

        $data['nomor_rw'] = 'RW ' . $data['nomor_rw'];

        Warga::create($data);
        return redirect('/master/data-rw')->with('success', 'Data RW berhasil ditambahkan');
    }

    public function listDataRt(Warga $warga)
    {
        $data_rt = Tetangga::where('rw_id', $warga->id)->with(['pengolahan'])->get();
        return view('adminPage.components.dataRt.index', [
            'data_rt' => $data_rt,
        ]);
    }
}
