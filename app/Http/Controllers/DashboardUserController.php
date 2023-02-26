<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DaftarAlamat;
use App\Models\Kategori;
use App\Models\Komentar;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index()
    {
        $barangs = Barang::paginate(3);
        if (isset(auth()->user()->id)) {
            $komentarUser = Komentar::where('user_id', auth()->user()->id)->first();
        } else {
            $komentarUser = null;
        }
        $komentars = Komentar::with(['user'])->get();;
        return view('userPage.components.home', [
            'barangs' => $barangs,
            'komentarUser' => $komentarUser,
            'komentars' => $komentars
        ]);
    }

    public function profilUser()
    {
        return view('userPage.components.profileUser');
    }

    public function pengaturanUser()
    {
        $alamats = DaftarAlamat::where('user_id', auth()->user()->id)->with(['provinsi', 'kota'])->get();
        return view('userPage.components.settingUser', [
            'alamats' => $alamats
        ]);
    }

    public function getProduk()
    {
        $kategoris = Kategori::all();
        $barangs = Barang::all();
        return view('userPage.components.produk', [
            'barangs' => $barangs,
            'kategoris' => $kategoris
        ]);
    }

    public function getProdukByKategori(Kategori $kategori)
    {
        $kategoris = Kategori::all();
        $barangs = Barang::where('kategori_id', $kategori->id)->get();
        return view('userPage.components.produk', [
            'barangs' => $barangs,
            'kategoris' => $kategoris
        ]);
    }

    public function singleProduk(Barang $barang)
    {
        $barang = Barang::where('uuid', $barang->uuid)->with(['kategori'])->first();
        return view('userPage.components.singleProduk', [
            'barang' => $barang
        ]);
    }

    public function cari(Request $request)
    {
        if ($request->cari == null || $request->cari == '') {
            $barangs = Barang::with(['kategori'])->get();
        } else {
            $barangs = Barang::where('nama_barang', 'like', '%' . $request->cari . '%')->with(['kategori'])->get();
        }
        return response()->json($barangs);
    }
}
