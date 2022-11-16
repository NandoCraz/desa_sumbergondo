<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    public function provinces(Request $request)
    {
        if (isset($request->provinsi)) {
            $data = new Kota();
            $data = $data->where('province_id', $request->provinsi)->get();
            if ($data) {
                return response()->json($data, 200);
            }
            return response()->json([], 200);
        } else {
            $data = new Kota();
            return response()->json($data->get(), 200);
        }
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
