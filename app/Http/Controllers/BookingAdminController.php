<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    public function index()
    {
        $menungguKonfirmasi = Booking::where('status', 'Konfirmasi Layanan')->latest()->get();
        $konfirmasiAdmin = Booking::where('status', 'Menunggu Konfirmasi Admin')->latest()->get();
        $persetujuanLayanan = Booking::where('status', 'Persetujuan Layanan')->latest()->get();
        $pembayaran = Booking::where('status', 'Pembayaran')->latest()->get();
        $sedangDikerjakan = Booking::where('status', 'Sedang Dikerjakan')->latest()->get();
        $selesai = Booking::where('status', 'Selesai')->latest()->get();

        return view('adminPage.components.layananStatus.layananAdmin', [
            'menungguKonfirmasi' => $menungguKonfirmasi,
            'konfirmasiAdmin' => $konfirmasiAdmin,
            'persetujuanLayanan' => $persetujuanLayanan,
            'pembayaran' => $pembayaran,
            'sedangDikerjakan' => $sedangDikerjakan,
            'selesai' => $selesai,
        ]);
    }

    public function detailLayananAdmin(Booking $booking)
    {
        $booking = Booking::where('id', $booking->id)->with(['montir'])->first();
        return view('adminPage.components.layananAdmin.detailLayanan', [
            'booking' => $booking,
        ]);
    }

    public function keputusanAdmin(Request $request, Booking $booking)
    {
        if ($request->keputusan == 'setuju') {
            $booking = Booking::where('id', $booking->id)->first();
            if ($booking->penawaran_1 == null) {
                $booking->update([
                    'total' => $request->penawaran_1,
                    'status_penawaran' => 'Disetujui'
                ]);
            } elseif ($booking->penawaran_1 != null && $booking->penawaran_2 != null && $booking->penawaran_3 == null) {
                $booking->update([
                    'total' => $request->penawaran_2,
                    'status_penawaran' => 'Disetujui'
                ]);
            } elseif ($booking->penawaran_2 != null && $booking->penawaran_3 != null) {
                $booking->update([
                    'total' => $request->penawaran_3,
                    'status_penawaran' => 'Disetujui'
                ]);
            }
            return back()->with('success', 'Berhasil Menyetujui Tawaran');
        } elseif ($request->keputusan == 'tolak') {
            $booking->update([
                'status_penawaran' => 'Ditolak'
            ]);
            return back()->with('success', 'Berhasil Menolak Tawaran');
        }
    }
}
