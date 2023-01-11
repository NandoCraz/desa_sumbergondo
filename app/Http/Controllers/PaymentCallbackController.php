<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Checkout;
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
                if ($checkout = Checkout::find($order->id)) {
                    Checkout::where('id', $order->id)->update([
                        'payment_status' => 2,
                        'status' => 1,
                    ]);
                } elseif ($booking = Booking::find($order->id)) {
                    Booking::where('id', $order->id)->update([
                        'payment_status' => 2,
                    ]);
                }
            }

            if ($callback->isExpire()) {
                if ($checkout = Checkout::find($order->id)) {
                    Checkout::where('id', $order->id)->update([
                        'payment_status' => 3,
                    ]);
                } elseif ($booking = Booking::find($order->id)) {
                    Booking::where('id', $order->id)->update([
                        'payment_status' => 3,
                    ]);
                }
            }

            if ($callback->isCancelled()) {
                if ($checkout = Checkout::find($order->id)) {
                    Checkout::where('id', $order->id)->update([
                        'payment_status' => 4,
                    ]);
                } elseif ($booking = Booking::find($order->id)) {
                    Booking::where('id', $order->id)->update([
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
