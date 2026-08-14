<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard | Eccommers Web')</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Admin Sidebar -->
        <aside class="admin-sidebar">
            <div class="brand">
                <span>Eccommers</span> Admin
            </div>
            <ul class="admin-menu">
                <li class="admin-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="admin-menu-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="admin-menu-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span>Products</span>
                    </a>
                </li>
                <li class="admin-menu-item {{ request()->routeIs('admin.inventory*') ? 'active' : '' }}">
                    <a href="{{ route('admin.inventory.index') }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span>Inventory Audit</span>
                    </a>
                </li>
                <li class="admin-menu-item {{ request()->routeIs('admin.coupons*') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupons.index') }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 001 1.732V15a2 2 0 002 2h14a2 2 0 002-2v-2.268A2 2 0 0021 11V7a2 2 0 00-2-2H5z"></path></svg>
                        <span>Coupons</span>
                    </a>
                </li>
                <li class="admin-menu-item {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
                    <a href="{{ route('admin.customers.index') }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="admin-menu-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        <span>Store Settings</span>
                    </a>
                </li>
                <li class="admin-menu-item" style="margin-top: auto; padding-top: 40px;">
                    <a href="{{ route('home') }}" target="_blank" style="color: var(--brass-2);">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        <span>View Storefront</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header bar -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                <div>
                    <h1 style="font-size: 1.8rem;">@yield('page-title', 'Admin Dashboard')</h1>
                    <p style="color: var(--muted); font-size: 0.9rem;">Manage store orders, products, inventory and platform parameters.</p>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 0.9rem; color: var(--ink-soft); font-weight: 600;">Logged in as {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Flash messages -->
            @if(session('success'))
                <div style="background-color: var(--green-dim2); color: var(--green); padding: 12px 20px; border-radius: var(--radius); border-left: 4px solid var(--green); margin-bottom: 24px;">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>
