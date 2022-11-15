<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    public function provinces()
    {
        $province = Provinsi::all();
        return $province;
    }

    public function cities($province_id)
    {
        $cities = Kota::where('province_id', $province_id)->get();
        return $cities;
    }

    public function cost(Request $request)
    {
        $response = Http::post('https://api.rajaongkir.com/starter/cost', [
            'key' => getenv('RAJA_ONGKIR_API_KEY'),
            'origin' => '444',
            'destination' => $request->kota_id,
            'weight' => $request->berat,
            'courier' => $request->kurir
        ]);
    }
}
