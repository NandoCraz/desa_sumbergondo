<?php

namespace App\Http\Controllers;

use App\Models\DaftarAlamat;
use Illuminate\Http\Request;

class DaftarAlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validator = $request->validate([
            'nama_penerima' => 'required|max:255',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|max:255',
            'kode_pos' => 'required|numeric',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
        ]);

        $validator['user_id'] = auth()->user()->id;
        $validator['kecamatan_id'] = 1;

        DaftarAlamat::create($validator);
        return back()->with('success', 'Alamat berhasil ditambahkan');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
