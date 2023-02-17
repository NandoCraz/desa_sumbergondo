<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Montir;
use App\Models\Pelayanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DashboardAdminController extends Controller
{
   public function index()
   {
      // master data
      $kategoris = Kategori::all();
      $barangs = Barang::all();
      $barangSiap = Barang::where('stok', '!=', 0)->get();
      $montirs = Montir::all();
      $pelayanans = Pelayanan::all();

      // penjualan
      $belumDibayar = Checkout::where('payment_status', '1')->get();
      $menungguKonfirmasi = Checkout::where('status', '1')->get();
      $diproses = Checkout::where('status', '2')->get();
      $dikirim = Checkout::where('status', '3')->get();
      $penjualanSelesai = Checkout::where('status', '4')->get();
      $hasilPenjualan = 0;
      foreach ($penjualanSelesai as $selesai) {
         $hasilPenjualan += $selesai->total;
      }

      // booking
      $menungguAdmin = Booking::where('status', 'Menunggu Konfirmasi Admin')->get();
      $penawaran = Booking::where('status_penawaran', 'Diajukan')->get();
      $pembayaran = Booking::where('status', 'Pembayaran')->get();
      $dikerjakan = Booking::where('status', 'Sedang Dikerjakan')->get();
      $selesai = Booking::where('status', 'Selesai')->get();
      $hasilBooking = 0;
      foreach ($selesai as $sls) {
         $hasilBooking += $sls->total;
         $hasilBooking += $sls->total_harga_barang;
      }

      // data lainnya
      $users = User::where('role', 'user')->get();
      $komentars = Komentar::all();

      $pesanans = Checkout::where('status', 4)->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
         ->whereYear('created_at', date('Y'))
         ->groupBy(DB::raw("Month(created_at)"))
         ->pluck('count', 'month_name');

      $bookings = Booking::where('status', 'Selesai')->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
         ->whereYear('created_at', date('Y'))
         ->groupBy(DB::raw("Month(created_at)"))
         ->pluck('count', 'month_name');

      $labelPesanan = $pesanans->keys();
      $dataPesanan = $pesanans->values();
      $labelBooking = $bookings->keys();
      $dataBooking = $bookings->values();

      return view('adminPage.components.dashboard', [
         'kategoris' => $kategoris,
         'barangs' => $barangs,
         'barangSiap' => $barangSiap,
         'montirs' => $montirs,
         'pelayanans' => $pelayanans,
         'belumDibayar' => $belumDibayar,
         'menungguKonfirmasi' => $menungguKonfirmasi,
         'diproses' => $diproses,
         'dikirim' => $dikirim,
         'penjualanSelesai' => $penjualanSelesai,
         'hasilPenjualan' => $hasilPenjualan,
         'menungguAdmin' => $menungguAdmin,
         'penawaran' => $penawaran,
         'pembayaran' => $pembayaran,
         'dikerjakan' => $dikerjakan,
         'selesai' => $selesai,
         'hasilBooking' => $hasilBooking,
         'users' => $users,
         'komentars' => $komentars,
         'labelPesanan' => $labelPesanan,
         'labelBooking' => $labelBooking,
         'dataPesanan' => $dataPesanan,
         'dataBooking' => $dataBooking,
      ]);
   }

   public function seluruhUser()
   {
      $users = User::where('role', 'user')->get();
      return view('adminPage.components.seluruhUser.seluruhUser', [
         'users' => $users,
      ]);
   }

   public function getUserDetail(User $user)
   {
      $user = User::findOrFail($user->id);

      $html = "";
      if (!empty($user)) {
         $html = "<tr>
              <td width='30%'><b>ID</b></td>
              <td width='70%'>: " . $user->id . "</td>
           </tr>
           <tr>
              <td width='30%'><b>Nama</b></td>
              <td width='70%'>: " . $user->name . "</td>
           </tr>
           <tr>
              <td width='30%'><b>Username</b></td>
              <td width='70%'>: " . $user->username . "</td>
           </tr>
           <tr>
              <td width='30%'><b>Email</b></td>
              <td width='70%'>: " . $user->email . "</td>
           </tr>
           <tr>
              <td width='30%'><b>No. Handphone</b></td>
              <td width='70%'>: " . $user->no_hp . "</td>
           </tr>
           <tr>
              <td width='50%'><img class='mt-3 rounded' width='200' src='" . asset('storage/' . $user->picture_profile) . "'></td>
           </tr>";
      }
      $response['html'] = $html;

      return response()->json($response);
   }

   public function laporanPdf(Request $request)
   {
      $awal = Carbon::parse($request->tglAwal)->format('Y-m-d');
      $akhir = Carbon::parse($request->tglAkhir)->format('Y-m-d');
      $checkouts = Checkout::with(['daftarAlamat', 'pesanans'])->whereBetween('created_at', [$awal, $akhir])->get();

      $total = 0;
      foreach ($checkouts as $checkout) {
         $total += $checkout->total;
      }

      $pdf = PDF::loadView('adminPage.partials.laporan.Lpenjualan', [
         'checkouts' => $checkouts,
         'total' => $total,
      ]);

      return $pdf->download('laporanPenjualan_' . $awal . '-' . $akhir . '.pdf');
   }
}
