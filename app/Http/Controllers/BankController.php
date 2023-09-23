<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function dataBank()
    {
        $banks = Bank::all();
        return view('adminPage.components.dataBank', [
            'banks' => $banks
        ]);
    }

    public function tambahDataBank()
    {
        return view('adminPage.components.tambahDataBank');
    }

    public function simpanDataBank(Request $request)
    {
        $data = $request->validate([
            'nama_bank' => 'required',
        ]);

        Bank::create($data);
        return redirect('/bank-sampah/data-bank')->with('success', 'Data bank berhasil ditambahkan');
    }

    public function listNasabah(Bank $bank)
    {
        $nasabahs = User::where('bank_id', $bank->id)->get();
        return view('adminPage.components.listNasabah', [
            'nasabahs' => $nasabahs
        ]);
    }

    public function updateSaldo(User $user)
    {
        $user_id = $user->id;
        return view('adminPage.components.tambahSaldo', [
            'user_id' => $user_id,
        ]);
    }

    public function simpanSaldo(Request $request)
    {
        $data = $request->validate([
            'saldo_bank' => 'required|numeric',
        ]);

        $user = User::where('id', $request->user_id)->first();
        $total = $user->saldo_bank + $request->saldo_bank;
        $user->update([
            'saldo_bank' => $total,
        ]);
        return redirect('/bank-sampah/data-bank')->with('success', 'Saldo berhasil ditambahkan');
    }

    public function tagihanKomposter() {
        $users = User::where('role', 'keluarga')->get();
        return view('adminPage.components.tagihanKomposter', [
            'users' => $users,
        ]);
    }

    public function tambahTagihanKomposter(User $user)
    {
        $user_id = $user->id;
        return view('adminPage.components.tambahTagihanKomposter', [
            'user_id' => $user_id,
        ]);
    }

    public function updateTagihanKomposter(Request $request)
    {
        $data = $request->validate([
            'tagihan_komposter' => 'required|numeric',
        ]);

        $user = User::where('id', $request->user_id)->first();
        $total = $user->tagihan_komposter + $request->tagihan_komposter;
        $user->update([
            'tagihan_komposter' => $total,
        ]);
        return redirect('/bank-sampah/komposter')->with('success', 'Tagihan berhasil ditambahkan');
    }
}
