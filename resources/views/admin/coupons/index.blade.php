@extends('layouts.admin')

@section('title', 'Discount Coupons | Admin')
@section('page-title', 'Coupons & Promotion Engine')

@section('content')

<div style="display: grid; grid-template-columns: 1fr 360px; gap: 32px;">
    <!-- Coupons List -->
    <div>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Min Order</th>
                    <th>Used / Limit</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $c)
                    <tr>
                        <td style="font-weight: 700; color: var(--green);">{{ $c->code }}</td>
                        <td>{{ $c->type == 'percentage' ? $c->value . '%' : '£' . number_format($c->value, 2) }}</td>
                        <td>£{{ number_format($c->min_order_amount, 2) }}</td>
                        <td>{{ $c->used_count }} / {{ $c->usage_limit ?: '∞' }}</td>
                        <td><span class="badge-status {{ $c->status ? 'badge-success' : 'badge-danger' }}">{{ $c->status ? 'Active' : 'Disabled' }}</span></td>
                        <td>
                            <form action="{{ route('admin.coupons.destroy', $c->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline btn-sm" style="color: var(--clay); padding: 4px 10px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Coupon Form -->
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); height: fit-content;">
        <h3 style="font-size: 1.2rem; margin-bottom: 16px;">Create Coupon</h3>
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="font-size: 0.85rem; font-weight: 600;">Coupon Code</label>
                <input type="text" name="code" placeholder="e.g. FESTIVE20" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius); text-transform: uppercase;">
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 0.85rem; font-weight: 600;">Type</label>
                <select name="type" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    <option value="percentage">Percentage (%)</option>
                    <option value="fixed">Fixed Amount (£)</option>
                </select>
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 0.85rem; font-weight: 600;">Discount Value</label>
                <input type="number" step="0.01" name="value" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 0.85rem; font-weight: 600;">Minimum Order Amount (£)</label>
                <input type="number" step="0.01" name="min_order_amount" value="1000" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-sm">Create Coupon</button>
        </form>
    </div>
</div>

@endsection
