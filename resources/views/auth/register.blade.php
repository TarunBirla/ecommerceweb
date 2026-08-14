@extends('layouts.app')

@section('title', 'Register | Eccommers Web')

@section('content')

<div style="max-width: 480px; margin: 60px auto; padding: 0 24px;">
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 36px; box-shadow: var(--shadow-md);">
        <h2 style="font-size: 1.8rem; margin-bottom: 8px; text-align: center;">Create Account</h2>
        <p style="color: var(--muted); font-size: 0.9rem; text-align: center; margin-bottom: 28px;">Join Eccommers Web for exclusive deals & instant tracking</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div style="margin-bottom: 16px;">
                <label style="font-weight: 600; font-size: 0.88rem; display: block; margin-bottom: 6px;">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight: 600; font-size: 0.88rem; display: block; margin-bottom: 6px;">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight: 600; font-size: 0.88rem; display: block; margin-bottom: 6px;">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight: 600; font-size: 0.88rem; display: block; margin-bottom: 6px;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="font-weight: 600; font-size: 0.88rem; display: block; margin-bottom: 6px;">Confirm Password</label>
                <input type="password" name="password_confirmation" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="padding: 12px; font-size: 1.05rem;">Register Now</button>
        </form>

        <div style="text-align: center; margin-top: 24px; font-size: 0.88rem; color: var(--muted);">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--green); font-weight: 600;">Sign In</a>
        </div>
    </div>
</div>

@endsection
