<?php

namespace App\Http\Controllers;

use App\Models\DaftarAlamat;
use App\Models\Keranjang;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::where('user_id', auth()->user()->id)->with(['barang', 'user'])->get();
        $total = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->subtotal;
        }
        $provinsis = Provinsi::all();
        $daftar_alamats = DaftarAlamat::where('user_id', auth()->user()->id)->with(['user', 'provinsi', 'kota'])->get();
        return view('userPage.components.checkout', [
            'keranjangs' => $keranjangs,
            'total' => $total,
            'provinsis' => $provinsis,
            'daftar_alamats' => $daftar_alamats,
        ]);
    }
}
