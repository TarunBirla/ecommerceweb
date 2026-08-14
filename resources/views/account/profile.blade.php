@extends('layouts.app')

@section('title', 'My Profile | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;">
    <h1 style="font-size: 2.2rem; margin-bottom: 32px;">Profile Settings</h1>

    <div style="display: grid; grid-template-columns: 260px 1fr; gap: 36px;">
        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px; height: fit-content;">
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 4px;">
                <li><a href="{{ route('account.dashboard') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Dashboard</a></li>
                <li><a href="{{ route('account.orders') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">My Orders</a></li>
                <li><a href="{{ route('account.profile') }}" style="display: block; padding: 10px 14px; font-weight: 700; color: var(--green); background: var(--green-dim); border-radius: var(--radius);">Profile Info</a></li>
                <li><a href="{{ route('account.addresses') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Saved Addresses</a></li>
                <li><a href="{{ route('account.wishlist') }}" style="display: block; padding: 10px 14px; color: var(--ink-soft);">Wishlist</a></li>
            </ul>
        </div>

        <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow-sm); max-width: 600px;">
            <form action="{{ route('account.profile.update') }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Full Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Email Address</label>
                    <input type="email" value="{{ $user->email }}" disabled style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius); background: var(--paper-2);">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Phone Number</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Gender</label>
                    <select name="gender" style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Profile Changes</button>
            </form>
        </div>
    </div>
</div>

@endsection
