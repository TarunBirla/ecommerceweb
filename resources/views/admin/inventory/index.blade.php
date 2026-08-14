@extends('layouts.admin')

@section('title', 'Inventory Audit & Stock Adjustment | Admin')
@section('page-title', 'Inventory & Stock Audit Trail')

@section('content')

<div style="display: grid; grid-template-columns: 1fr 360px; gap: 32px; margin-bottom: 32px;">
    <!-- Stock Audit Transactions List -->
    <div>
        <h3 style="font-size: 1.2rem; margin-bottom: 16px;">Recent Stock Audit Transactions</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Stock Before → After</th>
                    <th>Ref # / Note</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                    <tr>
                        <td style="font-weight: 600;">{{ $t->product ? $t->product->name : 'N/A' }}</td>
                        <td>
                            <span class="badge-status {{ in_array($t->type, ['purchase', 'opening', 'return']) ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($t->type) }}
                            </span>
                        </td>
                        <td style="font-weight: 700;">{{ $t->quantity > 0 ? "+{$t->quantity}" : $t->quantity }}</td>
                        <td style="font-size: 0.85rem; color: var(--muted);">{{ $t->stock_before }} → <strong>{{ $t->stock_after }}</strong></td>
                        <td style="font-size: 0.85rem; color: var(--ink-soft);">{{ $t->reference_no ?: $t->note }}</td>
                        <td style="font-size: 0.8rem; color: var(--muted);">{{ $t->created_at->format('d M H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Manual Stock Adjustment Form -->
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); height: fit-content;">
        <h3 style="font-size: 1.2rem; margin-bottom: 16px;">Manual Stock Adjustment</h3>
        
        <form action="{{ route('admin.inventory.adjust') }}" method="POST">
            @csrf
            <div style="margin-bottom: 16px;">
                <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Select Product</label>
                <select name="product_id" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} (Current Stock: {{ $p->stock }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Adjustment Type</label>
                <select name="type" required style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                    <option value="purchase">+ Purchase / Stock Received</option>
                    <option value="return">+ Return Received</option>
                    <option value="adjustment">Manual Stock Adjustment</option>
                    <option value="damaged">- Damaged / Expired Stock</option>
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Quantity (+ for addition, - for reduction)</label>
                <input type="number" name="quantity" required placeholder="e.g. 50 or -5" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 6px;">Note / PO #</label>
                <input type="text" name="note" placeholder="e.g. Stock shipment received" style="width: 100%; padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-sm">Record Adjustment</button>
        </form>
    </div>
</div>

@endsection
