<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    public function index()
    {
        $menungguKonfirmasi = Booking::where('status', 'Menunggu Konfirmasi')->latest()->get();
        $dikonfirmasi = Booking::where('status', 'Dikonfirmasi')->latest()->get();
        $sudahDibayar = Booking::where('status', 'Sudah Dibayar')->latest()->get();
        $belumDibayar = Booking::where('payment_status', '1')->latest()->get();
        $sudahDibayarWeb = Booking::where('payment_status', '2')->latest()->get();

        return view('adminPage.components.layananStatus.layananAdmin', [
            'menungguKonfirmasi' => $menungguKonfirmasi,
            'dikonfirmasi' => $dikonfirmasi,
            'sudahDibayar' => $sudahDibayar,
            'belumDibayar' => $belumDibayar,
            'sudahDibayarWeb' => $sudahDibayarWeb,
        ]);
    }

    public function detailLayananAdmin(Booking $booking)
    {
        $booking = Booking::where('id', $booking->id)->first();
        return view('adminPage.components.layananAdmin.detailLayanan', [
            'booking' => $booking,
        ]);
    }
}
