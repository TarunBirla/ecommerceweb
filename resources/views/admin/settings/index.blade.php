@extends('layouts.admin')

@section('title', 'Store Settings | Admin')
@section('page-title', 'Platform Settings & Gateways')

@section('content')

<div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow-sm); max-width: 700px;">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        
        <h3 style="font-size: 1.2rem; margin-bottom: 16px; border-bottom: 1px solid var(--line-soft); padding-bottom: 8px;">General Store Info</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
            <div>
                <label style="font-size: 0.85rem; font-weight: 600;">Store Name</label>
                <input type="text" name="store_name" value="{{ $settings['store_name'] ?? 'Eccommers Web' }}" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
            <div>
                <label style="font-size: 0.85rem; font-weight: 600;">Store Email</label>
                <input type="email" name="store_email" value="{{ $settings['store_email'] ?? 'phil.andreson@nexteck.uk' }}" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
        </div>

        <h3 style="font-size: 1.2rem; margin-bottom: 16px; border-bottom: 1px solid var(--line-soft); padding-bottom: 8px;">Razorpay Gateway Settings</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
            <div>
                <label style="font-size: 0.85rem; font-weight: 600;">Razorpay Key ID</label>
                <input type="text" name="razorpay_key_id" value="{{ $settings['razorpay_key_id'] ?? 'rzp_test_samplekey123' }}" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
            <div>
                <label style="font-size: 0.85rem; font-weight: 600;">Razorpay Key Secret</label>
                <input type="password" name="razorpay_key_secret" value="{{ $settings['razorpay_key_secret'] ?? 'sample_razorpay_secret_456' }}" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
        </div>

        <h3 style="font-size: 1.2rem; margin-bottom: 16px; border-bottom: 1px solid var(--line-soft); padding-bottom: 8px;">SMTP Mail Server Settings</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
            <div>
                <label style="font-size: 0.85rem; font-weight: 600;">SMTP Host</label>
                <input type="text" name="smtp_host" value="{{ $settings['smtp_host'] ?? 'mail.nexteck.uk' }}" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
            <div>
                <label style="font-size: 0.85rem; font-weight: 600;">SMTP Port</label>
                <input type="text" name="smtp_port" value="{{ $settings['smtp_port'] ?? '465' }}" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save System Settings</button>
    </form>
</div>

@endsection
