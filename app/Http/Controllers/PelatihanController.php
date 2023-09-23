<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenKelas;

class PelatihanController extends Controller
{
    public function index()
    {
        return view('userPage.components.kelasPelatihan');
    }

    public function pelatihanKelas()
    {
        $pelatihans = Pelatihan::where('user_id', auth()->user()->id)->get();
        return view('userPage.components.pelatihans', [
            'pelatihans' => $pelatihans
        ]);
    }

    public function detailKelas(Pelatihan $pelatihan)
    {
        $pelatihan = Pelatihan::where('uuid', $pelatihan->uuid)->first();
        return view('userPage.components.detailPelatihan', [
            'pelatihan' => $pelatihan,
        ]);
    }

    public function pelatihan(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'nama_pemesan' => 'required|max:255',
            'no_telp' => 'required|numeric',
            'waktu' => 'required',
            'jumlah_orang' => 'required',
            'req_makan' => 'nullable',
            'tipe_bayar' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        if ($request->tipe_bayar == 'website') {
            $data['status'] = null;
        } else {
            $data['status'] = 'Menunggu Konfirmasi';
            $data['payment_status'] = null;
        }

        $total_harga = 100000 + ($request->jumlah_orang * 25000);
        $data['total'] = $total_harga;

        Pelatihan::create($data);

        return redirect('/pelatihans')->with('success', 'Pelatihan berhasil');
    }

    public function changeStatusPelatihan(Request $request, Pelatihan $pelatihan)
    {
        if ($request->status == 'konfirmasiAdmin') {
            Pelatihan::where('id', $pelatihan->id)->update([
                'status' => 'Dikonfirmasi'
            ]);
            return back()->with('success', 'Layanan Berhasil Dikonfirmasi');
        } else if ($request->status == 'sudahDibayar') {
            Pelatihan::where('id', $pelatihan->id)->update([
                'status' => 'Sudah Dibayar'
            ]);
            return back()->with('success', 'Layanan Sudah Dibayar');
        }
    }

    public function hapusLayanan(Pelatihan $pelatihan)
    {
        $pelatihan = Pelatihan::where('id', $pelatihan->id)->first();

        $pelatihan->delete();
        return redirect('/layanans')->with('success', 'Layanan Dibatalkan');
    }

    public function charger(Request $request)
    {
        $pelatihan = Pelatihan::where('id', $request->id)->first();

        $midtrans = new CreateSnapTokenKelas($pelatihan);
        $snapToken = $midtrans->getSnapToken();

        $pelatihan->snap_token = $snapToken;
        $pelatihan->save();

        return response()->json([
            'snap_token' => $snapToken,
        ]);
    }
}
