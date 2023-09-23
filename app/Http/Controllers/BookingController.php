<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangBooking;
use App\Models\Booking;
use App\Models\BookingPelayanan;
use App\Models\Kecamatan;
use App\Models\Montir;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenLayanan;

class BookingController extends Controller
{
    public function index()
    {
        return view('userPage.components.booking');
    }

    public function layananWisata()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        return view('userPage.components.layanans', [
            'bookings' => $bookings
        ]);
    }

    public function detailLayanan(Booking $booking)
    {
        $booking = Booking::where('uuid', $booking->uuid)->first();
        return view('userPage.components.detailLayanan', [
            'booking' => $booking,
        ]);
    }

    public function booking(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'nama_pemesan' => 'required|max:255',
            'no_telp' => 'required|numeric',
            'waktu' => 'required',
            'jumlah_orang' => 'required',
            'req_makan' => 'nullable',
            'tipe_bayar' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        if ($request->tipe_bayar == 'website') {
            $data['status'] = null;
        } else {
            $data['status'] = 'Menunggu Konfirmasi';
            $data['payment_status'] = null;
        }

        $total_harga = 50000 + ($request->jumlah_orang * 25000);
        $data['total'] = $total_harga;

        Booking::create($data);

        return redirect('/layanans')->with('success', 'Booking berhasil');
    }

    public function changeStatusBooking(Request $request, Booking $booking)
    {
        if ($request->status == 'konfirmasiAdmin') {
            Booking::where('id', $booking->id)->update([
                'status' => 'Dikonfirmasi'
            ]);
            return back()->with('success', 'Layanan Berhasil Dikonfirmasi');
        } else if ($request->status == 'sudahDibayar') {
            Booking::where('id', $booking->id)->update([
                'status' => 'Sudah Dibayar'
            ]);
            return back()->with('success', 'Layanan Sudah Dibayar');
        }
    }

    public function hapusLayanan(Booking $booking)
    {
        $booking = Booking::where('id', $booking->id)->first();

        $booking->delete();
        return redirect('/layanans')->with('success', 'Layanan Dibatalkan');
    }

    public function charger(Request $request)
    {
        $booking = Booking::where('id', $request->id)->first();

        $midtrans = new CreateSnapTokenLayanan($booking);
        $snapToken = $midtrans->getSnapToken();

        $booking->snap_token = $snapToken;
        $booking->save();

        return response()->json([
            'snap_token' => $snapToken,
        ]);
    }
}
