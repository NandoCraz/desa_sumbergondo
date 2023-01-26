<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        $komentars = Komentar::latest()->get();

        return view('adminPage.components.seluruhKomentar.seluruhKomentar', [
            'komentars' => $komentars
        ]);
    }
    public function simpanKomentar(Request $request)
    {
        // return $request;
        $data = $request->validate([
            'komentar' => 'max:255'
        ]);

        $data['user_id'] = auth()->user()->id;

        Komentar::create($data);

        return redirect('/')->with('success', 'Komentar Disimpan');
    }

    public function balasanKomentar(Komentar $komentar)
    {
        $komentar = Komentar::findOrFail($komentar->id);

        $html = "";
        if (!empty($komentar)) {
            if ($komentar->balasan != null) {
                $html = "<div class='container'>
                <div class='row justify-content-start'>
                    <div class='col-lg-10'>
                        <p class='fs-6 fw-bold'>Ulasan " . $komentar->user->name . "</p>
                        <div class='card'>
                            <div class='card-body'>
                                " . $komentar->komentar . "
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row justify-content-end mt-4'>
                    <div class='col-lg-10'>
                        <p class='fs-6 fw-bold text-end'>Balasan Admin</p>
                        <div class='card'>
                            <div class='card-body'>
                                " . $komentar->balasan . "
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
            } else {
                $html = "<div class='container'>
                <div class='row justify-content-start'>
                    <div class='col-lg-10'>
                        <p class='fs-6 fw-bold'>Ulasan " . $komentar->user->name . "</p>
                        <div class='card'>
                            <div class='card-body'>
                                " . $komentar->komentar . "
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
            }
        }
        $response['html'] = $html;

        return response()->json($response);
    }

    public function getKomentarUser(Komentar $komentar)
    {
        $komentar = Komentar::findOrFail($komentar->id);

        $html = "";

        if (!empty($komentar)) {
            if ($komentar->balasan != null) {
                $html = "<div class='container'>
                <div class='row justify-content-start'>
                    <div class='col-lg-12'>
                        <p class='fs-6 fw-bold'>Ulasan " . $komentar->user->name . "</p>
                        <div class='card'>
                            <div class='card-body'>
                                " . $komentar->komentar . "
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row justify-content-start mt-5 d-none' id='balas'>
                    <div class='col-lg-12'>
                        <p class='fs-6 fw-bold'>Balasan Admin</p>
                        <div class='card'>
                            <div class='card-body'>
                                " . $komentar->balasan . "
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
            } else {
                $html = "<div class='container'>
                <div class='row justify-content-start'>
                    <div class='col-lg-12'>
                        <p class='fs-6 fw-bold'>Ulasan " . $komentar->user->name . "</p>
                        <div class='card'>
                            <div class='card-body'>
                                " . $komentar->komentar . "
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row justify-content-start mt-5 d-none' id='balas'>
                    <div class='col-lg-12'>
                        <p class='fs-6 fw-bold'>Balas Ulasan</p>
                        <form action='/balasanKomentarAdmin/" . $komentar->id . "' method='post'>
                            <input type='hidden' name='_token' value='" . csrf_token() . "' />
                            <textarea name='balasan' id='balasan' class='form-control w-100' rows='5' style='resize:none;' required></textarea>
                            <button type='submit' class='btn btn-dark text-light mt-3'>Balas Komentar</button>
                        </form>
                    </div>
                </div>
            </div>";
            }
        }
        $response['html'] = $html;

        return response()->json($response);
    }

    public function balasanAdmin(Request $request, Komentar $komentar)
    {
        $komentar = Komentar::findOrFail($komentar->id);
        $komentar->update([
            'balasan' => $request->balasan
        ]);

        return back()->with('success', 'Komentar Berhasil Dibalas');
    }
}
