<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelayanans = Pelayanan::all();
        return view('adminPage.components.dataPelayanan.index', [
            'pelayanans' => $pelayanans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPage.components.dataPelayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_pelayanan' => 'required|max:255',
            'harga' => 'required|numeric|min:1'
        ]);

        Pelayanan::create($validateData);
        return redirect('/master/data-pelayanan')->with('berhasil', 'Pelayanan berhasil ditambahkan!');
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
        $pelayanan = Pelayanan::findOrFail($id);
        return view('adminPage.components.dataPelayanan.edit', [
            'pelayanan' => $pelayanan
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
        $validateData = $request->validate([
            'nama_pelayanan' => 'required|max:255',
            'harga' => 'required|numeric|min:1'
        ]);

        Pelayanan::where('id', $id)->update($validateData);
        return redirect('/master/data-pelayanan')->with('berhasil', 'Pelayanan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelayanan::destroy($id);
        return redirect('/master/data-pelayanan')->with('berhasil', 'Pelayanan berhasil dihapus!');
    }
}
