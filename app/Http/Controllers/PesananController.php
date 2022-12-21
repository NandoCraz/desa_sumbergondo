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

        return view('userPage.components.detailPesanan', [
            'checkout' => $checkout,
        ]);
    }

    public function changeStatus(Request $request, Checkout $checkout)
    {
        // return $request;

        $checkout = Checkout::where('uuid', $checkout->uuid)->first();

        if ($request->action == 'batal') {
            $checkout->update([
                'status' => '5',
            ]);
            return back()->with('success', 'Pesanan berhasil dibatalkan');
        } else if ($request->action == 'terima') {
            $checkout->update([
                'status' => '4',
            ]);
            return back()->with('success', 'Pesanan Telah diterima');
        }
    }
}
