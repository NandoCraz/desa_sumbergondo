<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Keranjang;
use App\Models\Checkout;

class CreateSnapTokenService extends Midtrans
{
    protected $checkout;

    public function __construct($checkout)
    {
        parent::__construct();

        $this->checkout = $checkout;
    }

    public function getSnapToken()
    {
        $keranjangBarang = Keranjang::where('user_id', auth()->user()->id)->with(['barang', 'user'])->get();
        $barangs = [];
        foreach ($keranjangBarang as $keranjang) {
            foreach ($keranjangBarang as $keranjang) {
                array_push($barangs, [
                    'id' => $keranjang->barang->id,
                    'price' => $keranjang->barang->harga,
                    'quantity' => $keranjang->kuantitas,
                    'name' => $keranjang->barang->nama_barang
                ]);
            }
        }
        $params = [
            'transaction_details' => [
                'order_id' => $this->checkout->uuid,
                'gross_amount' => $this->checkout->total,
            ],
            'item_details' => $barangs,
            'customer_details' => [
                'first_name' => $this->checkout->daftarAlamat->nama_penerima,
                'email' => auth()->user()->email,
                'phone' => $this->checkout->daftarAlamat->no_hp,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
