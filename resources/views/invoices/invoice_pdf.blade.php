<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #14150F; padding: 40px; margin: 0; background: #fff; }
        .invoice-box { max-width: 800px; margin: auto; border: 1px solid #E3DFCF; padding: 30px; border-radius: 4px; }
        .top-row { display: flex; justify-content: space-between; margin-bottom: 30px; border-bottom: 2px solid #0E3D2A; padding-bottom: 20px; }
        .company-title { font-size: 24px; font-weight: bold; color: #0E3D2A; }
        .inv-details { text-align: right; font-size: 14px; color: #42463C; }
        .address-row { display: flex; justify-content: space-between; margin-bottom: 30px; font-size: 14px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background: #F6F3EB; color: #14150F; text-align: left; padding: 12px; font-size: 12px; text-transform: uppercase; border-bottom: 1px solid #E3DFCF; }
        td { padding: 12px; border-bottom: 1px solid #EBE7D9; font-size: 14px; }
        .total-box { text-align: right; font-size: 14px; line-height: 1.8; }
        .grand-total { font-size: 20px; font-weight: bold; color: #0E3D2A; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="no-print" style="max-width: 800px; margin: 0 auto 20px; text-align: right;">
    <button onclick="window.print()" style="background: #0E3D2A; color: #fff; border: none; padding: 10px 20px; font-weight: bold; border-radius: 4px; cursor: pointer;">🖨️ Print / Save PDF Invoice</button>
</div>

<div class="invoice-box">
    <div class="top-row">
        <div>
            <div class="company-title">Eccommers Web</div>
            <div style="font-size: 12px; color: #83887B;">PetChem Industrial Hub, Tower A, Sector 62, Noida, UP</div>
            <div style="font-size: 12px; color: #83887B;">GSTIN: 07AAAAA0000A1Z5 | Support: phil.andreson@nexteck.uk</div>
        </div>
        <div class="inv-details">
            <h2 style="margin: 0; color: #0E3D2A;">TAX INVOICE</h2>
            <div><strong>Invoice #:</strong> INV-{{ $order->order_number }}</div>
            <div><strong>Order #:</strong> {{ $order->order_number }}</div>
            <div><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</div>
            <div><strong>Payment:</strong> {{ strtoupper($order->payment_method) }} ({{ strtoupper($order->payment_status) }})</div>
        </div>
    </div>

    <div class="address-row">
        <div>
            <strong style="color: #0E3D2A;">Billed & Shipped To:</strong><br>
            {{ $order->shipping_address_json['name'] ?? $order->user->name }}<br>
            {{ $order->shipping_address_json['address_line_1'] ?? '' }}<br>
            {{ $order->shipping_address_json['city'] ?? '' }}, {{ $order->shipping_address_json['state'] ?? '' }} - {{ $order->shipping_address_json['pincode'] ?? '' }}<br>
            Phone: {{ $order->shipping_address_json['phone'] ?? $order->user->phone }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Item Description</th>
                <th>SKU</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $item->product_name }}</strong> {{ $item->variant_name ? "({$item->variant_name})" : '' }}</td>
                    <td style="font-size: 12px; color: #83887B;">{{ $item->sku }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>£{{ number_format($item->unit_price, 2) }}</td>
                    <td>£{{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <div>Item Subtotal: £{{ number_format($order->subtotal, 2) }}</div>
        @if($order->discount_amount > 0)
            <div style="color: #B4552C;">Discount Coupon ({{ $order->coupon_code }}): -£{{ number_format($order->discount_amount, 2) }}</div>
        @endif
        <div>Shipping Fee: £{{ number_format($order->shipping_fee, 2) }}</div>
        <div>CGST + SGST (18%): £{{ number_format($order->tax_amount, 2) }}</div>
        <hr style="border: none; border-top: 1px solid #E3DFCF; margin: 10px 0;">
        <div class="grand-total">Grand Total: £{{ number_format($order->grand_total, 2) }}</div>
    </div>

    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #E3DFCF; text-align: center; font-size: 12px; color: #83887B;">
        This is a computer-generated tax invoice. Thank you for shopping with Eccommers Web!
    </div>
</div>

</body>
</html>
