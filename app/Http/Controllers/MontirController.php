<?php

namespace App\Http\Controllers;

use App\Models\Montir;
use Illuminate\Http\Request;

class MontirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $montirs = Montir::all();
        return view('adminPage.components.dataMontir.index', [
            'montirs' => $montirs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPage.components.dataMOntir.create');
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
            'nama' => 'required|max:255',
            'picture_montir' => 'required|image|max:2048',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|numeric'
        ]);

        $validateData['picture_montir'] = $request->file('picture_montir')->store('montirPicture', 'public');

        Montir::create($validateData);

        return redirect('/master/data-montir')->with('berhasil', 'Data Montir berhasil ditambahkan!');
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
        $montir = Montir::findOrFail($id);
        return view('adminPage.components.dataMontir.edit', [
            'montir' => $montir
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
        // return $request;
        $montir = Montir::findOrFail($id);
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'picture_montir' => 'image|max:2048',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|numeric'
        ]);

        if ($request->file('picture_montir')) {
            if (file_exists(storage_path('app/public/' . $montir->picture_montir))) {
                unlink(storage_path('app/public/' . $montir->picture_montir));
            }
            $validateData['picture_montir'] = $request->file('picture_montir')->store('montirPicture', 'public');
        } else {
            $validateData['picture_montir'] = $montir->picture_montir;
        }

        Montir::where('id', $id)->update($validateData);

        return redirect('/master/data-montir')->with('berhasil', 'Data Montir berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $montir = Montir::findOrFail($id);
        if (file_exists(storage_path('app/public/' . $montir->picture_montir))) {
            unlink(storage_path('app/public/' . $montir->picture_montir));
        }
        Montir::destroy($id);
        return redirect('/master/data-montir')->with('berhasil', 'Data Montir berhasil dihapus!');
    }
}
