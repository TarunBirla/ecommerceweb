@extends('layouts.admin')

@section('title', 'Process Order #' . $order->order_number . ' | Admin')
@section('page-title', 'Manage Order #' . $order->order_number)

@section('content')

<div style="display: grid; grid-template-columns: 1fr 380px; gap: 32px;">
    <!-- Left Column: Status Updater & Order Items -->
    <div>
        <!-- Status Updater Card -->
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; margin-bottom: 24px; box-shadow: var(--shadow-sm);">
            <h3 style="font-size: 1.2rem; margin-bottom: 16px;">Update Order Status & Logistics</h3>
            
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                @csrf
                <div>
                    <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Order Status</label>
                    <select name="order_status" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="packed" {{ $order->order_status == 'packed' ? 'selected' : '' }}>Packed</option>
                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="out_for_delivery" {{ $order->order_status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div>
                    <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Delivery Partner</label>
                    <input type="text" name="delivery_partner" value="{{ $order->delivery_partner }}" placeholder="e.g. Shiprocket / BlueDart" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                </div>

                <div style="grid-column: span 2;">
                    <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Tracking / AWB Number</label>
                    <input type="text" name="tracking_number" value="{{ $order->tracking_number }}" placeholder="e.g. AWB9876543210" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                </div>

                <div style="grid-column: span 2;">
                    <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Internal Order Notes</label>
                    <input type="text" name="notes" placeholder="Notes visible in status history..." style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                </div>

                <div style="grid-column: span 2;">
                    <button type="submit" class="btn btn-primary btn-sm">Save Order Status</button>
                </div>
            </form>
        </div>

        <!-- Ordered Items -->
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; margin-bottom: 24px;">
            <h3 style="font-size: 1.2rem; margin-bottom: 16px;">Order Items</h3>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td><strong>{{ $item->product_name }}</strong> {{ $item->variant_name ? "({$item->variant_name})" : '' }}</td>
                            <td style="font-size: 0.85rem; color: var(--muted);">{{ $item->sku }}</td>
                            <td>£{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td style="font-weight: 700; color: var(--green);">£{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Status Audit History -->
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px;">
            <h3 style="font-size: 1.2rem; margin-bottom: 16px;">Status History Log</h3>
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 12px;">
                @foreach($order->statusHistories as $h)
                    <li style="border-left: 3px solid var(--green); padding-left: 12px; font-size: 0.88rem;">
                        <div style="font-weight: 700;">{{ ucfirst($h->status) }}</div>
                        <div style="color: var(--ink-soft);">{{ $h->notes }}</div>
                        <div style="font-size: 0.78rem; color: var(--muted);">By: {{ $h->changedBy ? $h->changedBy->name : 'System' }} on {{ $h->created_at->format('d M Y H:i') }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Right Summary Card -->
    <div>
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm);">
            <a href="{{ route('account.invoice.download', $order->order_number) }}" target="_blank" class="btn btn-brass btn-block btn-sm" style="margin-bottom: 20px;">
                📄 Print Tax Invoice
            </a>

            <h4 style="margin-bottom: 12px;">Customer Details</h4>
            <p style="font-size: 0.88rem; color: var(--ink-soft); line-height: 1.6; margin-bottom: 20px;">
                <strong>{{ $order->user ? $order->user->name : 'Guest' }}</strong><br>
                Email: {{ $order->user ? $order->user->email : 'N/A' }}<br>
                Phone: {{ $order->user ? $order->user->phone : 'N/A' }}
            </p>

            <h4 style="margin-bottom: 12px;">Shipping Address</h4>
            <p style="font-size: 0.88rem; color: var(--ink-soft); line-height: 1.6; margin-bottom: 20px;">
                {{ $order->shipping_address_json['name'] ?? '' }}<br>
                {{ $order->shipping_address_json['address_line_1'] ?? '' }}<br>
                {{ $order->shipping_address_json['city'] ?? '' }}, {{ $order->shipping_address_json['state'] ?? '' }} - {{ $order->shipping_address_json['pincode'] ?? '' }}
            </p>

            <h4 style="margin-bottom: 12px;">Financial Summary</h4>
            <div style="font-size: 0.9rem; line-height: 1.8;">
                <div>Subtotal: £{{ number_format($order->subtotal, 2) }}</div>
                <div>Discount: -£{{ number_format($order->discount_amount, 2) }}</div>
                <div>Shipping: £{{ number_format($order->shipping_fee, 2) }}</div>
                <div>GST Tax: £{{ number_format($order->tax_amount, 2) }}</div>
                <hr style="border: none; border-top: 1px solid var(--line-soft); margin: 8px 0;">
                <div style="font-weight: 700; font-size: 1.2rem; color: var(--green);">Total: £{{ number_format($order->grand_total, 2) }}</div>
            </div>
        </div>
    </div>
</div>

@endsection
