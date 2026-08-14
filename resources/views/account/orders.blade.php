@extends('layouts.app')

@section('title', 'My Orders | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;">
    <h1 style="font-size: 2.2rem; margin-bottom: 32px;">Order History</h1>

    <div style="display: grid; grid-template-columns: 260px 1fr; gap: 36px;">
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px; height: fit-content;">
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 4px;">
                <li><a href="{{ route('account.dashboard') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Dashboard</a></li>
                <li><a href="{{ route('account.orders') }}" style="display: block; padding: 10px 14px; font-weight: 700; color: var(--green); background: var(--green-dim); border-radius: var(--radius);">My Orders</a></li>
                <li><a href="{{ route('account.profile') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Profile Info</a></li>
                <li><a href="{{ route('account.addresses') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Saved Addresses</a></li>
                <li><a href="{{ route('account.wishlist') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Wishlist</a></li>
            </ul>
        </div>

        <div>
            @if($orders->count() > 0)
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td style="font-weight: 700; color: var(--green);">{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td><span class="badge-status badge-info">{{ ucfirst($order->order_status) }}</span></td>
                                <td><span class="badge-status {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">{{ strtoupper($order->payment_status) }}</span></td>
                                <td style="font-weight: 700;">£{{ number_format($order->grand_total, 2) }}</td>
                                <td>
                                    <div style="display: flex; gap: 6px;">
                                        <a href="{{ route('account.orders.details', $order->order_number) }}" class="btn btn-outline btn-sm" style="padding: 4px 10px;">
                                            Track & Details
                                        </a>
                                        @if(in_array($order->order_status, ['confirmed', 'packed', 'shipped', 'delivered']))
                                            <a href="{{ route('account.orders.details', $order->order_number) }}" class="btn btn-outline btn-sm" style="color: var(--brass); border-color: var(--brass-2); padding: 4px 10px;">
                                                ★ Rate Products
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 24px;">{{ $orders->links() }}</div>
            @else
                <p style="color: var(--muted);">No orders found.</p>
            @endif
        </div>
    </div>
</div>

@endsection
