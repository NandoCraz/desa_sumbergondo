<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::where('user_id', auth()->user()->id)->with(['daftarAlamat', 'user', 'pesanans'])->get();
        return view('userPage.components.pesanans', [
            'checkouts' => $checkouts,
        ]);
    }

    public function detailPesanan(Checkout $checkout)
    {
        $checkout = Checkout::where('uuid', $checkout->uuid)->with(['daftarAlamat', 'user', 'pesanans'])->first();
        // $daftar_alamat = $checkout->daftarAlamat->with(['provinsi', 'kota'])->first();
        // $barang = $checkout->pesanans->with(['barang'])->first();

        return view('userPage.components.detailPesanan', [
            'checkout' => $checkout,
            // 'daftar_alamat' => $daftar_alamat,
            // 'barang' => $barang,
        ]);
    }
}
