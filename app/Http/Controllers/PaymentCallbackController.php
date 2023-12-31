<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\Pelatihan;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if ($callback->isSuccess()) {
                if ($checkout = Checkout::where('uuid', $order->uuid)->first()) {
                    Checkout::where('uuid', $order->uuid)->update([
                        'payment_status' => 2,
                        'status' => 1,
                    ]);
                } elseif ($booking = Booking::where('uuid', $order->uuid)->first()) {
                    Booking::where('uuid', $order->uuid)->update([
                        'payment_status' => 2,
                    ]);
                } elseif ($pelatihan = Pelatihan::where('uuid', $order->uuid)->first()) {
                    Pelatihan::where('uuid', $order->uuid)->update([
                        'payment_status' => 2,
                    ]);
                }
            }

            if ($callback->isExpire()) {
                if ($checkout = Checkout::where('uuid', $order->uuid)->first()) {

                    $checkout = Checkout::where('uuid', $order->uuid)->first();
                    $checkout->update([
                        'payment_status' => 3,
                    ]);

                    foreach ($checkout->pesanans as $pesanan) {
                        $barang = Barang::where('id', $pesanan->barang_id)->first();
                        $barang->update([
                            'stok' => $barang->stok + $pesanan->kuantitas,
                        ]);
                    }
                } elseif ($booking = Booking::where('uuid', $order->uuid)->first()) {
                    Booking::where('uuid', $order->uuid)->update([
                        'payment_status' => 3,
                    ]);
                } elseif ($pelatihan = Pelatihan::where('uuid', $order->uuid)->first()) {
                    Pelatihan::where('uuid', $order->uuid)->update([
                        'payment_status' => 3,
                    ]);
                }
            }

            if ($callback->isCancelled()) {
                if ($checkout = Checkout::where('uuid', $order->uuid)->first()) {
                    Checkout::where('uuid', $order->uuid)->update([
                        'payment_status' => 4,
                    ]);
                } elseif ($booking = Booking::where('uuid', $order->uuid)->first()) {
                    Booking::where('uuid', $order->uuid)->update([
                        'payment_status' => 3,
                    ]);
                } elseif ($pelatihan = Pelatihan::where('uuid', $order->uuid)->first()) {
                    Pelatihan::where('uuid', $order->uuid)->update([
                        'payment_status' => 3,
                    ]);
                }
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notification successfully processed',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key not verified',
                ], 403);
        }
    }
}
