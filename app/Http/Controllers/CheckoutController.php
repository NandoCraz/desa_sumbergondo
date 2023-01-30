<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Checkout;
use App\Models\DaftarAlamat;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenService;

class CheckoutController extends Controller
{
    public function index()
    {
        $is_tersedia = true;
        $keranjangs = Keranjang::where('user_id', auth()->user()->id)->with(['barang', 'user'])->get();

        foreach ($keranjangs as $keranjang) {
            if ($keranjang->kuantitas > $keranjang->barang->stok) {
                $is_tersedia = false;
            }
        }

        if (!$is_tersedia) {
            return back()->with('error', 'Kuantitas melebihi stok!');
        }

        if ($keranjangs->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }
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

    public function pembayaran(Request $request)
    {
        $keranjangs = Keranjang::where('user_id', auth()->user()->id)->with(['barang', 'user'])->get();
        $total = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->subtotal;
        }
        $daftar_alamats = DaftarAlamat::with(['user', 'provinsi', 'kota'])->find($request->daftar_alamat_id);
        return view('userPage.components.pembayaran', [
            'keranjangs' => $keranjangs,
            'daftar_alamats' => $daftar_alamats,
            'total' => $total
        ]);
    }

    public function charger(Request $request)
    {
        // $barangs = Barang::all();

        $data = $request->validate([
            'daftar_alamat_id' => 'required',
            'courier' => 'required',
            'layanan' => 'required',
            'catatan' => 'string|nullable',
            'ongkir' => 'required',
            'estimasi' => 'required',
        ]);

        $keranjangs = Keranjang::where('user_id', auth()->user()->id)->with(['barang', 'user'])->get();

        $total = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->subtotal;
        }

        $total += $request->ongkir;

        $input = [
            'user_id' => auth()->user()->id,
            'daftar_alamat_id' => $request->daftar_alamat_id,
            'courier' => $request->courier,
            'layanan' => $request->layanan,
            'catatan' => $request->catatan,
            'ongkir' => $request->ongkir,
            'estimasi' => $request->estimasi,
            'total' => $total,
        ];

        $checkout = Checkout::create($input);

        foreach ($keranjangs as $keranjang) {
            Pesanan::create([
                'barang_id' => $keranjang->barang_id,
                'checkout_id' => $checkout->id,
                'kuantitas' => $keranjang->kuantitas,
                'sub_total' => $keranjang->subtotal
            ]);

            $barang = Barang::find($keranjang->barang_id);
            $barang->update([
                'stok' => $barang->stok - $keranjang->kuantitas
            ]);

            Keranjang::destroy($keranjang->id);
        }

        $midtrans = new CreateSnapTokenService($checkout);
        $snapToken = $midtrans->getSnapToken();

        $checkout->snap_token = $snapToken;
        $checkout->save();

        return response()->json([
            'snap_token' => $snapToken,
        ]);
    }

    public function show(Checkout $checkout)
    {
        $checkout = Checkout::with(['daftar_alamat', 'pesanan'])->find($checkout->id);
        $snapToken = $checkout->snap_token;

        return view('userPage.components.detailPesanan', compact('snapToken', 'checkout'));
    }
}
