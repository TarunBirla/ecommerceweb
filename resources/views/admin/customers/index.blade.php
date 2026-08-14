@extends('layouts.admin')

@section('title', 'Customer Management | Admin')
@section('page-title', 'Customer Accounts Management')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <form action="{{ route('admin.customers.index') }}" method="GET" style="display: flex; gap: 12px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer..." style="padding: 8px 14px; border: 1px solid var(--line); border-radius: var(--radius); width: 280px;">
        <button type="submit" class="btn btn-outline btn-sm">Search</button>
    </form>
</div>

<table class="custom-table">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Orders Placed</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $c)
            <tr>
                <td style="font-weight: 700;">{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phone ?: 'N/A' }}</td>
                <td><span class="badge-status badge-info">{{ $c->orders_count }} Orders</span></td>
                <td><span class="badge-status {{ $c->status == 'blocked' ? 'badge-danger' : 'badge-success' }}">{{ ucfirst($c->status) }}</span></td>
                <td>
                    <form action="{{ route('admin.customers.block', $c->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm" style="padding: 4px 10px; {{ $c->status == 'blocked' ? 'color: var(--green);' : 'color: var(--clay);' }}">
                            {{ $c->status == 'blocked' ? 'Unblock' : 'Block Account' }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 24px;">{{ $customers->links() }}</div>

@endsection
