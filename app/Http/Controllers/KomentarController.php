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
}
