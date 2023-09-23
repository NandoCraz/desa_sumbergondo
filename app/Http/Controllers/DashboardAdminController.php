<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Barang;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Montir;
use App\Models\Pelayanan;
use App\Models\Pengangkutan;
use App\Models\Tetangga;
use App\Models\User;
use App\Models\Warga;
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
      $menungguKonfirmasiBooking = Booking::where('status', 'Menunggu Konfirmasi')->get();
      $dikonfirmasi = Booking::where('status', 'Dikonfirmasi')->get();
      $sudahDibayar = Booking::where('status', 'Sudah Dibayar')->get();
      $hasilBooking = 0;
      foreach ($sudahDibayar as $sls) {
         $hasilBooking += $sls->total;
      }

      // data lainnya
      $users = User::where('role', 'user')->get();

      $pesanans = Checkout::withTrashed()->where('status', 4)->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
         ->whereYear('created_at', date('Y'))
         ->groupBy(DB::raw("Month(created_at)"))
         ->pluck('count', 'month_name');

      $bookings = Booking::withTrashed()->where('status', 'Sudah Dibayar')->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
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
         'belumDibayar' => $belumDibayar,
         'menungguKonfirmasi' => $menungguKonfirmasi,
         'diproses' => $diproses,
         'dikirim' => $dikirim,
         'penjualanSelesai' => $penjualanSelesai,
         'hasilPenjualan' => $hasilPenjualan,
         'menungguKonfirmasiBooking' => $menungguKonfirmasiBooking,
         'dikonfirmasi' => $dikonfirmasi,
         'sudahDibayar' => $sudahDibayar,
         'hasilBooking' => $hasilBooking,
         'users' => $users,
         'labelPesanan' => $labelPesanan,
         'labelBooking' => $labelBooking,
         'dataPesanan' => $dataPesanan,
         'dataBooking' => $dataBooking,
      ]);
   }

   public function seluruhUser()
   {
      $users = User::where('role', 'keluarga')->get();
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
      // dd($request->all());
      if (strpos($request->timestamp, ' to ')) {
         $tanggal = explode(' to ', $request->timestamp);
         $awal = Carbon::parse($tanggal[0])->format('Y-m-d');
         $akhir = Carbon::parse($tanggal[1])->format('Y-m-d');
         $checkouts = Checkout::with(['daftarAlamat', 'pesanans'])->whereBetween('created_at', [$awal, $akhir])->get();
      } else {
         $awal = Carbon::parse($request->timestamp)->format('Y-m-d');
         $akhir = $awal;
         $checkouts = Checkout::with(['daftarAlamat', 'pesanans'])->where('created_at', 'LIKE', '%' . $awal . '%')->get();
      }


      $total = 0;
      foreach ($checkouts as $checkout) {
         $total += $checkout->total;
      }

      $pdf = PDF::loadView('adminPage.partials.laporan.Lpenjualan', [
         'checkouts' => $checkouts,
         'total' => $total,
         'awal' => $awal,
         'akhir' => $akhir,
      ])->setPaper('a4', 'landscape');

      return $pdf->download('laporanPenjualan_' . $awal . '-' . $akhir . '.pdf');
   }

   public function laporanPdfLayanan(Request $request)
   {
      if (strpos($request->timestamp, ' to ')) {
         $tanggal = explode(' to ', $request->timestamp);
         $awal = Carbon::parse($tanggal[0])->format('Y-m-d');
         $akhir = Carbon::parse($tanggal[1])->format('Y-m-d');
         $bookings = Booking::with(['kategori'])->whereBetween('created_at', [$awal, $akhir])->get();
      } else {
         $awal = Carbon::parse($request->timestamp)->format('Y-m-d');
         $akhir = $awal;
         $bookings = Booking::with(['kategori'])->where('created_at', 'LIKE', '%' . $awal . '%')->get();
      }


      $total = 0;
      foreach ($bookings as $booking) {
         $total += $booking->total;
         $total += $booking->total_harga_barang;
      }

      $pdf = PDF::loadView('adminPage.partials.laporan.Llayanan', [
         'bookings' => $bookings,
         'total' => $total,
         'awal' => $awal,
         'akhir' => $akhir,
      ])->setPaper('a4', 'landscape');

      return $pdf->download('laporanLayanan_' . $awal . '-' . $akhir . '.pdf');
   }

   public function tambahAkun()
   {
      $wargas = Warga::all();
      $banks = Bank::all();
      return view('adminPage.components.tambahAkun', [
         'wargas' => $wargas,
         'banks' => $banks,
      ]);
   }

   public function proses_akun(Request $request)
   {
      $data = $request->validate([
         'name' => 'required|max:255',
         'bank_id' => 'required',
         'username' => 'required|max:255|unique:users',
         'email' => 'required|email|max:255|unique:users',
         'password' => 'required|min:5',
         'c_password' => 'required|same:password',
         'role' => 'required',
         'no_hp' => 'required|numeric',
         'picture_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $data['password'] = bcrypt($request->password);

      if ($request->hasFile('picture_profile')) {
         $data['picture_profile'] = $request->file('picture_profile')->store('profilePicture', 'public');
      }

      User::create($data);

      return redirect('/seluruh-user')->with('success', 'Akun berhasil ditambahkan');
   }

   public function get_rt(Request $request)
   {
      $rt = Tetangga::where('rw_id', $request->rw_id)->get();
      $response = $rt;
      return response()->json($response);
   }

   public function jadwalPengangkutan()
   {
      $jadwal = Pengangkutan::first();
      return view('adminPage.components.jadwalPengangkutan', [
         'jadwal' => $jadwal,
      ]);
   }

   public function simpan_jadwal(Request $request)
   {
      $data = $request->validate([
         'waktu' => 'required',
         'desk' => 'nullable',
      ]);

      $angkut = Pengangkutan::first();

      if (isset($angkut)) {
         Pengangkutan::first()->update($data);
      } else {
         Pengangkutan::create($data);
      }


      return redirect('/jadwal-pengangkutan')->with('success', 'Jadwal berhasil disimpan');
   }

   public function dataRw()
   {
      $data_rw = Warga::all();
      return view('adminPage.components.dataRw', [
         'data_rw' => $data_rw,
      ]);
   }
}
