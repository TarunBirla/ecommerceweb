@extends('layouts.app')

@section('title', 'Order Details #' . $order->order_number . ' | Eccommers Web')

@section('content')

<div style="max-width: 1100px; margin: 40px auto; padding: 0 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 2rem;">Order Details #{{ $order->order_number }}</h1>
            <p style="color: var(--muted); font-size: 0.9rem;">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <a href="{{ route('account.invoice.download', $order->order_number) }}" target="_blank" class="btn btn-brass btn-sm">
            📄 Print Invoice
        </a>
    </div>

    <!-- Stepper Status Timeline -->
    @php
        $statuses = ['pending' => 'Order Placed', 'confirmed' => 'Confirmed', 'packed' => 'Packed', 'shipped' => 'Shipped', 'delivered' => 'Delivered'];
        $currentStatusKey = array_search($order->order_status, array_keys($statuses));
        if ($currentStatusKey === false) $currentStatusKey = 1;
    @endphp
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 32px; margin-bottom: 32px; box-shadow: var(--shadow-sm);">
        <h3 style="font-size: 1.2rem; margin-bottom: 24px;">Delivery Tracking Timeline</h3>
        <div style="display: flex; justify-content: space-between; position: relative;">
            @php $idx = 0; @endphp
            @foreach($statuses as $stKey => $stLabel)
                <div style="text-align: center; position: relative; z-index: 2; flex: 1;">
                    <div style="width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; margin: 0 auto 8px;"
                         style="{{ $idx <= $currentStatusKey ? 'background: var(--green); color: var(--white);' : 'background: var(--paper-2); color: var(--muted);' }}">
                        {{ $idx + 1 }}
                    </div>
                    <div style="font-size: 0.85rem; font-weight: 600; {{ $idx <= $currentStatusKey ? 'color: var(--green);' : 'color: var(--muted);' }}">{{ $stLabel }}</div>
                </div>
                @php $idx++; @endphp
            @endforeach
        </div>

        @if($order->tracking_number)
            <div style="background: var(--paper); border: 1px solid var(--line); border-radius: var(--radius); padding: 14px 20px; margin-top: 24px; display: flex; justify-content: space-between; font-size: 0.9rem;">
                <span>Delivery Partner: <strong>{{ $order->delivery_partner ?: 'Standard Express' }}</strong></span>
                <span>Tracking AWB #: <strong style="color: var(--green);">{{ $order->tracking_number }}</strong></span>
            </div>
        @endif
    </div>

    <!-- Items Table -->
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 28px; margin-bottom: 32px;">
        <h3 style="font-size: 1.2rem; margin-bottom: 20px;">Ordered Products</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td style="font-weight: 600;">{{ $item->product_name }} {{ $item->variant_name ? "({$item->variant_name})" : '' }}</td>
                        <td style="font-size: 0.85rem; color: var(--muted);">{{ $item->sku }}</td>
                        <td>£{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="font-weight: 700; color: var(--green);">£{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Return / Refund Request Section -->
    @if(in_array($order->order_status, ['delivered', 'confirmed']) && $order->order_status !== 'return_requested')
        <div style="background: var(--paper-2); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px;">
            <h4 style="margin-bottom: 10px;">Request Return / Refund</h4>
            <form action="{{ route('account.orders.return', $order->order_number) }}" method="POST" style="display: flex; gap: 12px; flex-wrap: wrap;">
                @csrf
                <select name="reason" style="padding: 8px 12px; border: 1px solid var(--line); border-radius: var(--radius);">
                    <option value="Damaged Item">Damaged in Transit</option>
                    <option value="Wrong Product">Received Wrong Product</option>
                    <option value="Defective Unit">Defective Unit</option>
                </select>
                <input type="text" name="description" placeholder="Provide additional details..." required style="flex: 1; min-width: 250px; padding: 8px 12px; border: 1px solid var(--line); border-radius: var(--radius);">
                <button type="submit" class="btn btn-clay btn-sm">Submit Return Request</button>
            </form>
        </div>
    @endif
</div>

@endsection
