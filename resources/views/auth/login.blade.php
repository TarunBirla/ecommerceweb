@extends('layouts.app')

@section('title', 'Login | Eccommers Web')

@section('content')

<div style="max-width: 440px; margin: 60px auto; padding: 0 24px;">
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 36px; box-shadow: var(--shadow-md);">
        <h2 style="font-size: 1.8rem; margin-bottom: 8px; text-align: center;">Welcome Back</h2>
        <p style="color: var(--muted); font-size: 0.9rem; text-align: center; margin-bottom: 28px;">Log in to manage your orders & profile</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.88rem; display: block; margin-bottom: 6px;">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--radius); font-size: 0.95rem;">
                @error('email') <div style="color: var(--clay); font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.88rem; display: block; margin-bottom: 6px;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--radius); font-size: 0.95rem;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; font-size: 0.85rem;">
                <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                    <input type="checkbox" name="remember">
                    <span>Remember Me</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="padding: 12px; font-size: 1.05rem;">Sign In</button>
        </form>

        <!-- Demo credentials info box -->
        <div style="background: var(--paper); border: 1px solid var(--line); border-radius: var(--radius); padding: 14px; margin-top: 24px; font-size: 0.82rem; color: var(--ink-soft);">
            <strong>Demo Credentials:</strong><br>
            • Admin: <code>admin@eccommers.com</code> / <code>password123</code><br>
            • Customer: <code>customer@eccommers.com</code> / <code>password123</code>
        </div>

        <div style="text-align: center; margin-top: 24px; font-size: 0.88rem; color: var(--muted);">
            Don't have an account? <a href="{{ route('register') }}" style="color: var(--green); font-weight: 600;">Register Here</a>
        </div>
    </div>
</div>

@endsection
