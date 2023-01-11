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
        $barangs = [];
        foreach ($this->checkout->pesanans as $pesanan) {
            array_push($barangs, [
                'id' => $pesanan->barang->id,
                'price' => $pesanan->barang->harga,
                'quantity' => $pesanan->kuantitas,
                'name' => $pesanan->barang->nama_barang
            ]);
        }
        array_push($barangs, [
            'id' => $this->checkout->id,
            'price' => $this->checkout->ongkir,
            'quantity' => 1,
            'name' => 'Ongkir'
        ]);
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
