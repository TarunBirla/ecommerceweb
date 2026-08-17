@extends('layouts.app')

@section('title', 'Order Details #' . $order->order_number . ' | Eccommers Web')

@section('content')

<div style="max-width: 1100px; margin: 40px auto; padding: 0 24px;" x-data="{ openReviewModal: false, activeProductId: null, activeProductName: '' }">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 2rem;">Order Details #{{ $order->order_number }}</h1>
            <p style="color: var(--muted); font-size: 0.9rem;">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <a href="{{ route('account.invoice.download', $order->order_number) }}" target="_blank" class="btn btn-brass btn-sm">
            📄 Print Invoice
        </a>
    </div>

    @if(session('success'))
        <div style="background-color: var(--green-dim2); color: var(--green); padding: 14px 20px; border-radius: var(--radius); border-left: 4px solid var(--green); margin-bottom: 24px; font-weight: 600;">
            {{ session('success') }}
        </div>
    @endif

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
                    <div style="width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; margin: 0 auto 8px; {{ $idx <= $currentStatusKey ? 'background: var(--green); color: var(--white);' : 'background: var(--paper-2); color: var(--muted);' }}">
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

    <!-- Items Table with Product Review Trigger -->
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 28px; margin-bottom: 32px;">
        <h3 style="font-size: 1.2rem; margin-bottom: 20px;">Ordered Products & Reviews</h3>
        <div class="table-responsive">
            <table class="custom-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td style="font-weight: 600;">
                            {{ $item->product_name }} {{ $item->variant_name ? "({$item->variant_name})" : '' }}
                        </td>
                        <td style="font-size: 0.85rem; color: var(--muted);">{{ $item->sku }}</td>
                        <td>£{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="font-weight: 700; color: var(--green);">£{{ number_format($item->subtotal, 2) }}</td>
                        <td>
                            @if(in_array($order->order_status, ['confirmed', 'packed', 'shipped', 'delivered']))
                                <button type="button" 
                                        @click="openReviewModal = true; activeProductId = {{ $item->product_id }}; activeProductName = '{{ addslashes($item->product_name) }}'"
                                        class="btn btn-outline btn-sm" style="color: var(--brass); border-color: var(--brass-2); padding: 6px 14px; font-weight: 600;">
                                    ★ Rate & Review
                                </button>
                            @else
                                <span style="font-size: 0.8rem; color: var(--muted);">Available upon confirmation</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <!-- Perfectly Centered Luxury Review Modal Window -->
    <template x-teleport="body">
        <div x-show="openReviewModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(20, 21, 15, 0.65); backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); z-index: 99999; display: flex; align-items: center; justify-content: center; padding: 20px;"
             x-cloak>
            
            <div @click.away="openReviewModal = false" 
                 style="background: var(--white); border: 1px solid var(--line); border-radius: 8px; padding: 32px; width: 100%; max-width: 520px; box-shadow: var(--shadow-lg); position: relative; max-height: 90vh; overflow-y: auto; margin: auto;">
                
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; border-bottom: 1px solid var(--line-soft); padding-bottom: 16px;">
                    <div>
                        <span style="font-size: 0.78rem; color: var(--brass); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Verified Order Review</span>
                        <h3 style="font-size: 1.3rem; margin-top: 4px; color: var(--ink);" x-text="activeProductName"></h3>
                    </div>
                    <button type="button" @click="openReviewModal = false" 
                            style="background: var(--paper-2); border: none; font-size: 1.4rem; cursor: pointer; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--ink-soft); transition: all 0.2s;">
                        &times;
                    </button>
                </div>

                <form action="{{ route('account.review.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" :value="activeProductId">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div style="margin-bottom: 20px;">
                        <label style="font-size: 0.88rem; font-weight: 600; display: block; margin-bottom: 8px;">Overall Rating</label>
                        <select name="rating" required style="width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: var(--radius); font-size: 0.95rem; background: var(--paper);">
                            <option value="5">★★★★★ — 5 / 5 (Outstanding)</option>
                            <option value="4">★★★★☆ — 4 / 5 (Good)</option>
                            <option value="3">★★★☆☆ — 3 / 5 (Average)</option>
                            <option value="2">★★☆☆☆ — 2 / 5 (Below Expectations)</option>
                            <option value="1">★☆☆☆☆ — 1 / 5 (Poor Quality)</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-size: 0.88rem; font-weight: 600; display: block; margin-bottom: 8px;">Review Title / Headline</label>
                        <input type="text" name="title" placeholder="Summarize your experience (e.g. Excellent build quality)" required style="width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: var(--radius); font-size: 0.95rem;">
                    </div>

                    <div style="margin-bottom: 28px;">
                        <label style="font-size: 0.88rem; font-weight: 600; display: block; margin-bottom: 8px;">Detailed Review</label>
                        <textarea name="comment" rows="4" placeholder="What did you like or dislike about this product?" required style="width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: var(--radius); font-size: 0.95rem; font-family: inherit;"></textarea>
                    </div>

                    <div style="display: flex; gap: 12px; justify-content: flex-end;">
                        <button type="button" @click="openReviewModal = false" class="btn btn-outline btn-sm">Cancel</button>
                        <button type="submit" class="btn btn-brass btn-sm">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

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
