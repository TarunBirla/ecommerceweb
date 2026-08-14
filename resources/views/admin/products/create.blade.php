@extends('layouts.admin')

@section('title', 'Add New Product | Admin')
@section('page-title', 'Add New Product')

@section('content')

<div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow-sm); max-width: 800px;">
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div style="grid-column: span 2;">
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Product Name</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div>
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">SKU Code</label>
                <input type="text" name="sku" required placeholder="e.g. IND-VLV-099" style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div>
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Category</label>
                <select name="category_id" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Regular Price (£)</label>
                <input type="number" step="0.01" name="price" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div>
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Sale Price (£ Optional)</label>
                <input type="number" step="0.01" name="sale_price" style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div>
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Initial Stock Quantity</label>
                <input type="number" name="stock" value="50" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div>
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Brand</label>
                <select name="brand_id" style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
                    <option value="">-- Select Brand --</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="grid-column: span 2;">
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Primary Image URL</label>
                <input type="url" name="image_url" placeholder="https://images.unsplash.com/photo-..." style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
            </div>

            <div style="grid-column: span 2;">
                <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Description</label>
                <textarea name="description" rows="4" style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);"></textarea>
            </div>

            <div style="grid-column: span 2; display: flex; gap: 20px;">
                <label><input type="checkbox" name="is_active" value="1" checked> Active in Catalog</label>
                <label><input type="checkbox" name="is_featured" value="1"> Featured</label>
                <label><input type="checkbox" name="is_trending" value="1"> Trending</label>
                <label><input type="checkbox" name="is_new_arrival" value="1" checked> New Arrival</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>

@endsection
