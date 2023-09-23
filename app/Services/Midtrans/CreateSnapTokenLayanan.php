<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenLayanan extends Midtrans
{
    protected $booking;

    public function __construct($booking)
    {
        parent::__construct();

        $this->booking = $booking;
    }

    public function getSnapToken()
    {
        $layanans = [];
        array_push($layanans, [
            'id' => $this->booking->id,
            'price' => $this->booking->total,
            'quantity' => 1,
            'name' => 'Total Layanan'
        ]);
        $params = [
            'transaction_details' => [
                'order_id' => $this->booking->uuid,
                'gross_amount' => $this->booking->total,
            ],
            'item_details' => $layanans,
            'customer_details' => [
                'first_name' => $this->booking->nama_pemesan,
                'email' => auth()->user()->email,
                'phone' => $this->booking->no_telp,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
