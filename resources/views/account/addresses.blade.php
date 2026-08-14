@extends('layouts.app')

@section('title', 'Saved Addresses | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;">
    <h1 style="font-size: 2.2rem; margin-bottom: 32px;">Saved Shipping Addresses</h1>

    <div style="display: grid; grid-template-columns: 260px 1fr; gap: 36px;">
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px; height: fit-content;">
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 4px;">
                <li><a href="{{ route('account.dashboard') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Dashboard</a></li>
                <li><a href="{{ route('account.orders') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">My Orders</a></li>
                <li><a href="{{ route('account.profile') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Profile Info</a></li>
                <li><a href="{{ route('account.addresses') }}" style="display: block; padding: 10px 14px; font-weight: 700; color: var(--green); background: var(--green-dim); border-radius: var(--radius);">Saved Addresses</a></li>
                <li><a href="{{ route('account.wishlist') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Wishlist</a></li>
            </ul>
        </div>

        <div>
            <!-- Add Address Form -->
            <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 28px; margin-bottom: 36px; box-shadow: var(--shadow-sm);">
                <h3 style="font-size: 1.2rem; margin-bottom: 20px;">Add New Address</h3>
                <form action="{{ route('account.addresses.store') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    @csrf
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600;">Full Name</label>
                        <input type="text" name="name" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600;">Phone Number</label>
                        <input type="text" name="phone" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="font-size: 0.85rem; font-weight: 600;">Address Line 1</label>
                        <input type="text" name="address_line_1" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600;">City</label>
                        <input type="text" name="city" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600;">State</label>
                        <input type="text" name="state" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600;">Pincode</label>
                        <input type="text" name="pincode" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600;">Address Type</label>
                        <select name="address_type" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                            <option value="home">Home</option>
                            <option value="work">Office / Work</option>
                        </select>
                    </div>
                    <div style="grid-column: span 2;">
                        <button type="submit" class="btn btn-primary btn-sm">Save Address</button>
                    </div>
                </form>
            </div>

            <!-- Existing Addresses -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
                @foreach($addresses as $addr)
                    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px; position: relative;">
                        <div style="font-weight: 700; font-size: 1rem; margin-bottom: 6px;">{{ $addr->name }}</div>
                        <p style="font-size: 0.88rem; color: var(--ink-soft); line-height: 1.6;">
                            {{ $addr->address_line_1 }}<br>
                            {{ $addr->city }}, {{ $addr->state }} - {{ $addr->pincode }}<br>
                            Phone: {{ $addr->phone }}
                        </p>
                        <form action="{{ route('account.addresses.delete', $addr->id) }}" method="POST" style="margin-top: 16px;">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm" style="color: var(--clay); border-color: var(--clay-dim);">Delete Address</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
