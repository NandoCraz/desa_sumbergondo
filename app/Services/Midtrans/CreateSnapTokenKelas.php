<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenKelas extends Midtrans
{
    protected $pelatihan;

    public function __construct($pelatihan)
    {
        parent::__construct();

        $this->pelatihan = $pelatihan;
    }

    public function getSnapToken()
    {
        $pelatihans = [];
        array_push($pelatihans, [
            'id' => $this->pelatihan->id,
            'price' => $this->pelatihan->total,
            'quantity' => 1,
            'name' => 'Total Kelas'
        ]);
        $params = [
            'transaction_details' => [
                'order_id' => $this->pelatihan->uuid,
                'gross_amount' => $this->pelatihan->total,
            ],
            'item_details' => $pelatihans,
            'customer_details' => [
                'first_name' => $this->pelatihan->nama_pemesan,
                'email' => auth()->user()->email,
                'phone' => $this->pelatihan->no_telp,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
