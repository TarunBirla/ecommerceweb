@extends('layouts.admin')

@section('title', 'Order Management | Admin')
@section('page-title', 'Order Management & Fulfillment')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <form action="{{ route('admin.orders.index') }}" method="GET" style="display: flex; gap: 12px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Order #" style="padding: 8px 14px; border: 1px solid var(--line); border-radius: var(--radius);">
        <select name="status" onchange="this.form.submit()" style="padding: 8px 14px; border: 1px solid var(--line); border-radius: var(--radius);">
            <option value="">All Statuses</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="packed" {{ request('status') == 'packed' ? 'selected' : '' }}>Packed</option>
            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
        </select>
        <button type="submit" class="btn btn-outline btn-sm">Filter</button>
    </form>
</div>

<table class="custom-table">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Order Status</th>
            <th>Payment Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td style="font-weight: 700; color: var(--green);">{{ $order->order_number }}</td>
                <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
                <td style="font-weight: 700;">£{{ number_format($order->grand_total, 2) }}</td>
                <td><span class="badge-status badge-info">{{ ucfirst($order->order_status) }}</span></td>
                <td><span class="badge-status {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">{{ strtoupper($order->payment_status) }}</span></td>
                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm" style="padding: 4px 12px;">Process Order</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 24px;">{{ $orders->links() }}</div>

@endsection
