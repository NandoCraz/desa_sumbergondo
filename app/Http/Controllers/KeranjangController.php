<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Barang;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::where('user_id', auth()->user()->id)->with(['barang'])->get();
        $total = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->subtotal;
        }
        return view('userPage.components.keranjang', [
            'keranjangs' => $keranjangs,
            'total' => $total
        ]);
    }
    public function addToCart(Barang $barang, Request $request)
    {
        $barang = Barang::findOrFail($barang->id);
        $keranjang = Keranjang::where('barang_id', $barang->id)->where('user_id', auth()->user()->id)->first();
        if (isset($request->kuantitas)) {
            if ($request->kuantitas !== 0) {
                if ($keranjang) {
                    $keranjang->update([
                        'kuantitas' => $keranjang->kuantitas + $request->kuantitas
                    ]);
                    return back()->with('success', 'Berhasil menambahkan ke keranjang');
                } else {
                    Keranjang::create([
                        'barang_id' => $barang->id,
                        'kuantitas' => $request->kuantitas,
                        'user_id' => auth()->user()->id
                    ]);
                    return back()->with('success', 'Berhasil menambahkan ke keranjang');
                }
            } else {
                return back()->with('error', 'Kuantitas tidak boleh 0');
            }
        } else {
            if ($keranjang) {
                $keranjang->update([
                    'kuantitas' => $keranjang->kuantitas + 1
                ]);
                return back()->with('success', 'Berhasil menambahkan ke keranjang');
            } else {
                Keranjang::create([
                    'barang_id' => $barang->id,
                    'kuantitas' => '1',
                    'user_id' => auth()->user()->id
                ]);
                return back()->with('success', 'Berhasil menambahkan ke keranjang');
            }
        }
    }

    public function hapus(Keranjang $keranjang)
    {
        $hapusBarang = Keranjang::findOrFail($keranjang->id);
        $hapusBarang->delete();
        return back()->with('success', 'Berhasil menghapus barang dari keranjang');
    }

    public function updateCart(Keranjang $keranjang, Request $request)
    {
        $keranjang = Keranjang::findOrFail($keranjang->id);
        $keranjang->update([
            'kuantitas' => $request->kuantitas
        ]);
        return back()->with('success', 'Berhasil mengubah kuantitas barang');
    }
}
