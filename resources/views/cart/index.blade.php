@extends('layouts.app')

@section('title', 'Your Shopping Cart | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;">
    <h1 style="font-size: 2.2rem; margin-bottom: 32px;">Shopping Cart</h1>

    @if($cart && $cart->items->count() > 0)
        <div style="display: grid; grid-template-columns: 1fr 380px; gap: 36px;">
            <!-- Cart Items Table -->
            <div>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 16px;">
                                        <img src="{{ $item->variant && $item->variant->image ? $item->variant->image : ($item->product->primaryImage ? $item->product->primaryImage->image_path : 'https://via.placeholder.com/60') }}" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius);">
                                        <div>
                                            <a href="{{ route('products.show', $item->product->slug) }}" style="font-weight: 600; color: var(--ink);">
                                                {{ $item->product->name }}
                                            </a>
                                            @if($item->variant)
                                                <div style="font-size: 0.8rem; color: var(--muted);">Variant: {{ $item->variant->variant_name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight: 600;">£{{ number_format($item->unit_price, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: flex; align-items: center; gap: 6px;">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px; padding: 6px; border: 1px solid var(--line); border-radius: var(--radius); text-align: center;">
                                        <button type="submit" class="btn btn-outline btn-sm" style="padding: 6px 10px;">Update</button>
                                    </form>
                                </td>
                                <td style="font-weight: 700; color: var(--green);">£{{ number_format($item->subtotal, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; color: var(--clay); cursor: pointer; font-size: 0.85rem; font-weight: 600;">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary Box -->
            <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 28px; box-shadow: var(--shadow-sm); height: fit-content;">
                <h3 style="font-size: 1.4rem; margin-bottom: 20px; border-bottom: 1px solid var(--line-soft); padding-bottom: 10px;">Order Summary</h3>
                
                @php
                    $subtotal = $cart->items->sum('subtotal');
                    $taxEst = round($subtotal * 0.18, 2);
                    $grandTotal = $subtotal + $taxEst;
                @endphp

                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem;">
                    <span style="color: var(--muted);">Subtotal</span>
                    <span style="font-weight: 600;">£{{ number_format($subtotal, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem;">
                    <span style="color: var(--muted);">Estimated 18% GST</span>
                    <span style="font-weight: 600;">£{{ number_format($taxEst, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 0.95rem;">
                    <span style="color: var(--muted);">Shipping</span>
                    <span style="color: var(--green); font-weight: 600;">Calculated at Checkout</span>
                </div>

                <div style="border-top: 1px solid var(--line); padding-top: 16px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: baseline;">
                    <span style="font-size: 1.1rem; font-weight: 700;">Est. Total</span>
                    <span style="font-size: 1.8rem; font-weight: 700; color: var(--green);">£{{ number_format($grandTotal, 2) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block" style="padding: 14px 24px; font-size: 1.05rem;">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    @else
        <div style="background: var(--white); border: 1px solid var(--line); padding: 60px; text-align: center; border-radius: var(--radius);">
            <h3 style="font-size: 1.5rem; color: var(--ink-soft); margin-bottom: 12px;">Your Cart is Empty</h3>
            <p style="color: var(--muted); margin-bottom: 24px;">Explore our industrial catalog and handcrafted apparel to add items.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    @endif
</div>

@endsection
