@extends('layouts.app')

@section('title', 'My Account Dashboard | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;">
    <h1 style="font-size: 2.2rem; margin-bottom: 32px;">My Account</h1>

    <div style="display: grid; grid-template-columns: 260px 1fr; gap: 36px;">
        <!-- Account Sidebar -->
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px; height: fit-content;">
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 4px;">
                <li><a href="{{ route('account.dashboard') }}" style="display: block; padding: 10px 14px; font-weight: 700; color: var(--green); background: var(--green-dim); border-radius: var(--radius);">Dashboard</a></li>
                <li><a href="{{ route('account.orders') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">My Orders</a></li>
                <li><a href="{{ route('account.profile') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Profile Info</a></li>
                <li><a href="{{ route('account.addresses') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Saved Addresses</a></li>
                <li><a href="{{ route('account.wishlist') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Wishlist</a></li>
            </ul>
        </div>

        <!-- Dashboard Content -->
        <div>
            <!-- Stats -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px;">
                <div class="stat-card">
                    <span class="label">Total Orders</span>
                    <div class="value">{{ $totalOrdersCount }}</div>
                </div>
                <div class="stat-card">
                    <span class="label">Total Spent</span>
                    <div class="value">£{{ number_format($totalSpent, 2) }}</div>
                </div>
            </div>

            <!-- Recent Orders -->
            <h3 style="font-size: 1.4rem; margin-bottom: 20px;">Recent Orders</h3>
            @if($recentOrders->count() > 0)
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td style="font-weight: 700; color: var(--green);">{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td><span class="badge-status badge-info">{{ ucfirst($order->order_status) }}</span></td>
                                <td><span class="badge-status {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">{{ strtoupper($order->payment_status) }}</span></td>
                                <td style="font-weight: 700;">£{{ number_format($order->grand_total, 2) }}</td>
                                <td>
                                    <a href="{{ route('account.orders.details', $order->order_number) }}" class="btn btn-outline btn-sm">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: var(--muted);">You haven't placed any orders yet.</p>
            @endif
        </div>
    </div>
</div>

@endsection
