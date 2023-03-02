<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKategori;
use App\Models\Kategori;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PDF;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::with(['kategori'])->get();
        return view('adminPage.components.dataBarang.index', [
            'barangs' => $barangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('adminPage.components.dataBarang.create', [
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'nama_barang' => 'required|max:255',
            'berat' => 'required',
            // 'kategori_id' => 'required',
            'harga' => 'required|numeric|min:1',
            'stok' => 'required',
            'deskripsi' => 'required',
            'picture_barang' => 'required|image|max:2048'
        ]);

        $validateData['picture_barang'] = $request->file('picture_barang')->store('barangPicture', 'public');

        $Cbarang = Barang::create($validateData);

        foreach ($request->kategori as $kategori) {
            BarangKategori::create([
                'barang_id' => $Cbarang->id,
                'kategori_id' => $kategori
            ]);
        }

        return redirect('/master/data-barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('adminPage.components.dataBarang.edit', [
            'barang' => $barang,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $validateData = $request->validate([
            'nama_barang' => 'required|max:255',
            // 'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required',
            'deskripsi' => 'required',
            'picture_barang' => 'image|max:2048'
        ]);

        if ($request->file('picture_barang')) {
            if (file_exists(storage_path('app/public/' . $barang->picture_barang))) {
                unlink(storage_path('app/public/' . $barang->picture_barang));
            }
            $validateData['picture_barang'] = $request->file('picture_barang')->store('barangPicture', 'public');
        } else {
            $validateData['picture_barang'] = $barang->picture_barang;
        }

        Barang::where('id', $id)->update($validateData);

        BarangKategori::where('barang_id', $id)->delete();
        foreach ($request->kategori as $kategori) {
            BarangKategori::create([
                'barang_id' => $id,
                'kategori_id' => $kategori
            ]);
        }

        return redirect('/master/data-barang')->with('success', 'Barang berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if (file_exists(storage_path('app/public/' . $barang->picture_barang))) {
            unlink(storage_path('app/public/' . $barang->picture_barang));
        }
        BarangKategori::where('barang_id', $id)->delete();
        Barang::destroy($id);
        return redirect('/master/data-barang')->with('success', 'Barang berhasil dihapus!');
    }

    public function laporanBarang(Request $request)
    {
        $barangs = Barang::all();

        if (strpos($request->timestamp, ' to ')) {
            $tanggal = explode(' to ', $request->timestamp);
            $awal = Carbon::parse($tanggal[0])->format('Y-m-d');
            $akhir = Carbon::parse($tanggal[1])->format('Y-m-d');
            $barangs->map(function ($barang) use ($awal, $akhir) {
                // buat laporan barang yang sudah dibeli
                $barang->dibeli = Pesanan::where('barang_id', $barang->id)->whereHas('checkout', function ($q) use ($awal, $akhir) {
                    $q->whereBetween('created_at', [$awal, $akhir]);
                })->count();
            });
        } else {
            $awal = Carbon::parse($request->timestamp)->format('Y-m-d');
            $akhir = $awal;
            $barangs->map(function ($barang) use ($awal) {
                // buat laporan barang yang sudah dibeli
                $barang->dibeli = Pesanan::whereHas('checkout', function ($q) use ($awal) {
                    $q->where('created_at', 'LIKE', '%' . $awal . '%');
                })->count();
            });
        }



        $pdf = PDF::loadView('adminPage.partials.laporan.Lstok', [
            'barangs' => $barangs,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan_barang' . '.pdf');
    }
}
