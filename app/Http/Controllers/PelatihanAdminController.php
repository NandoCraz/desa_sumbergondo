<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanAdminController extends Controller
{
    public function index()
    {
        $menungguKonfirmasi = Pelatihan::where('status', 'Menunggu Konfirmasi')->latest()->get();
        $dikonfirmasi = Pelatihan::where('status', 'Dikonfirmasi')->latest()->get();
        $sudahDibayar = Pelatihan::where('status', 'Sudah Dibayar')->latest()->get();
        $belumDibayar = Pelatihan::where('payment_status', '1')->latest()->get();
        $sudahDibayarWeb = Pelatihan::where('payment_status', '2')->latest()->get();

        return view('adminPage.components.kelasPelatihanAdmin.kelasStatus', [
            'menungguKonfirmasi' => $menungguKonfirmasi,
            'dikonfirmasi' => $dikonfirmasi,
            'sudahDibayar' => $sudahDibayar,
            'belumDibayar' => $belumDibayar,
            'sudahDibayarWeb' => $sudahDibayarWeb,
        ]);
    }

    public function detailPelatihanAdmin(Pelatihan $pelatihan)
    {
        $pelatihan = Pelatihan::where('id', $pelatihan->id)->first();
        return view('adminPage.components.kelasPelatihanAdmin.detailKelas', [
            'pelatihan' => $pelatihan,
        ]);
    }
}
