<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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

    public function belumDibayar()
    {
        $checkouts = Checkout::where('payment_status', '1')->latest()->get();
        return view('adminPage.components.pesananStatus.belumDibayar', [
            'checkouts' => $checkouts
        ]);
    }
    public function menungguKonfirmasi()
    {
        $checkouts = Checkout::where('status', '1')->latest()->get();
        return view('adminPage.components.pesananStatus.menunggu', [
            'checkouts' => $checkouts
        ]);
    }
    public function diproses()
    {
        $checkouts = Checkout::where('status', '2')->latest()->get();
        return view('adminPage.components.pesananStatus.diproses', [
            'checkouts' => $checkouts
        ]);
    }
    public function dikirim()
    {
        $checkouts = Checkout::where('status', '3')->latest()->get();
        return view('adminPage.components.pesananStatus.dikirim', [
            'checkouts' => $checkouts
        ]);
    }
    public function selesai()
    {
        $checkouts = Checkout::withTrashed()->where('status', '4')->latest()->get();
        return view('adminPage.components.pesananStatus.selesai', [
            'checkouts' => $checkouts,
        ]);
    }
    public function dibatalkan()
    {
        $checkouts = Checkout::withTrashed()->where('status', '5')->latest()->get();
        return view('adminPage.components.pesananStatus.batal', [
            'checkouts' => $checkouts,
        ]);
    }

    public function detailPesananAdmin($id)
    {
        // return 'tes';
        $checkout = Checkout::where('id', $id)->with(['daftarAlamat', 'user', 'pesanans'])->first();

        return view('adminPage.components.pesananAdmin.detailPesanan', [
            'checkout' => $checkout,
        ]);
    }

    public function changeStatus(Request $request, Checkout $checkout)
    {
        // return $request;

        $checkout = Checkout::where('uuid', $checkout->uuid)->first();

        if ($request->action == 'batal') {
            $checkout = Checkout::where('id', $request->id)->with(['pesanans'])->first();

            foreach ($checkout->pesanans as $pesanan) {
                $barang = Barang::where('id', $pesanan->barang_id)->first();
                $barang->update([
                    'stok' => $barang->stok + $pesanan->kuantitas,
                    'dibeli' => $barang->dibeli - $pesanan->kuantitas
                ]);
            }

            $checkout->update([
                'status' => '5',
            ]);

            return back()->with('success', 'Pesanan berhasil dibatalkan');
        } else if ($request->action == 'terima') {
            $checkout->update([
                'status' => '4',
            ]);
            return back()->with('success', 'Pesanan Telah diterima');
        } else if ($request->action == 'hapus') {
            $checkout->delete();
            return back()->with('success', 'Pesanan berhasil dihapus');
        } else if ($request->action == 'konfirmasi') {
            $checkout->update([
                'status' => '2',
            ]);
            return back()->with('success', 'Pesanan berhasil dikonfirmasi');
        } else if ($request->action == 'kirim') {
            $checkout->update([
                'status' => '3',
            ]);
            return back()->with('success', 'Pesanan berhasil dikirim');
        }
    }
}
