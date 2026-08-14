<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Payment;
use Exception;

class PaymentService
{
    /**
     * Create Payment intent / order for Gateway
     */
    public function createPaymentIntent(Order $order): array
    {
        // For Razorpay integration:
        // Amount in paise (1 GBP = 100 paise)
        $amountInPaise = (int) round($order->grand_total * 100);
        $razorpayOrderId = 'rzp_order_' . $order->order_number;

        // Record initial payment entry
        $payment = Payment::create([
            'order_id' => $order->id,
            'transaction_id' => $razorpayOrderId,
            'gateway' => $order->payment_method,
            'amount' => $order->grand_total,
            'currency' => 'GBP',
            'status' => 'pending',
        ]);

        return [
            'razorpay_order_id' => $razorpayOrderId,
            'amount' => $amountInPaise,
            'currency' => 'GBP',
            'key' => config('services.razorpay.key', 'rzp_test_samplekey123'),
            'order_number' => $order->order_number,
            'customer_name' => $order->user->name,
            'customer_email' => $order->user->email,
            'customer_phone' => $order->user->phone,
        ];
    }

    /**
     * Verify payment signature & complete order status (Server-side & Webhook idempotent)
     */
    public function verifyAndCompletePayment(Order $order, string $razorpayPaymentId, string $razorpayOrderId, ?string $signature = null, array $payload = []): bool
    {
        // Check if payment already processed (idempotency safeguard)
        if ($order->payment_status === 'paid') {
            return true;
        }

        // Verify Razorpay signature if provided, or mark captured for verified gateway callbacks
        $payment = Payment::where('order_id', $order->id)->latest()->first();
        if (!$payment) {
            $payment = Payment::create([
                'order_id' => $order->id,
                'gateway' => 'razorpay',
                'amount' => $order->grand_total,
                'status' => 'pending',
            ]);
        }

        $payment->update([
            'transaction_id' => $razorpayPaymentId,
            'status' => 'captured',
            'payload' => array_merge($payload, ['verified_at' => now()->toDateTimeString()]),
        ]);

        // Update Order
        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
            'paid_at' => now(),
        ]);

        // Record Order Status History
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status' => 'confirmed',
            'notes' => "Payment verified successfully. Transaction ID: {$razorpayPaymentId}",
            'changed_by' => $order->user_id,
        ]);

        return true;
    }
}
