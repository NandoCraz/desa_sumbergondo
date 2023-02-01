<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\DaftarAlamat;
use App\Models\Keranjang;
use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\Midtrans\CreateSnapTokenService;

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
        // return $request;
        $alamat = DaftarAlamat::find($request->daftar_alamat_id);
        // dd($alamat);
        $keranjang = Keranjang::where('user_id', auth()->user()->id)->with(['barang'])->get();
        $weight = 0;
        foreach ($keranjang as $item) {
            $weight += $item->barang->berat * $item->kuantitas;
        }
        $response = Http::post('https://api.rajaongkir.com/starter/cost', [
            'key' => getenv('RAJA_ONGKIR_API_KEY'),
            'origin' => '444',
            'destination' => $alamat->kota_id,
            'weight' => $weight,
            'courier' => $request->courier,
        ]);

        return response()->json($response->json()['rajaongkir'], $response->status());
    }
}
