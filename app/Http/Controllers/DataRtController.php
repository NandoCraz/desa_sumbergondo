<?php

namespace App\Http\Controllers;

use App\Models\Tetangga;
use Illuminate\Http\Request;

class DataRtController extends Controller
{
    public function tambahDataRt(Request $request)
    {
        $data = $request->no_rw;
        return view('adminPage.components.dataRt.tambahDataRt', [
            'data' => $data,
        ]);
    }

    public function simpanDataRt(Request $request)
    {
        $data = $request->validate([
            'nomor_rt' => 'required|numeric',
            'rw_id' => 'required|numeric',
        ]);

        $data['nomor_rt'] = 'RT ' . $data['nomor_rt'];

        Tetangga::create($data);

        return redirect('/master/data-rw')->with('success', 'Data RT berhasil ditambahkan');
    }

    public function hapusDataRt(Tetangga $tetangga)
    {
        Tetangga::destroy($tetangga->id);
        return redirect('/master/data-rw')->with('success', 'Data RW berhasil dihapus');
    }
}
