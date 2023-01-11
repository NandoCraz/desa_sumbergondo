<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangBooking;
use App\Models\Booking;
use App\Models\BookingPelayanan;
use App\Models\Montir;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenLayanan;

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
            'tempat_perbaikan' => 'required',
            'alamat' => 'required_if:tempat_perbaikan,==,dirumah|nullable|max:255',
            'tipe_mobil' => 'required',
            'no_telp' => 'required|numeric',
            'kendala' => 'nullable',
            'waktu' => 'required',
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
        $data['status'] = 'Konfirmasi Layanan';

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
        $barangBooking = BarangBooking::findOrFail($barang_booking->id);
        $barangBooking->update([
            'kuantitas' => $request->kuantitas
        ]);

        $barangBooking =  BarangBooking::where('booking_id', $request->id)->get();

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

    public function changeStatusBooking(Request $request, Booking $booking)
    {
        if ($request->status == 'konfirmasi') {
            Booking::where('id', $booking->id)->update([
                'status' => 'Menunggu Konfirmasi Admin'
            ]);
            return back()->with('success', 'Layanan Berhasil Dikonfirmasi');
        } elseif ($request->status == 'konfirmasiAdmin') {
            Booking::where('id', $booking->id)->update([
                'status' => 'Persetujuan Layanan'
            ]);
            return back()->with('success', 'Layanan Berhasil Dikonfirmasi');
        } elseif ($request->status == 'deal') {
            Booking::where('id', $booking->id)->update([
                'status' => 'Pembayaran'
            ]);
            return back()->with('success', 'Layanan Berhasil Dikonfirmasi');
        } elseif ($request->status == 'dikerjakan') {
            Booking::where('id', $booking->id)->update([
                'status' => 'Sedang Dikerjakan'
            ]);
            return back()->with('success', 'Layanan Dikerjakan');
        } elseif ($request->status == 'selesai') {
            Booking::where('id', $booking->id)->update([
                'status' => 'Selesai'
            ]);
            return back()->with('success', 'Layanan Telah Diselesaikan');
        }
    }

    public function updateHarga(Request $request, Booking $booking)
    {
        $booking = Booking::where('id', $booking->id)->first();
        $booking->update([
            'total' => $request->harga_akhir,
            'upd_biaya' => true
        ]);
        return back()->with('success', 'Biaya Pelayanan Telah Ditetapkan');
    }

    public function penawaranBiaya(Request $request, Booking $booking)
    {
        $booking = Booking::where('id', $booking->id)->first();
        $request->validate([
            'penawaran' => 'numeric'
        ]);

        if ($booking->penawaran_1 == null) {
            $booking->update([
                'penawaran_1' => $request->penawaran,
                'status_penawaran' => 'Diajukan'
            ]);
        } elseif ($booking->penawaran_1 != null && $booking->penawaran_2 == null) {
            $booking->update([
                'penawaran_2' => $request->penawaran,
                'status_penawaran' => 'Diajukan'
            ]);
        } elseif ($booking->penawaran_2 != null && $booking->penawaran_3 == null) {
            $booking->update([
                'penawaran_3' => $request->penawaran,
                'status_penawaran' => 'Diajukan'
            ]);
        }

        return back()->with('success', 'Berhasil Mengajukan Tawaran');
    }

    public function hapusLayanan(Booking $booking)
    {
        $booking = Booking::where('id', $booking->id)->first();
        Montir::where('id', $booking->montir_id)->update([
            'is_tersedia' => true
        ]);
        BookingPelayanan::where('booking_id', $booking->id)->delete();
        $barangBooking = BarangBooking::where('booking_id', $booking->id)->get();
        foreach ($barangBooking as $barang) {
            $barangD = Barang::where('id', $barang->barang_id)->first();
            $barangD->update([
                'stok' => $barangD->stok + $barang->kuantitas
            ]);
        }
        $barangBooking->delete();


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
