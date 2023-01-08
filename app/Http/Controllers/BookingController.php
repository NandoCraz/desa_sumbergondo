<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangBooking;
use App\Models\Booking;
use App\Models\BookingPelayanan;
use App\Models\Montir;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $pelayanans = Pelayanan::all();
        $montirs = Montir::all();
        $barangs = Barang::all();
        return view('userPage.components.booking', [
            'pelayanans' => $pelayanans,
            'montirs' => $montirs,
            'barangs' => $barangs
        ]);
    }

    public function layananPerbaikan()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        return view('userPage.components.layanans', [
            'bookings' => $bookings
        ]);
    }

    public function detailLayanan(Booking $booking)
    {
        $booking = Booking::where('uuid', $booking->uuid)->with(['montir'])->first();
        return view('userPage.components.detailLayanan', [
            'booking' => $booking,
        ]);
    }

    public function booking(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'nama_pemesan' => 'required|max:255',
            'montir_id' => 'required',
            'alamat' => 'nullable|max:255',
            'tipe_mobil' => 'required',
            'no_telp' => 'required|numeric',
            'kendala' => 'nullable',
            'waktu' => 'required',
            'tempat_perbaikan' => 'required',
            'tipe_bayar' => 'required',
            'lampiran_1' => 'nullable|image|max:2048',
            'lampiran_2' => 'nullable|image|max:2048',
            'lampiran_3' => 'nullable|image|max:2048',
            'lampiran_4' => 'nullable|image|max:2048',
        ]);

        if ($data['tempat_perbaikan'] == 'dibengkel') {
            $data['alamat'] = null;
        }

        $data['user_id'] = auth()->user()->id;
        $data['status'] = 'Menunggu Konfirmasi';

        if (isset($request->lampiran_1)) {
            $validateData['lampiran_1'] = $request->file('lampiran_1')->store('lampiranLayanan', 'public');
        }
        if (isset($request->lampiran_2)) {
            $validateData['lampiran_2'] = $request->file('lampiran_2')->store('lampiranLayanan', 'public');
        }
        if (isset($request->lampiran_3)) {
            $validateData['lampiran_3'] = $request->file('lampiran_3')->store('lampiranLayanan', 'public');
        }
        if (isset($request->lampiran_4)) {
            $validateData['lampiran_4'] = $request->file('lampiran_4')->store('lampiranLayanan', 'public');
        }

        $createBooking = Booking::create($data);

        Montir::where('id', $request->montir_id)->update([
            'is_tersedia' => false
        ]);

        $total = 0;
        $totalBarang = 0;

        foreach ($request->pelayanan_id as $pelayanan_id) {
            BookingPelayanan::create([
                'booking_id' => $createBooking->id,
                'pelayanan_id' => $pelayanan_id
            ]);

            $pelayanan = Pelayanan::where('id', $pelayanan_id)->first();
            $total += $pelayanan->harga;
        }

        foreach ($request->barang_id as $barang_id) {
            $barang = Barang::where('id', $barang_id)->first();
            BarangBooking::create([
                'booking_id' => $createBooking->id,
                'barang_id' => $barang_id
            ]);

            $barang->update([
                'stok' => $barang->stok - 1
            ]);

            $totalBarang += $barang->harga;
        }

        Booking::where('id', $createBooking->id)->update([
            'total' => $total,
            'total_harga_barang' => $totalBarang
        ]);


        return redirect('/layanans')->with('success', 'Booking berhasil');
    }

    public function updateBarangLayanan(Request $request, BarangBooking $barang_booking)
    {
        // dd($request);
        $barangBooking = BarangBooking::findOrFail($barang_booking->id);
        $barangBooking->update([
            'kuantitas' => $request->kuantitas
        ]);

        $barangBooking =  BarangBooking::where('booking_id', $request->id)->get();
        // dd($barangBooking);

        $total = 0;

        foreach ($barangBooking as $barang) {
            $barangD = Barang::where('id', $barang->barang_id)->first();
            $total += $barangD->harga * $barang->kuantitas;
        }

        $booking = Booking::where('id', $request->id)->first();

        $booking->update([
            'total_harga_barang' => $total
        ]);

        return back();
    }

    public function hapusBarangLayanan(Request $request, BarangBooking $barang_booking)
    {
        $barangBooking = BarangBooking::findOrFail($barang_booking->id);
        $barangBooking->delete();

        $barangBooking =  BarangBooking::where('booking_id', $request->id)->get();
        // dd($barangBooking);

        $total = 0;

        foreach ($barangBooking as $barang) {
            $barangD = Barang::where('id', $barang->barang_id)->first();
            $total += $barangD->harga * $barang->kuantitas;
        }

        $booking = Booking::where('id', $request->id)->first();

        $booking->update([
            'total_harga_barang' => $total
        ]);

        return back();
    }

    public function hapusPelayanan(Request $request, BookingPelayanan $booking_pelayanan)
    {
        $bookingPelayanan = BookingPelayanan::findOrFail($booking_pelayanan->id);
        $bookingPelayanan->delete();

        $bookingPelayanan =  BookingPelayanan::where('booking_id', $request->id)->get();

        $total = 0;

        foreach ($bookingPelayanan as $pelayanan) {
            $pelayananD = Pelayanan::where('id', $pelayanan->pelayanan_id)->first();
            $total += $pelayananD->harga;
        }

        $booking = Booking::where('id', $request->id)->first();

        $booking->update([
            'total' => $total
        ]);

        return back();
    }
}