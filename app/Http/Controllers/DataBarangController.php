<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required',
            'deskripsi' => 'required',
            'picture_barang' => 'required|image|max:2048'
        ]);

        $validateData['picture_barang'] = $request->file('picture_barang')->store('barangPicture', 'public');

        Barang::create($validateData);

        return redirect('/master/data-barang')->with('berhasil', 'Barang berhasil ditambahkan!');
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
            'kategori_id' => 'required',
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

        return redirect('/master/data-barang')->with('berhasil', 'Barang berhasil diubah!');
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
        Barang::destroy($id);
        return redirect('/master/data-barang')->with('berhasil', 'Barang berhasil dihapus!');
    }
}
