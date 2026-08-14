@extends('layouts.app')

@section('title', 'Order Confirmation #' . $order->order_number . ' | Eccommers Web')

@section('content')

<div style="max-width: 800px; margin: 60px auto; padding: 0 24px; text-align: center;">
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 48px; box-shadow: var(--shadow-md);">
        <div style="width: 70px; height: 70px; background: var(--green-dim2); color: var(--green); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 20px;">
            ✓
        </div>

        <h1 style="font-size: 2.2rem; color: var(--green); margin-bottom: 10px;">Order Placed Successfully!</h1>
        <p style="color: var(--muted); font-size: 1.05rem; margin-bottom: 24px;">
            Thank you for your purchase. We have received your order and sent a confirmation to <strong>{{ $order->user->email }}</strong>.
        </p>

        <div style="background: var(--paper); border: 1px dashed var(--line); border-radius: var(--radius); padding: 20px; margin-bottom: 32px; display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; text-align: left;">
            <div>
                <span style="font-size: 0.78rem; color: var(--muted); text-transform: uppercase;">Order Number</span>
                <div style="font-weight: 700; font-size: 1.1rem; color: var(--ink);">{{ $order->order_number }}</div>
            </div>
            <div>
                <span style="font-size: 0.78rem; color: var(--muted); text-transform: uppercase;">Order Date</span>
                <div style="font-weight: 600; font-size: 0.95rem;">{{ $order->created_at->format('d M Y, h:i A') }}</div>
            </div>
            <div>
                <span style="font-size: 0.78rem; color: var(--muted); text-transform: uppercase;">Payment Status</span>
                <div>
                    <span class="badge-status {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                        {{ strtoupper($order->payment_status) }}
                    </span>
                </div>
            </div>
            <div>
                <span style="font-size: 0.78rem; color: var(--muted); text-transform: uppercase;">Total Amount</span>
                <div style="font-weight: 700; font-size: 1.1rem; color: var(--green);">£{{ number_format($order->grand_total, 2) }}</div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
            <a href="{{ route('account.orders.details', $order->order_number) }}" class="btn btn-primary">
                Track Order Status
            </a>
            <a href="{{ route('account.invoice.download', $order->order_number) }}" target="_blank" class="btn btn-brass">
                📄 Download Official Invoice
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline">
                Continue Shopping
            </a>
        </div>
    </div>
</div>

@endsection
