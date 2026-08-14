@extends('layouts.app')

@section('title', 'My Wishlist | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;">
    <h1 style="font-size: 2.2rem; margin-bottom: 32px;">Saved Wishlist</h1>

    <div style="display: grid; grid-template-columns: 260px 1fr; gap: 36px;">
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px; height: fit-content;">
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 4px;">
                <li><a href="{{ route('account.dashboard') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Dashboard</a></li>
                <li><a href="{{ route('account.orders') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">My Orders</a></li>
                <li><a href="{{ route('account.profile') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Profile Info</a></li>
                <li><a href="{{ route('account.addresses') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Saved Addresses</a></li>
                <li><a href="{{ route('account.wishlist') }}" style="display: block; padding: 10px 14px; font-weight: 700; color: var(--green); background: var(--green-dim); border-radius: var(--radius);">Wishlist</a></li>
            </ul>
        </div>

        <div>
            @if($wishlists->count() > 0)
                <div class="product-grid">
                    @foreach($wishlists as $w)
                        @php $product = $w->product; @endphp
                        <div class="product-card">
                            <div class="media-wrapper">
                                <img src="{{ $product->primaryImage ? $product->primaryImage->image_path : 'https://via.placeholder.com/400' }}" alt="{{ $product->name }}">
                            </div>
                            <div class="content">
                                <a href="{{ route('products.show', $product->slug) }}" class="title">{{ $product->name }}</a>
                                <div class="price" style="margin-bottom: 14px;">£{{ number_format($product->effective_price, 2) }}</div>
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm btn-block">View Product</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="color: var(--muted);">Your wishlist is empty.</p>
            @endif
        </div>
    </div>
</div>

@endsection
