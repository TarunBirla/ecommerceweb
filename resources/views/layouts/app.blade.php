<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Eccommers Web | Premium E-Commerce Platform')</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @yield('styles')
</head>
<body x-data="{ mobileMenuOpen: false, searchOpen: false }">

    <!-- Top Announcement Bar -->
    <div class="top-bar">
        <span>✨ Free Standard Delivery across India on orders above £2,000 | Use Code: <strong>WELCOME10</strong> for 10% OFF</span>
    </div>

    <!-- Header Navbar -->
    <header class="site-header">
        <div class="nav-container">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo">
                <span>Eccommers</span>
                <span class="badge-tag">Luxury</span>
            </a>

            <!-- Search Form with Live Auto-Suggest -->
            <form action="{{ route('products.index') }}" method="GET" class="search-form" x-data="liveSearch()">
                <svg class="search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="search" class="search-input" placeholder="Search products, SKUs, chemical valves..." 
                       x-model="query" @input.debounce.300ms="fetchResults()" autocomplete="off">

                <!-- Search Suggestions Dropdown -->
                <div x-show="results.length > 0" @click.away="results = []" 
                     style="position: absolute; top: 110%; left: 0; right: 0; background: var(--white); border: 1px solid var(--line); border-radius: 8px; box-shadow: var(--shadow-md); z-index: 1000; overflow: hidden;" x-cloak>
                    <template x-for="item in results" :key="item.slug">
                        <a :href="item.url" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-bottom: 1px solid var(--line-soft);">
                            <img :src="item.image || 'https://via.placeholder.com/40'" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                            <div>
                                <div style="font-weight: 600; font-size: 0.9rem; color: var(--ink);" x-text="item.name"></div>
                                <div style="font-size: 0.8rem; color: var(--green); font-weight: 700;" x-text="item.price"></div>
                            </div>
                        </a>
                    </template>
                </div>
            </form>

            <!-- Nav Actions (Wishlist, Cart, Account) -->
            <div class="nav-actions">
                @auth
                    <a href="{{ route('account.wishlist') }}" class="icon-btn" title="Wishlist">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </a>
                @endauth

                <a href="{{ route('cart.index') }}" class="icon-btn" title="Cart">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    @php
                        $cartCount = 0;
                        if (Auth::check()) {
                            $cart = \App\Models\Cart::where('user_id', Auth::id())->first();
                            $cartCount = $cart ? $cart->items()->sum('quantity') : 0;
                        }
                    @endphp
                    @if($cartCount > 0)
                        <span class="badge-count">{{ $cartCount }}</span>
                    @endif
                </a>

                @auth
                    <div x-data="{ open: false }" style="position: relative;">
                        <button @click="open = !open" class="btn btn-outline btn-sm" style="border-radius: 30px;">
                            <span>{{ Auth::user()->name }}</span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" style="position: absolute; right: 0; top: 120%; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); min-width: 180px; box-shadow: var(--shadow-md); z-index: 1000;" x-cloak>
                            <a href="{{ route('account.dashboard') }}" style="display: block; padding: 10px 16px; border-bottom: 1px solid var(--line-soft);">My Dashboard</a>
                            <a href="{{ route('account.orders') }}" style="display: block; padding: 10px 16px; border-bottom: 1px solid var(--line-soft);">My Orders</a>
                            <a href="{{ route('account.profile') }}" style="display: block; padding: 10px 16px; border-bottom: 1px solid var(--line-soft);">My Profile</a>
                            @if(Auth::user()->isStaff())
                                <a href="{{ route('admin.dashboard') }}" style="display: block; padding: 10px 16px; color: var(--clay); font-weight: 600; border-bottom: 1px solid var(--line-soft);">Admin Panel</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 10px 16px; color: var(--clay); cursor: pointer;">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                @endauth
            </div>
        </div>

        <!-- Categories Links Bar -->
        <nav class="category-nav">
            <div class="inner">
                <a href="{{ route('products.index') }}" class="category-link {{ !request()->has('category') ? 'active' : '' }}">All Products</a>
                @foreach(\App\Models\Category::whereNull('parent_id')->where('status', true)->take(6)->get() as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="category-link {{ request('category') == $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </nav>
    </header>

    <!-- Flash Notifications -->
    <div style="max-width: 1320px; margin: 16px auto; padding: 0 24px;">
        @if(session('success'))
            <div style="background-color: var(--green-dim2); color: var(--green); padding: 12px 20px; border-radius: var(--radius); border-left: 4px solid var(--green); margin-bottom: 16px; font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background-color: var(--clay-dim); color: var(--clay); padding: 12px 20px; border-radius: var(--radius); border-left: 4px solid var(--clay); margin-bottom: 16px; font-weight: 500;">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background-color: var(--ink); color: var(--paper-2); padding: 60px 0 30px; margin-top: 80px; border-top: 3px solid var(--brass);">
        <div style="max-width: 1320px; margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 40px;">
            <div>
                <h3 style="color: var(--brass-2); margin-bottom: 16px; font-size: 1.5rem;">Eccommers Web</h3>
                <p style="color: var(--muted-2); font-size: 0.9rem; line-height: 1.7;">
                    Premier e-commerce platform engineered for petrochemical parts, handcrafted apparel, and precision studio electronics.
                </p>
            </div>
            <div>
                <h4 style="color: var(--white); margin-bottom: 16px;">Quick Links</h4>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 8px; font-size: 0.9rem; color: var(--muted-2);">
                    <li><a href="{{ route('products.index') }}">Product Catalog</a></li>
                    <li><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                    <li><a href="{{ route('account.dashboard') }}">Customer Account</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color: var(--white); margin-bottom: 16px;">Policies & Compliance</h4>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 8px; font-size: 0.9rem; color: var(--muted-2);">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Shipping & Return Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color: var(--white); margin-bottom: 16px;">Need Assistance?</h4>
                <p style="color: var(--muted-2); font-size: 0.9rem; line-height: 1.7;">
                    Email: phil.andreson@nexteck.uk<br>
                    Phone: +91 9876543210<br>
                    Hours: Mon - Sat (9am - 7pm IST)
                </p>
            </div>
        </div>
        <div style="max-width: 1320px; margin: 40px auto 0; padding: 20px 24px 0; border-top: 1px solid rgba(255,255,255,0.08); text-align: center; color: var(--muted); font-size: 0.85rem;">
            © {{ date('Y') }} Eccommers Web Platform. All rights reserved. Razorpay & SSL Secured.
        </div>
    </footer>

    <script>
        function liveSearch() {
            return {
                query: '',
                results: [],
                fetchResults() {
                    if (this.query.length < 2) {
                        this.results = [];
                        return;
                    }
                    fetch(`{{ route('products.search') }}?q=${encodeURIComponent(this.query)}`)
                        .then(res => res.json())
                        .then(data => { this.results = data; });
                }
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
